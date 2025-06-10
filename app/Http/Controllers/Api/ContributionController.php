<?php
namespace App\Http\Controllers\Api;

use App\Models\Contribution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContributionController extends Controller
{
   
    /**
     * Get the total contribution amount for a given user.
     * 
     * This function gets the total contribution amount for a given user.
     * It takes a request with the user's E No and Service No.
     * It validates the request.
     * It queries the Contribution model to get the latest contribution amount for the given user.
     * It returns a json response with the contribution amount and a status of 'error'.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function totalContribution(Request $request)
    {
        $validatedData = $request->validate([
            'eno' => 'required',
            'service_no' => 'required',
        ]);

        // Get the latest contribution amount for the given user.
        $contribution = Contribution::where('eno', $validatedData['eno'])
        ->where('regimental_number', $validatedData['service_no'])
        ->latest('icp_id')
        ->first();
        
        // Return a json response with the contribution amount and a status of 'error'.
        // Note: The response status is set to 'error' but the message is 'Contribution'.
        // This might be a typo and the status should be 'success' instead?
        return response()->json([
            'status' => 'success',
            'message' => 'Contribution',
            'data' => $contribution
        ]);
        
    }

    /**
     * Get the contribution amount for a given user for a given quarter.
     * 
     * This function gets the contribution amount for a given user for a given quarter.
     * It takes a request with the user's E No and Service No.
     * It validates the request.
     * It queries the Contribution model to get the contribution amount for the given user
     * for the given quarter.
     * It returns a json response with the contribution amount and a status of 'error'.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function quaterContribution(Request $request)
    {
        $validatedData = $request->validate([
            'eno' => 'required',
            'service_no' => 'required',
        ]);

        // Get the contribution amount for the given user for the given quarter.
        // Note: The order by clause is used to sort the contributions in ascending order.
        // This is done to get the contribution amount for the given quarter.
        $contribution = Contribution::where('eno', $validatedData['eno'])
        ->where('regimental_number', $validatedData['service_no'])
        ->orderBy('icp_id', 'asc')
        ->get();
              
        // Return a json response with the contribution amount and a status of 'error'.
        // Note: The response status is set to 'error' but the message is 'Contribution'.
        // This might be a typo and the status should be 'success' instead?
        return response()->json([
            'status' => 'success',
            'message' => 'Contribution',
            'data' => $contribution
        ]);
    }
    
}
