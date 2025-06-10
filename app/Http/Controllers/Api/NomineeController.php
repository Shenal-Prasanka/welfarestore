<?php
namespace App\Http\Controllers\Api;

use App\Models\Nominee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NomineeController extends Controller
{
    /**
     * Get the nominee details for a given user.
     *
     * This function takes a request with the user's E No and Service No.
     * It validates the request.
     * It queries the Nominee model to get the nominee details for the given user.
     * It returns a json response with the nominee details and a status of 'error'.
     * Note: The response status is set to 'error' but the message is 'Nominee'.
     * This might be a typo and the status should be 'success' instead?
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function nomineeDetails(Request $request){
        $validatedData = $request->validate([
            'eno' => 'required',
            'service_no' => 'required'
        ]);
        
        // Get the nominee details for the given user.
        $nominee = Nominee::where('eno', $validatedData['eno'])
        ->where('regimental_number', $validatedData['service_no'])
        ->get();
        
        // Return a json response with the nominee details and a status of 'error'.
        // Note: The response status is set to 'error' but the message is 'Nominee'.
        // This might be a typo and the status should be 'success' instead?
        return response()->json([
            'status' => 'success',
            'message' => 'Nominee',
            'data' => $nominee
        ]);
    }
}
