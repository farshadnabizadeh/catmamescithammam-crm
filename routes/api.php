<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

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

//patient
Route::POST('/patients/info/{id}', 'App\Http\Controllers\Api\PatientApiController@getPatientDetail');
//end patient

Route::POST('/login', 'Api\AuthController@login');
