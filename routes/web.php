<?php

use Illuminate\Support\Facades\Route;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

Route::GET('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::GET('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE';
});

Route::group(['middleware' => ['auth']], function(){

    Route::GET('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::GET('logout', '\App\Http\Controllers\Auth\LoginController@logout');

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
    Route::GET('definitions/contactforms', 'ContactFormController@index');
    Route::POST('definitions/contactforms/store', 'ContactFormController@store');
    Route::GET('definitions/contactforms/edit/{id}', 'ContactFormController@edit');
    Route::POST('definitions/contactforms/update/{id}', 'ContactFormController@update');
    Route::GET('definitions/contactforms/destroy/{id}', 'ContactFormController@destroy');
    //Contact Forms end

    //Hotels
    Route::GET('definitions/hotels', 'HotelController@index');
    Route::POST('definitions/hotels/store', 'HotelController@store');
    Route::GET('definitions/hotels/edit/{id}', 'HotelController@edit');
    Route::POST('definitions/hotels/update/{id}', 'HotelController@update');
    Route::GET('definitions/hotels/destroy/{id}', 'HotelController@destroy');
    //Hotels end

    //Reservations
    Route::GET('definitions/reservations', 'ReservationController@index');
    Route::POST('definitions/reservations/store', 'ReservationController@store');
    Route::GET('definitions/reservations/edit/{id}', 'ReservationController@edit');
    Route::POST('definitions/reservations/addCustomertoReservation', 'ReservationController@addCustomertoReservation');
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
    //api
    Route::GET('getService/{id}', 'ServiceController@getService');    
    //Services end

    //Therapists
    Route::GET('definitions/therapists', 'TherapistController@index');
    Route::POST('definitions/therapists/store', 'TherapistController@store');
    Route::GET('definitions/therapists/edit/{id}', 'TherapistController@edit');
    Route::POST('definitions/therapists/update/{id}', 'TherapistController@update');
    Route::GET('definitions/therapists/destroy/{id}', 'TherapistController@destroy');
    //Therapists end

    //Discounts
    Route::GET('definitions/discounts', 'DiscountController@index');
    Route::POST('definitions/discounts/store', 'DiscountController@store');
    Route::GET('definitions/discounts/edit/{id}', 'DiscountController@edit');
    Route::POST('definitions/discounts/update/{id}', 'DiscountController@update');
    Route::GET('definitions/discounts/destroy/{id}', 'DiscountController@destroy');
    //api
    Route::GET('getDiscount/{id}', 'DiscountController@getDiscount');  
    //Discounts end

    //Report
    Route::GET('definitions/reports', 'ReportController@index');
    //Report end

});
