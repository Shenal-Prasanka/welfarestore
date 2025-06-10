<?php

use App\Http\Controllers\Api\ContactMobileController;
use App\Http\Controllers\Api\ContributionController;
use App\Http\Controllers\Api\LoanController;
use App\Http\Controllers\Api\NomineeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'contribution'],function($route){
    Route::get('total_contribution',[ContributionController::class,'totalContribution']);
    Route::get('quater_contribution',[ContributionController::class,'quaterContribution']);
});

Route::group(['middleware' => 'api', 'prefix' => 'nominee'],function($route){
    Route::get('nominee_details',[NomineeController::class,'nomineeDetails']);
});

Route::group(['middleware' => 'api', 'prefix' => 'loan'],function($route){
    Route::get('loan_details',[LoanController::class,'loanDetails']);
});

Route::group(['middleware' => 'api', 'prefix' => 'contact'],function($route){
    Route::get('contact_details',[ContactMobileController::class,'contactDetails']);
});