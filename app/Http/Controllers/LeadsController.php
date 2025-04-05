<?php

namespace App\Http\Controllers;

use App\Models\ClientCompany;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LeadsController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the request data, including any necessary fields for leads
            $validatedData = $request->validate([
                'lead_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'lead_type' => 'required|in:Person,Organization',  // Ensure only valid lead types
                'client_id' => 'exists:client_companies,id',  // Ensure the client exists in the client_companies table
                'phone' => 'required|string|max:20',
                'source' => 'required|string|max:255',
                'industry' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'owner' => 'nullable|string|max:255',
                'company_id' => 'nullable|exists:companies,company_id', // Ensure the company exists in the companies table
            ]);

            // Insert the validated data into the database
            Lead::create($validatedData);

            // Return a success response
            return response()->json([
                'status' => 'success',
                'message' => 'Lead created successfully.'
            ]);
        } catch (\Exception $e) {
            // Log the error message (optional)
            Log::error('Error while creating lead: ' . $e->getMessage());

            // Return a failure response
            return response()->json([
                'status' => 'error',
                'message' => 'There was an error creating the lead. Please try again.'
            ], 500);
        }
    }


    public function view()
    {
        $allLeadsCount = Lead::count();
        $allLeads = Lead::orderBy('created_at', 'desc')->get();

        return view('leads', compact('allLeads', 'allLeadsCount'));
    }

    // LeadController.php
    public function getLeadsData()
    {
        try {
            // Retrieve all leads
            $leads = Lead::all();

            $formattedLeads = $leads->map(function ($lead) {
                // Fetch related lead data using client_id
                $clientLead = ClientCompany::find($lead->client_id);

                // Get the company name, if the related lead exists
                $company_name = $clientLead ? $clientLead->company_name : "Lead not found!";
                $company_logo = $clientLead ? $clientLead->company_logo : "Logo not found!";
                $address = $clientLead ? $clientLead->street_address : "Logo not found!";

                return [
                    'id' => $lead->id,
                    'lead_name' => $lead->lead_name ?? '',
                    'lead_type' => $lead->lead_type ?? '',
                    'company_name' => $company_name ?? '',
                    'company_id' => $lead->client_id ?? '',
                    'company_image' => $company_logo ?? '',
                    'source' =>  $lead->source ?? '',
                    'industry' =>  $lead->industry ?? '',
                    'company_address' => $address ?? '',
                    'address' => $lead->address ?? '',
                    'phone' => $lead->phone ?? '',
                    'email' => $lead->email ?? '',
                    'status' => $lead->status ?? '',
                    'created_date' => $lead->created_at->format('d M Y, h:i A') ?? '',
                    'owner' => $lead->owner ?? '',
                ];
            });

            return response()->json(['data' => $formattedLeads]);
        } catch (\Exception $e) {
            // Log the error and return an empty dataset in case of failure
            Log::error($e->getMessage());
            return response()->json(['data' => []], 500); // Respond with an empty array or handle the error properly
        }
    }



    public function editLead(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'lead_id' => 'required|exists:leads,id',  // Ensure the lead exists
                'lead_name' => 'required|string|max:255',  // Ensure lead_name is a string and not empty
                'email' => 'required|email|max:255',  // Ensure email is a valid email address
                'phone' => 'required|string|max:15',  // Ensure phone is a string with a maximum length
                'source' => 'required|string|max:255',  // Ensure source is a string and not empty
                'industry' => 'required|string|max:255',  // Ensure industry is a string and not empty
            ]);

            // Find the lead to update
            $lead = Lead::find($request->input('lead_id'));

            // If the lead is not found, return an error response
            if (!$lead) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lead not found.'
                ], 404);
            }

            // Update the lead with new data
            $lead->update([
                'lead_name' => $request->input('lead_name'),
                'lead_type' => $request->input('lead_type'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'source' => $request->input('source'),
                'industry' => $request->input('industry'),
                'owner' => $request->input('owner'),
                'address' => $request->input('address'),
            ]);

            // Return a success message
            return response()->json([
                'status' => 'success',
                'message' => 'Lead updated successfully!'
            ]);
        } catch (\Exception $e) {
            // Log the error message (optional)
            Log::error('Error while updating lead: ' . $e->getMessage());

            // Return a failure response with the error message
            return response()->json([
                'status' => 'error',
                'message' => 'There was an error updating the lead. Please try again.'
            ], 500);
        }
    }


    public function deleteLead(Request $request)
    {
        try {
            // Find the lead by ID
            $lead = Lead::find($request->input('lead_id'));
    
            // If the lead is not found, return an error response
            if (!$lead) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lead not found.'
                ], 404);
            }
    
            // Delete the lead
            $lead->delete();
    
            // Return a success response
            return response()->json([
                'status' => 'success',
                'message' => 'Lead deleted successfully.'
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
