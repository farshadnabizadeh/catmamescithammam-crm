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

    Route::GET('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::GET('logout', '\App\Http\Controllers\Auth\LoginController@logout');

    Route::GET('getCurrencies', 'CurrencyController@getCurrencies');

    //Users Operations
    Route::GET('users', 'UserController@index')->middleware(['middleware' => 'permission:show users'])->name('user.index');
    Route::GET('users/create', 'UserController@create')->middleware(['middleware' => 'permission:create users'])->name('user.create');
    Route::POST('users/store', 'UserController@store')->middleware(['middleware' => 'permission:create users'])->name('user.store');
    Route::GET('users/edit/{id}', 'UserController@edit')->middleware(['middleware' => 'permission:edit users'])->name('user.edit');
    Route::POST('users/update/{id}', 'UserController@update')->middleware(['middleware' => 'permission:edit users'])->name('user.update');
    Route::GET('users/delete/{id}', 'UserController@destroy')->middleware(['middleware' => 'permission:delete users'])->name('user.destroy');

    //Roles and Permissions
    Route::GET('roles', 'RolePermissionController@index')->middleware(['middleware' => 'permission:show roles'])->name('role.index');
    Route::GET('roles/create', 'RolePermissionController@create')->middleware(['middleware' => 'permission:create roles'])->name('role.create');
    Route::POST('roles/store', 'RolePermissionController@store')->middleware(['middleware' => 'permission:create roles'])->name('role.store');
    Route::GET('roles/edit/{id}', 'RolePermissionController@edit')->middleware(['middleware' => 'permission:edit roles'])->name('role.edit');
    Route::POST('roles/update/{id}', 'RolePermissionController@update')->middleware(['middleware' => 'permission:edit roles'])->name('role.update');
    Route::GET('roles/delete/{id}', 'RolePermissionController@destroy')->middleware(['middleware' => 'permission:delete roles'])->name('role.destroy');
    Route::GET('roles/clone/{id}', 'RolePermissionController@cloneRole')->middleware(['middleware' => 'permission:edit roles'])->name('role.clone');
    //Roles and Permissions end

    //Customers
    Route::GET('customers', 'CustomersController@index')->middleware(['middleware' => 'permission:show customers'])->name('customer.index');
    Route::POST('customers/store', 'CustomersController@store')->middleware(['middleware' => 'permission:create customers'])->name('customer.store');
    Route::POST('customers/save', 'CustomersController@save')->middleware(['middleware' => 'permission:create customers'])->name('customer.save');
    Route::GET('customers/edit/{id}', 'CustomersController@edit')->middleware(['middleware' => 'permission:edit customers'])->name('customer.edit');
    Route::POST('customers/update/{id}', 'CustomersController@update')->middleware(['middleware' => 'permission:edit customers'])->name('customer.update');
    Route::GET('customers/destroy/{id}', 'CustomersController@destroy')->middleware(['middleware' => 'permission:delete customers'])->name('customer.destroy');
    //Customers end

    //Booking Forms
    Route::GET('bookings', 'BookingFormController@index')->middleware(['middleware' => 'permission:show bookingform'])->name('bookingform.index');
    Route::POST('bookings/change/{id}', 'BookingFormController@changeStatus')->middleware(['middleware' => 'permission:edit bookingform'])->name('bookingform.change');
    Route::GET('bookings/edit/{id}', 'BookingFormController@edit')->middleware(['middleware' => 'permission:edit bookingform'])->name('bookingform.edit');
    Route::GET('bookings/status/{id}', 'BookingFormController@status')->middleware(['middleware' => 'permission:edit bookingform'])->name('bookingform.status');
    Route::POST('bookings/update/{id}', 'BookingFormController@update')->middleware(['middleware' => 'permission:edit bookingform'])->name('bookingform.update');
    Route::GET('bookings/destroy/{id}', 'BookingFormController@destroy')->middleware(['middleware' => 'permission:delete bookingform'])->name('bookingform.destroy');
    //Booking Forms end

    //Contact Forms
    Route::GET('contactforms', 'ContactFormController@index')->middleware(['middleware' => 'permission:show contactform'])->name('contactform.index');
    Route::POST('contactforms/change/{id}', 'ContactFormController@changeStatus')->middleware(['middleware' => 'permission:edit contactform'])->name('contactform.change');
    Route::GET('contactforms/edit/{id}', 'ContactFormController@edit')->middleware(['middleware' => 'permission:edit contactform'])->name('contactform.edit');
    Route::GET('contactforms/status/{id}', 'ContactFormController@status')->middleware(['middleware' => 'permission:edit contactform'])->name('contactform.status');
    Route::POST('contactforms/update/{id}', 'ContactFormController@update')->middleware(['middleware' => 'permission:edit contactform'])->name('contactform.update');
    Route::GET('contactforms/destroy/{id}', 'ContactFormController@destroy')->middleware(['middleware' => 'permission:delete contactform'])->name('contactform.destroy');
    //Contact Forms end

    //Comissions
    Route::POST('addComissiontoReservation', 'ReservationController@addComissiontoReservation');

    //Hotels
    Route::GET('definitions/hotels', 'HotelController@index')->middleware(['middleware' => 'permission:show hotel'])->name('hotel.index');
    Route::POST('definitions/hotels/store', 'HotelController@store')->middleware(['middleware' => 'permission:create hotel'])->name('hotel.store');
    Route::GET('definitions/hotels/edit/{id}', 'HotelController@edit')->middleware(['middleware' => 'permission:edit hotel'])->name('hotel.edit');
    Route::POST('definitions/hotels/update/{id}', 'HotelController@update')->middleware(['middleware' => 'permission:edit hotel'])->name('hotel.update');
    Route::GET('definitions/hotels/destroy/{id}', 'HotelController@destroy')->middleware(['middleware' => 'permission:delete hotel'])->name('hotel.destroy');
    Route::GET('getHotels', 'HotelController@getHotels')->middleware(['middleware' => 'permission:show hotel']);
    //Hotels end

    //Payments Types
    Route::GET('definitions/payment_types', 'PaymentTypeController@index')->middleware(['middleware' => 'permission:show payment type'])->name('paymenttype.index');
    Route::POST('definitions/payment_types/store', 'PaymentTypeController@store')->middleware(['middleware' => 'permission:create payment type'])->name('paymenttype.store');
    Route::GET('definitions/payment_types/edit/{id}', 'PaymentTypeController@edit')->middleware(['middleware' => 'permission:edit payment type'])->name('paymenttype.edit');
    Route::POST('definitions/payment_types/update/{id}', 'PaymentTypeController@update')->middleware(['middleware' => 'permission:edit payment type'])->name('paymenttype.update');
    Route::GET('definitions/payment_types/destroy/{id}', 'PaymentTypeController@destroy')->middleware(['middleware' => 'permission:delete payment type'])->name('paymenttype.destroy');
    //Payment Types end

    //Whatsapp
    Route::GET('whatsappforms', 'WhatsappController@index')->middleware(['middleware' => 'permission:show payment type'])->name('whatsapp.index');
    Route::POST('whatsappforms/store', 'WhatsappController@store')->middleware(['middleware' => 'permission:create payment type'])->name('whatsapp.store');
    Route::GET('whatsappforms/edit/{id}', 'WhatsappController@edit')->middleware(['middleware' => 'permission:edit payment type'])->name('whatsapp.edit');
    Route::POST('whatsappforms/update/{id}', 'WhatsappController@update')->middleware(['middleware' => 'permission:edit payment type'])->name('whatsapp.update');
    Route::GET('whatsappforms/destroy/{id}', 'WhatsappController@destroy')->middleware(['middleware' => 'permission:delete payment type'])->name('whatsapp.destroy');
    //Whatsapp end

    //Reservations
    Route::GET('reservations', 'ReservationController@index')->middleware(['middleware' => 'permission:show reservation'])->name('reservation.index');
    Route::GET('reservations/calendar', 'ReservationController@reservationCalendar')->middleware(['middleware' => 'permission:show reservation'])->name('reservation.calendar');
    Route::GET('reservations/create', 'ReservationController@create')->middleware(['middleware' => 'permission:create reservation'])->name('reservation.create');
    Route::POST('reservations/store', 'ReservationController@store')->middleware(['middleware' => 'permission:create reservation'])->name('reservation.store');
    Route::GET('reservations/edit/{id}', 'ReservationController@edit')->middleware(['middleware' => 'permission:edit reservation'])->name('reservation.edit');
    Route::GET('reservations/download/{id}', 'ReservationController@download')->middleware(['middleware' => 'permission:edit reservation'])->name('reservation.download');
    Route::POST('reservations/update/{id}', 'ReservationController@update')->middleware(['middleware' => 'permission:edit reservation'])->name('reservation.update');
    Route::GET('reservations/destroy/{id}', 'ReservationController@destroy')->middleware(['middleware' => 'permission:delete reservation'])->name('reservation.delete');
    Route::POST('reservations/addCustomertoReservation', 'ReservationController@addCustomertoReservation')->middleware(['middleware' => 'permission:create reservation']);

    //payment type
    Route::POST('reservations/addPaymentTypetoReservation', 'ReservationController@addPaymentTypetoReservation')->middleware(['middleware' => 'permission:create reservation']);
    Route::GET('reservations/paymenttype/edit/{id}', 'ReservationController@editPaymentType')->middleware(['middleware' => 'permission:edit reservation'])->name('reservation.paymenttype.edit');
    Route::POST('reservations/paymenttype/update/{id}', 'ReservationController@updatePaymentType')->middleware(['middleware' => 'permission:edit reservation'])->name('reservation.paymenttype.update');
    Route::GET('reservations/paymenttype/destroy/{id}', 'ReservationController@destroyPaymentType')->middleware(['middleware' => 'permission:delete reservation'])->name('reservation.paymenttype.destroy');

    //service
    Route::POST('reservations/addServicetoReservation', 'ReservationController@addServicetoReservation')->middleware(['middleware' => 'permission:create reservation']);
    Route::GET('reservations/service/edit/{id}', 'ReservationController@editService')->middleware(['middleware' => 'permission:edit reservation'])->name('reservation.service.edit');
    Route::POST('reservations/service/update/{id}', 'ReservationController@updateService')->middleware(['middleware' => 'permission:edit reservation'])->name('reservation.service.update');
    Route::GET('reservations/service/destroy/{id}', 'ReservationController@destroyService')->middleware(['middleware' => 'permission:delete reservation'])->name('reservation.service.destroy');

    //therapist
    Route::POST('reservations/addTherapisttoReservation', 'ReservationController@addTherapisttoReservation')->middleware(['middleware' => 'permission:create reservation']);
    Route::GET('reservations/therapist/edit/{id}', 'ReservationController@editTherapist')->middleware(['middleware' => 'permission:edit reservation'])->name('reservation.therapist.edit');
    Route::POST('reservations/therapist/update/{id}', 'ReservationController@updateTherapist')->middleware(['middleware' => 'permission:edit reservation'])->name('reservation.therapist.update');
    Route::GET('reservations/therapist/destroy/{id}', 'ReservationController@destroyTherapist')->middleware(['middleware' => 'permission:delete reservation'])->name('reservation.therapist.destroy');
    //commissions
    Route::POST('reservations/addComissiontoReservation', 'ReservationController@addComissiontoReservation')->middleware(['middleware' => 'permission:create reservation']);

    //hotel comission
    Route::GET('reservations/hotelComission/edit/{id}', 'ReservationController@editHotelComission')->middleware(['middleware' => 'permission:edit reservation'])->name('reservation.hotelcomission.edit');
    Route::POST('reservations/hotelComission/update/{id}', 'ReservationController@updateHotelComission')->middleware(['middleware' => 'permission:edit reservation'])->name('reservation.hotelcomission.update');
    Route::GET('reservations/hotelComission/destroy/{id}', 'ReservationController@destroyHotelComission')->middleware(['middleware' => 'permission:edit reservation'])->name('reservation.hotelcomission.destroy');

    //guide comission
    Route::GET('reservations/guideComission/edit/{id}', 'ReservationController@editGuideComission')->middleware(['middleware' => 'permission:edit reservation'])->name('reservation.guidecomission.edit');
    Route::POST('reservations/guideComission/update/{id}', 'ReservationController@updateGuideComission')->middleware(['middleware' => 'permission:edit reservation'])->name('reservation.guidecomission.update');
    Route::GET('reservations/guideComission/destroy/{id}', 'ReservationController@destroyGuideComission')->middleware(['middleware' => 'permission:edit reservation'])->name('reservation.guidecomission.destroy');

    Route::GET('reservationbydate', 'ReservationController@allReservationByDate')->middleware(['middleware' => 'permission:show reservation']);
    Route::GET('reservations/destroy/{id}', 'ReservationController@destroy')->middleware(['middleware' => 'permission:delete reservation']);
    //Reservations end

    //Sources
    Route::GET('definitions/sources', 'SourceController@index')->middleware(['middleware' => 'permission:show sources'])->name('source.index');
    Route::POST('definitions/sources/store', 'SourceController@store')->middleware(['middleware' => 'permission:create sources'])->name('source.store');
    Route::GET('definitions/sources/edit/{id}', 'SourceController@edit')->middleware(['middleware' => 'permission:edit sources'])->name('source.edit');
    Route::POST('definitions/sources/update/{id}', 'SourceController@update')->middleware(['middleware' => 'permission:edit sources'])->name('source.update');
    Route::GET('definitions/sources/destroy/{id}', 'SourceController@destroy')->middleware(['middleware' => 'permission:delete sources'])->name('source.destroy');
    //Sources end

    //Form Statuses
    Route::GET('definitions/formstatuses', 'FormStatusesController@index')->middleware(['middleware' => 'permission:show form statuses'])->name('formstatus.index');
    Route::POST('definitions/formstatuses/store', 'FormStatusesController@store')->middleware(['middleware' => 'permission:create form statuses'])->name('formstatus.store');
    Route::GET('definitions/formstatuses/edit/{id}', 'FormStatusesController@edit')->middleware(['middleware' => 'permission:edit form statuses'])->name('formstatus.edit');
    Route::POST('definitions/formstatuses/update/{id}', 'FormStatusesController@update')->middleware(['middleware' => 'permission:edit form statuses'])->name('formstatus.update');
    Route::GET('definitions/formstatuses/destroy/{id}', 'FormStatusesController@destroy')->middleware(['middleware' => 'permission:delete form statuses'])->name('formstatus.destroy');
    //Form Statuses end

    //Services
    Route::GET('definitions/services', 'ServiceController@index')->middleware(['middleware' => 'permission:show services'])->name('service.index');
    Route::POST('definitions/services/store', 'ServiceController@store')->middleware(['middleware' => 'permission:create services'])->name('service.store');
    Route::GET('definitions/services/edit/{id}', 'ServiceController@edit')->middleware(['middleware' => 'permission:edit services'])->name('service.edit');
    Route::POST('definitions/services/update/{id}', 'ServiceController@update')->middleware(['middleware' => 'permission:edit services'])->name('service.update');
    Route::GET('definitions/services/destroy/{id}', 'ServiceController@destroy')->middleware(['middleware' => 'permission:delete services'])->name('service.destroy');
    //api
    Route::GET('getService/{id}', 'ServiceController@getService')->middleware(['middleware' => 'permission:show services']);
    //Services end

    //Guides
    Route::GET('definitions/guides', 'GuideController@index')->middleware(['middleware' => 'permission:show guides'])->name('guide.index');
    Route::POST('definitions/guides/store', 'GuideController@store')->middleware(['middleware' => 'permission:create guides'])->name('guide.store');
    Route::GET('definitions/guides/edit/{id}', 'GuideController@edit')->middleware(['middleware' => 'permission:edit guides'])->name('guide.edit');
    Route::POST('definitions/guides/update/{id}', 'GuideController@update')->middleware(['middleware' => 'permission:edit guides'])->name('guide.update');
    Route::GET('definitions/guides/destroy/{id}', 'GuideController@destroy')->middleware(['middleware' => 'permission:delete guides'])->name('guide.destroy');
    Route::GET('getGuides', 'GuideController@getGuides')->middleware(['middleware' => 'permission:show guides']);
    //Guides end

    //Sales Persons
    Route::GET('definitions/salespersons', 'SalesPersonController@index')->middleware(['middleware' => 'permission:show therapist'])->name('salesperson.index');
    Route::POST('definitions/salespersons/store', 'SalesPersonController@store')->middleware(['middleware' => 'permission:create therapist'])->name('salesperson.store');
    Route::GET('definitions/salespersons/edit/{id}', 'SalesPersonController@edit')->middleware(['middleware' => 'permission:edit therapist'])->name('salesperson.edit');
    Route::POST('definitions/salespersons/update/{id}', 'SalesPersonController@update')->middleware(['middleware' => 'permission:edit therapist'])->name('salesperson.update');
    Route::GET('definitions/salespersons/destroy/{id}', 'SalesPersonController@destroy')->middleware(['middleware' => 'permission:delete therapist'])->name('salesperson.destroy');
    //Sales Persons end

    //Therapists
    Route::GET('definitions/therapists', 'TherapistController@index')->middleware(['middleware' => 'permission:show therapist'])->name('therapist.index');
    Route::POST('definitions/therapists/store', 'TherapistController@store')->middleware(['middleware' => 'permission:create therapist'])->name('therapist.store');
    Route::GET('definitions/therapists/edit/{id}', 'TherapistController@edit')->middleware(['middleware' => 'permission:edit therapist'])->name('therapist.edit');
    Route::POST('definitions/therapists/update/{id}', 'TherapistController@update')->middleware(['middleware' => 'permission:edit therapist'])->name('therapist.update');
    Route::GET('definitions/therapists/destroy/{id}', 'TherapistController@destroy')->middleware(['middleware' => 'permission:delete therapist'])->name('therapist.destroy');
    //Therapists end

    //Discounts
    Route::GET('definitions/discounts', 'DiscountController@index')->middleware(['middleware' => 'permission:show discount'])->name('discount.index');
    Route::POST('definitions/discounts/store', 'DiscountController@store')->middleware(['middleware' => 'permission:create discount'])->name('discount.store');
    Route::GET('definitions/discounts/edit/{id}', 'DiscountController@edit')->middleware(['middleware' => 'permission:edit discount'])->name('discount.edit');
    Route::POST('definitions/discounts/update/{id}', 'DiscountController@update')->middleware(['middleware' => 'permission:edit discount'])->name('discount.update');
    Route::GET('definitions/discounts/destroy/{id}', 'DiscountController@destroy')->middleware(['middleware' => 'permission:delete discount'])->name('discount.destroy');
    //api
    Route::GET('getDiscount/{id}', 'DiscountController@getDiscount')->middleware(['middleware' => 'permission:show discount']);
    //Discounts end

    //Report
    Route::GET('reports', 'ReportController@index')->name('report.index');
    Route::GET('reports/reservations', 'ReportController@reservationReport')->name('report.reservation');
    Route::GET('reports/payments', 'ReportController@paymentReport')->name('report.payment');
    Route::GET('reports/comissions', 'ReportController@comissionReport')->name('report.comission');
    Route::GET('reports/serviceReport', 'ReportController@serviceReport')->name('report.service');
    Route::GET('reports/therapistReport', 'ReportController@therapistReport')->name('report.therapist');
    Route::GET('reports/sourceReport', 'ReportController@sourceReport')->name('report.source');
    Route::GET('reports/comissionReport', 'ReportController@comissionReport')->name('report.comissions');

    //Report end

});
