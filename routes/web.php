<?php

use Illuminate\Support\Facades\Route;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

Route::GET('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

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
    Route::GET('definitions/users', 'UserController@index')->middleware(['middleware' => 'permission:show users']);
    Route::GET('definitions/users/create', 'UserController@create')->middleware(['middleware' => 'permission:create users']);
    Route::POST('definitions/users/store', 'UserController@store')->middleware(['middleware' => 'permission:create users']);
    Route::GET('definitions/users/edit/{id}', 'UserController@edit')->middleware(['middleware' => 'permission:edit users']);
    Route::POST('definitions/users/update/{id}', 'UserController@update')->middleware(['middleware' => 'permission:edit users']);
    Route::GET('definitions/users/delete/{id}', 'UserController@destroy')->middleware(['middleware' => 'permission:delete users']);

    //Roles and Permissions
    Route::GET('roles', 'RolePermissionController@index')->middleware(['middleware' => 'permission:show roles']);
    Route::GET('roles/create', 'RolePermissionController@create')->middleware(['middleware' => 'permission:create roles']);
    Route::POST('roles/store', 'RolePermissionController@store')->middleware(['middleware' => 'permission:create roles']);
    Route::GET('roles/edit/{id}', 'RolePermissionController@edit')->middleware(['middleware' => 'permission:edit roles']);
    Route::POST('roles/update/{id}', 'RolePermissionController@update')->middleware(['middleware' => 'permission:edit roles']);
    Route::GET('roles/delete/{id}', 'RolePermissionController@destroy')->middleware(['middleware' => 'permission:delete roles']);
    Route::GET('roles/clone/{id}', 'RolePermissionController@cloneRole')->middleware(['middleware' => 'permission:edit roles']);
    //Roles and Permissions end

    //Customers
    Route::GET('definitions/customers', 'CustomersController@index')->middleware(['middleware' => 'permission:show customers']);
    Route::POST('definitions/customers/store', 'CustomersController@store')->middleware(['middleware' => 'permission:create customers']);
    Route::POST('definitions/customers/save', 'CustomersController@save')->middleware(['middleware' => 'permission:create customers']);
    Route::GET('definitions/customers/edit/{id}', 'CustomersController@edit')->middleware(['middleware' => 'permission:edit customers']);
    Route::POST('definitions/customers/update/{id}', 'CustomersController@update')->middleware(['middleware' => 'permission:edit customers']);
    Route::GET('definitions/customers/destroy/{id}', 'CustomersController@destroy')->middleware(['middleware' => 'permission:delete customers']);
    //Customers end

    //Booking Forms
    Route::GET('definitions/bookings', 'BookingFormController@index')->middleware(['middleware' => 'permission:show bookingform']);
    Route::POST('definitions/bookings/change/{id}', 'BookingFormController@changeStatus')->middleware(['middleware' => 'permission:edit bookingform']);
    Route::GET('definitions/bookings/edit/{id}', 'BookingFormController@edit')->middleware(['middleware' => 'permission:edit bookingform']);
    Route::POST('definitions/bookings/update/{id}', 'BookingFormController@update')->middleware(['middleware' => 'permission:edit bookingform']);
    Route::GET('definitions/bookings/destroy/{id}', 'BookingFormController@destroy')->middleware(['middleware' => 'permission:delete bookingform']);
    //Booking Forms end

    //Contact Forms
    Route::GET('definitions/contactforms', 'ContactFormController@index')->middleware(['middleware' => 'permission:show contactform']);
    Route::POST('definitions/contactforms/change/{id}', 'ContactFormController@changeStatus')->middleware(['middleware' => 'permission:edit contactform']);
    Route::GET('definitions/contactforms/edit/{id}', 'ContactFormController@edit')->middleware(['middleware' => 'permission:edit contactform']);
    Route::POST('definitions/contactforms/update/{id}', 'ContactFormController@update')->middleware(['middleware' => 'permission:edit contactform']);
    Route::GET('definitions/contactforms/destroy/{id}', 'ContactFormController@destroy')->middleware(['middleware' => 'permission:delete contactform']);
    //Contact Forms end

    //Hotels
    Route::GET('definitions/hotels', 'HotelController@index')->middleware(['middleware' => 'permission:show hotel']);
    Route::POST('definitions/hotels/store', 'HotelController@store')->middleware(['middleware' => 'permission:create hotel']);
    Route::GET('definitions/hotels/edit/{id}', 'HotelController@edit')->middleware(['middleware' => 'permission:edit hotel']);
    Route::POST('definitions/hotels/update/{id}', 'HotelController@update')->middleware(['middleware' => 'permission:edit hotel']);
    Route::GET('definitions/hotels/destroy/{id}', 'HotelController@destroy')->middleware(['middleware' => 'permission:delete hotel']);
    //Hotels end

    //Payments Types
    Route::GET('definitions/payment_types', 'PaymentTypeController@index')->middleware(['middleware' => 'permission:show payment type']);
    Route::POST('definitions/payment_types/store', 'PaymentTypeController@store')->middleware(['middleware' => 'permission:create payment type']);
    Route::GET('definitions/payment_types/edit/{id}', 'PaymentTypeController@edit')->middleware(['middleware' => 'permission:edit payment type']);
    Route::POST('definitions/payment_types/update/{id}', 'PaymentTypeController@update')->middleware(['middleware' => 'permission:edit payment type']);
    Route::GET('definitions/payment_types/destroy/{id}', 'PaymentTypeController@destroy')->middleware(['middleware' => 'permission:delete payment type']);
    //Payment Types end

    //Reservations
    Route::GET('definitions/reservations', 'ReservationController@index')->middleware(['middleware' => 'permission:show reservation']);
    Route::GET('definitions/reservations/calendar', 'ReservationController@reservationCalendar')->middleware(['middleware' => 'permission:show reservation']);
    Route::GET('definitions/reservations/create', 'ReservationController@create')->middleware(['middleware' => 'permission:create reservation']);
    Route::POST('definitions/reservations/store', 'ReservationController@store')->middleware(['middleware' => 'permission:create reservation']);
    Route::GET('definitions/reservations/edit/{id}', 'ReservationController@edit')->middleware(['middleware' => 'permission:edit reservation']);
    Route::GET('definitions/reservations/download/{id}', 'ReservationController@download')->middleware(['middleware' => 'permission:edit reservation']);
    Route::POST('definitions/reservations/update/{id}', 'ReservationController@update')->middleware(['middleware' => 'permission:edit reservation']);
    Route::POST('definitions/reservations/addCustomertoReservation', 'ReservationController@addCustomertoReservation')->middleware(['middleware' => 'permission:create reservation']);
    //payment type
    Route::POST('definitions/reservations/addPaymentTypetoReservation', 'ReservationController@addPaymentTypetoReservation')->middleware(['middleware' => 'permission:create reservation']);
    Route::GET('definitions/reservations/paymenttype/edit/{id}', 'ReservationController@editPaymentType')->middleware(['middleware' => 'permission:edit reservation']);
    Route::POST('definitions/reservations/paymenttype/update/{id}', 'ReservationController@updatePaymentType')->middleware(['middleware' => 'permission:edit reservation']);
    Route::GET('definitions/reservations/paymenttype/destroy/{id}', 'ReservationController@destroyPaymentType')->middleware(['middleware' => 'permission:delete reservation']);
    //service
    Route::POST('definitions/reservations/addServicetoReservation', 'ReservationController@addServicetoReservation')->middleware(['middleware' => 'permission:create reservation']);
    Route::GET('definitions/reservations/service/edit/{id}', 'ReservationController@editService')->middleware(['middleware' => 'permission:edit reservation']);
    Route::POST('definitions/reservations/service/update/{id}', 'ReservationController@updateService')->middleware(['middleware' => 'permission:edit reservation']);
    Route::GET('definitions/reservations/service/destroy/{id}', 'ReservationController@destroyService')->middleware(['middleware' => 'permission:delete reservation']);
    //therapist
    Route::POST('definitions/reservations/addTherapisttoReservation', 'ReservationController@addTherapisttoReservation')->middleware(['middleware' => 'permission:create reservation']);
    Route::GET('definitions/reservations/therapist/edit/{id}', 'ReservationController@editTherapist')->middleware(['middleware' => 'permission:edit reservation']);
    Route::POST('definitions/reservations/therapist/update/{id}', 'ReservationController@updateTherapist')->middleware(['middleware' => 'permission:edit reservation']);
    Route::GET('definitions/reservations/therapist/destroy/{id}', 'ReservationController@destroyTherapist')->middleware(['middleware' => 'permission:delete reservation']);

    Route::GET('reservationbydate', 'ReservationController@allReservationByDate')->middleware(['middleware' => 'permission:show reservation']);
    Route::GET('definitions/reservations/destroy/{id}', 'ReservationController@destroy')->middleware(['middleware' => 'permission:delete reservation']);
    //Reservations end

    //Sources
    Route::GET('definitions/sources', 'SourceController@index')->middleware(['middleware' => 'permission:show sources']);
    Route::POST('definitions/sources/store', 'SourceController@store')->middleware(['middleware' => 'permission:create sources']);
    Route::GET('definitions/sources/edit/{id}', 'SourceController@edit')->middleware(['middleware' => 'permission:edit sources']);
    Route::POST('definitions/sources/update/{id}', 'SourceController@update')->middleware(['middleware' => 'permission:edit sources']);
    Route::GET('definitions/sources/destroy/{id}', 'SourceController@destroy')->middleware(['middleware' => 'permission:delete sources']);
    //Sources end

    //Form Statuses
    Route::GET('definitions/formstatuses', 'FormStatusesController@index')->middleware(['middleware' => 'permission:show form statuses']);
    Route::POST('definitions/formstatuses/store', 'FormStatusesController@store')->middleware(['middleware' => 'permission:create form statuses']);
    Route::GET('definitions/formstatuses/edit/{id}', 'FormStatusesController@edit')->middleware(['middleware' => 'permission:edit form statuses']);
    Route::POST('definitions/formstatuses/update/{id}', 'FormStatusesController@update')->middleware(['middleware' => 'permission:edit form statuses']);
    Route::GET('definitions/formstatuses/destroy/{id}', 'FormStatusesController@destroy')->middleware(['middleware' => 'permission:delete form statuses']);
    //Form Statuses end

    //Services
    Route::GET('definitions/services', 'ServiceController@index')->middleware(['middleware' => 'permission:show services']);
    Route::POST('definitions/services/store', 'ServiceController@store')->middleware(['middleware' => 'permission:create services']);
    Route::GET('definitions/services/edit/{id}', 'ServiceController@edit')->middleware(['middleware' => 'permission:edit services']);
    Route::POST('definitions/services/update/{id}', 'ServiceController@update')->middleware(['middleware' => 'permission:edit services']);
    Route::GET('definitions/services/destroy/{id}', 'ServiceController@destroy')->middleware(['middleware' => 'permission:delete services']);
    //api
    Route::GET('getService/{id}', 'ServiceController@getService')->middleware(['middleware' => 'permission:show services']);
    //Services end

    //Guides
    Route::GET('definitions/guides', 'GuideController@index')->middleware(['middleware' => 'permission:show guides']);
    Route::POST('definitions/guides/store', 'GuideController@store')->middleware(['middleware' => 'permission:create guides']);
    Route::GET('definitions/guides/edit/{id}', 'GuideController@edit')->middleware(['middleware' => 'permission:edit guides']);
    Route::POST('definitions/guides/update/{id}', 'GuideController@update')->middleware(['middleware' => 'permission:edit guides']);
    Route::GET('definitions/guides/destroy/{id}', 'GuideController@destroy')->middleware(['middleware' => 'permission:delete guides']);
    //Guides end
    
    //Therapists
    Route::GET('definitions/therapists', 'TherapistController@index')->middleware(['middleware' => 'permission:show therapist']);
    Route::POST('definitions/therapists/store', 'TherapistController@store')->middleware(['middleware' => 'permission:create therapist']);
    Route::GET('definitions/therapists/edit/{id}', 'TherapistController@edit')->middleware(['middleware' => 'permission:edit therapist']);
    Route::POST('definitions/therapists/update/{id}', 'TherapistController@update')->middleware(['middleware' => 'permission:edit therapist']);
    Route::GET('definitions/therapists/destroy/{id}', 'TherapistController@destroy')->middleware(['middleware' => 'permission:delete therapist']);
    //Therapists end

    //Discounts
    Route::GET('definitions/discounts', 'DiscountController@index')->middleware(['middleware' => 'permission:show discount']);
    Route::POST('definitions/discounts/store', 'DiscountController@store')->middleware(['middleware' => 'permission:create discount']);
    Route::GET('definitions/discounts/edit/{id}', 'DiscountController@edit')->middleware(['middleware' => 'permission:edit discount']);
    Route::POST('definitions/discounts/update/{id}', 'DiscountController@update')->middleware(['middleware' => 'permission:edit discount']);
    Route::GET('definitions/discounts/destroy/{id}', 'DiscountController@destroy')->middleware(['middleware' => 'permission:delete discount']);
    //api
    Route::GET('getDiscount/{id}', 'DiscountController@getDiscount')->middleware(['middleware' => 'permission:show discount']);
    //Discounts end

    //Report
    Route::GET('reports/reservations', 'ReportController@index');
    Route::GET('reports/payments', 'ReportController@paymentReport');
    Route::GET('reports/comissions', 'ReportController@comissionReport');
    Route::GET('reports/serviceReport', 'ReportController@serviceReport');
    Route::GET('reports/sourceReport', 'ReportController@sourceReport');
    //Report end

});
