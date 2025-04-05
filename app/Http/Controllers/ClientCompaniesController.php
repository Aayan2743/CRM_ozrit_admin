<?php

namespace App\Http\Controllers;

use App\Models\ClientCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientCompaniesController extends Controller
{
    public function getClientsData()
    {
        try {
            // Retrieve all leads
            $clients = ClientCompany::all();

            $formattedClients = $clients->map(callback: function ($client) {
                // Fetch related lead data using client_id

                return [
                    'id' => $client->id,
                    'company_name' => $client->company_name ?? '',
                    'company_logo' => $client->company_logo ?? '',
                    'address' => $client->street_address ?? '',
                    'phone' => $client->phone1 ?? '',
                    'phone2' => $client->phone2 ?? '',  // Adding phone2 in case it's needed
                    'email' => $client->email ?? '',
                    'website' => $client->website ?? '',  // Adding website
                    'owner' => $client->owner ?? '',
                    'source' => $client->source ?? '',
                    'industry' => $client->industry ?? '',
                    'status' => $client->status ?? '',
                    'created_date' => $client->created_at->format('d M Y, h:i A') ?? '',
                    'city' => $client->city ?? '',  // Adding city
                    'state_province' => $client->state_province ?? '',  // Adding state_province
                    'country' => $client->country ?? '',  // Adding country
                    'zipcode' => $client->zipcode ?? '',  // Adding zipcode
                    'facebook' => $client->facebook ?? '',  // Adding facebook
                    'skype' => $client->skype ?? '',  // Adding skype
                    'linkedin' => $client->linkedin ?? '',  // Adding linkedin
                    'twitter' => $client->twitter ?? '',  // Adding twitter
                    'whatsapp' => $client->whatsapp ?? '',  // Adding whatsapp
                    'instagram' => $client->instagram ?? '',  // Adding instagram
                ];
                
            });

            return response()->json(['data' => $formattedClients]);
        } catch (\Exception $e) {
            // Log the error and return an empty dataset in case of failure
            Log::error($e->getMessage());
            return response()->json(['data' => []], 500); // Respond with an empty array or handle the error properly
        }
    }
    public function store(Request $request)
    {
        try {
            // Validate the request data, including the company logo file
            $validatedData = $request->validate([
                'company_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone1' => 'required|string|max:20',
                'website' => 'required|url',
                'source' => 'required|not_in:Choose',  // Ensures 'Choose' is not a valid option
                'industry' => 'required|not_in:Choose',  // Same for industry
                'company_logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:800', // Validate image file
                'phone2' => 'nullable|string|max:20',
                'owner' => 'nullable|string',
                'street_address' => 'nullable|string',
                'city' => 'nullable|string',
                'state_province' => 'nullable|string',
                'country' => 'nullable|string',
                'zipcode' => 'nullable|string',
                'facebook' => 'nullable|string',
                'skype' => 'nullable|string',
                'linkedin' => 'nullable|string',
                'twitter' => 'nullable|string',
                'whatsapp' => 'nullable|string',
                'instagram' => 'nullable|string',
            ]);

            // Handle file upload if a logo is provided
            if ($request->hasFile('company_logo')) {
                // Store the uploaded logo file and get the file path
                $logoPath = $request->file('company_logo')->store('client_company_logos', 'public');  // Store in public disk
                $validatedData['company_logo'] = $logoPath;  // Add the logo path to the validated data
            }

            // Insert the validated data into the database
            ClientCompany::create($validatedData);

            // Return a success response
            return response()->json([
                'status' => 'success',
                'message' => 'Company created successfully.'
            ]);
        } catch (\Exception $e) {
            // Log the error message (optional)
            Log::error('Error while creating company: ' . $e->getMessage());

            // Return a failure response
            return response()->json([
                'status' => 'error',
                'message' => 'There was an error creating the company. Please try again.'
            ], 500);
        }
    }

    public function view()
    {
        $allClientsCount = ClientCompany::count();
        $allClients = ClientCompany::orderBy('created_at', 'desc')->get();
        return view('companies', compact('allClients', 'allClientsCount'));
    }

    
    public function editClient(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'client_id' => 'required|exists:client_companies,id',  // Ensure the client exists
                'company_name' => 'required|string|max:255',  // Ensure company_name is a string and not empty
                'email' => 'required|email|max:255',  // Ensure email is a valid email address
                'company_logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:800',
                'website' => 'required|url',
                'phone1' => 'required|string|max:15',  // Ensure phone1 is a string with a maximum length
                'phone2' => 'nullable|string|max:15',  // phone2 is optional
                'source' => 'required|string|max:255',  // Ensure source is a string and not empty
                'industry' => 'required|string|max:255',  // Ensure industry is a string and not empty
                'street_address' => 'nullable|string|max:255', // Optional address
                'city' => 'nullable|string|max:255', // Optional city
                'state_province' => 'nullable|string|max:255', // Optional state
                'country' => 'nullable|string|max:255', // Optional country
                'zipcode' => 'nullable|string|max:20', // Optional zipcode
            ]);
    
            // Find the client company to update
            $clientCompany = ClientCompany::find($request->input('client_id'));
    

            if (!$clientCompany) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Client company not found.'
                ], 404);
            }
            if ($request->hasFile('company_logo')) {
                $logoPath =  $request->file('company_logo')->store('client_company_logos', 'public'); 
                $clientCompany->company_logo = $logoPath;
            }
    
            // Update the client company with new data
            $clientCompany->update([
                'company_name' => $request->input('company_name'),
                'company_logo' => $logoPath ?? $clientCompany->company_logo,// If logo is being updated, handle file upload separately
                'email' => $request->input('email'),
                'phone1' => $request->input('phone1'),
                'phone2' => $request->input('phone2'),
                'website' => $request->input('website'),
                'owner' => $request->input('owner'),
                'source' => $request->input('source'),
                'industry' => $request->input('industry'),
                'street_address' => $request->input('street_address'),
                'city' => $request->input('city'),
                'state_province' => $request->input('state_province'),
                'country' => $request->input('country'),
                'zipcode' => $request->input('zipcode'),
                'facebook' => $request->input('facebook'),
                'skype' => $request->input('skype'),
                'linkedin' => $request->input('linkedin'),
                'twitter' => $request->input('twitter'),
                'whatsapp' => $request->input('whatsapp'),
                'instagram' => $request->input('instagram'),
            ]);
    
            // Return a success message
            return response()->json([
                'status' => 'success',
                'message' => 'Client company updated successfully!'
            ]);
        } catch (\Exception $e) {
            // Log the error message (optional)
            Log::error('Error while updating client company: ' . $e->getMessage());
    
            // Return a failure response with the error message
            return response()->json([
                'status' => 'error',
                'message' => 'There was an error updating the client company. Please try again.',
                'error' => $e->getMessage()  // Include exception message for debugging
            ], 500);
            
        }
    }
    


    public function deleteClient(Request $request)
    {
        try {
            // Find the lead by ID
            $client = ClientCompany::find($request->input('client_id'));
    
            // If the lead is not found, return an error response
            if (!$client) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lead not found.'
                ], 404);
            }
    
            // Delete the lead
            $client->delete();
    
            // Return a success response
            return response()->json([
                'status' => 'success',
                'message' => 'Company deleted successfully.'
            ]);
    
        } catch (\Exception $e) {
            // Log the error message (optional)
            Log::error('Error while deleting lead: ' . $e->getMessage());
    
            // Return a failure response with the error message
            return response()->json([
                'status' => 'error',
                'message' => 'There was an error deleting the lead. Please try again.'
            ], 500);
        }
    }
}
