<?php

use Illuminate\Support\Facades\Route;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE';
});

Route::group(['middleware' => ['auth']], function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

    Route::GET('getCurrencies', 'CurrencyController@getCurrencies');

    //Users Operations
    Route::GET('definitions/users', 'UserController@index');
    Route::GET('definitions/users/create', 'UserController@create');
    Route::POST('definitions/users/store', 'UserController@store');
    Route::GET('definitions/users/edit/{id}', 'UserController@edit');
    Route::POST('definitions/users/update/{id}', 'UserController@update');
    Route::GET('definitions/users/delete/{id}', 'UserController@destroy');

    //Customers
    Route::GET('definitions/customers', 'CustomersController@index');
    Route::POST('definitions/customers/store', 'CustomersController@store');
    Route::GET('getMedicalDepartment', 'CustomersController@getMedicalDepartment');
    Route::GET('getuserName', 'CustomersController@getUserName');
    Route::GET('definitions/customers/edit/{id}', 'CustomersController@edit');
    Route::POST('definitions/customers/update/{id}', 'CustomersController@update');
    Route::GET('definitions/customers/destroy/{id}', 'CustomersController@destroy');
    //Customers end

    //Contact Forms
    Route::GET('definitions/forms', 'FormController@index');
    Route::POST('definitions/forms/store', 'FormController@store');
    Route::GET('getMedicalDepartment', 'FormController@getMedicalDepartment');
    Route::GET('getuserName', 'FormController@getUserName');
    Route::GET('definitions/forms/edit/{id}', 'FormController@edit');
    Route::POST('definitions/forms/update/{id}', 'FormController@update');
    Route::GET('definitions/forms/destroy/{id}', 'FormController@destroy');
    //Contact Forms end

    //Reservations
    Route::GET('definitions/reservations', 'ReservationController@index');
    Route::POST('definitions/reservations/store', 'ReservationController@store');
    Route::GET('definitions/reservations/edit/{id}', 'ReservationController@edit');
    Route::POST('definitions/reservations/update/{id}', 'ReservationController@update');
    Route::GET('definitions/reservations/destroy/{id}', 'ReservationController@destroy');
    //Reservations end

    //Sources
    Route::GET('definitions/sources', 'SourceController@index');
    Route::POST('definitions/sources/store', 'SourceController@store');
    Route::GET('definitions/sources/edit/{id}', 'SourceController@edit');
    Route::POST('definitions/sources/update/{id}', 'SourceController@update');
    Route::GET('definitions/sources/destroy/{id}', 'SourceController@destroy');
    //Sources end

    //Services
    Route::GET('definitions/services', 'ServiceController@index');
    Route::POST('definitions/services/store', 'ServiceController@store');
    Route::GET('definitions/services/edit/{id}', 'ServiceController@edit');
    Route::POST('definitions/services/update/{id}', 'ServiceController@update');
    Route::GET('definitions/services/destroy/{id}', 'ServiceController@destroy');
    //Services end

    //Therapists
    Route::GET('definitions/therapists', 'TherapistController@index');
    Route::POST('definitions/therapists/store', 'TherapistController@store');
    Route::GET('definitions/therapists/edit/{id}', 'TherapistController@edit');
    Route::POST('definitions/therapists/update/{id}', 'TherapistController@update');
    Route::GET('definitions/therapists/destroy/{id}', 'TherapistController@destroy');
    //Therapists end

    //Report
    Route::GET('definitions/reports', 'ReportController@index');
    //Report end

});
