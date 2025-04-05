<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendWelcomeEmail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/deals-dashboard';
    // protected $redirectTo = '/deals-dashboard';
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'companyname' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phonenumber' => ['required', 'digits:10', 'unique:users,phonenumber'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $company = Company::create([
                'company_name' => $data['companyname'],
                'name' => $data['name'],
                'email' => $data['email'],
                'office_phone' => $data['phonenumber'],
                'whatsappnumber' => isset($data['whatsappnumber']) ? 'yes' : 'no',
            ]);
    
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phonenumber' => $data['phonenumber'],
                'whatsappnumber' => isset($data['whatsappnumber']) ? 'yes' : 'no',
                'expire_date' => now()->addDays(7),
                'role' => 'admin',
                'company_id' => $company->company_id,
            ]);

            $user['password_plain'] = $data['password'];

            SendWelcomeEmail::dispatch($user);

            session()->flash('success', 'Registration successful! Welcome email has been sent.');

            return $user;
        });
    }
}
