<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactNo;
use Illuminate\Http\Request;

class ContactMobileController extends Controller
{
    /**
     * Get the contact details for the given user.
     * 
     * This function takes a request with the user's E No and Service No.
     * It validates the request.
     * It queries the ContactNo model to get the contact details for the given user.
     * It returns a json response with the contact details and a status of 'error'.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contactDetails(){

        // Get the contact details for the given user.
        $contact = ContactNo::select('land_no','army_extension_no')->first();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Loan',
            'contact' => $contact
        ]);
    }
}
