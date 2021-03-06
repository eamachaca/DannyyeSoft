<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'Auth\ApiController@login');
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('logout', 'Auth\ApiController@logout');
    Route::apiResource('user','UserApiController');
    Route::apiResource('document','DocumentApiController');
    Route::apiResource('corporate','CorporateApiController');
    Route::apiResource('corporate_contract','CorporateContractApiController');
    Route::apiResource('corporate_contact','CorporateContactApiController');
    Route::apiResource('company','CompanyApiController');
    Route::apiResource('corporate_document','CorporateDocumentApiController');
    Route::get('corporate_relationships/{id}','CorporateApiController@getWithRelationships');
    Route::get('document_relationships/{id}','DocumentApiController@getWithRelationships');
});
