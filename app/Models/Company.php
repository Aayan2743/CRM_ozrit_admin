<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
class Company extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Set the password attribute before saving to ensure it's always hashed.
     *
     * @param string $value
     * @return void
     */
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value); // Hash the password before saving it
    // }
    public static function boot()
    {
        parent::boot();

        static::creating(function ($company) {
            if (empty($company->company_id)) {
                // Generate a 12-character alphanumeric random string
                $company->company_id = Str::lower(Str::random(12));
        
                // Validate the uniqueness of company_id before saving
                $validator = Validator::make(
                    ['company_id' => $company->company_id],
                    ['company_id' => Rule::unique('companies', 'company_id')]
                );
        
                // If validation fails, regenerate the company_id
                if ($validator->fails()) {
                    $company->company_id = Str::lower(Str::random(12));
                }
            }
        });
    }
}
