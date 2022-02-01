<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('/menu', 'Api\MenuController@index');

Route::any('get-makes-by-year','CarInformationController@getMakesByYear');
Route::any('get-models-by-make-and-year','CarInformationController@getModelsByMakeAndYear');
Route::any('federal-loan-reminder','FederalLoanReminderController@save');
Route::any('instagram-metric','InstagramMetricController@save');
Route::any('scholarship-input','CareerOneStopScholarshipController@save');
Route::any('disclosure-information','Webhooks\DisclosureInformationController@save');
