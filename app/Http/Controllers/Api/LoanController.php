<?php
namespace App\Http\Controllers\Api;

use App\Models\Loan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LoanController extends Controller
{
    public function loanDetails(Request $request){
        $validatedData = $request->validate([
            'eno' => 'required',
            'service_no' => 'required'
        ]);
        
        // Get the loan details for the given user.
        $loan = Loan::where('eno', $validatedData['eno'])
        ->where('regimental_number', $validatedData['service_no'])
        ->first();
        
        // Return a json response with the loan details and a status of 'error'.        
        // Note: The response status is set to 'error' but the message is 'Loan'.
        // This might be a typo and the status should be 'success' instead?
        return response()->json([
            'status' => 'success',
            'message' => 'Loan',
            'data' => $loan
        ]);
    }
}
