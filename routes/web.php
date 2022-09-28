<?php

use Illuminate\Support\Facades\Route;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE';
});

Route::group(['middleware' => ['auth']], function(){

    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::GET('getCurrencies', 'CurrencyController@getCurrencies');
    Route::GET('hasRole', 'UserController@hasRole');

    //Calendar Operations
    Route::GET('calendar', 'TreatmentPlanController@calendar')->middleware(['middleware' => 'permission:show approval calendar'])->name('approval_calendar.index');
    Route::GET('bydate', 'TreatmentPlanController@allTreatmentPlanByDate')->middleware(['middleware' => 'permission:show approval calendar']);
    Route::GET('operationcalendar', 'TreatmentPlanController@operationcalendar')->middleware(['middleware' => 'permission:show operation calendar'])->name('operation_calendar.index');
    Route::GET('operationbydate', 'TreatmentPlanController@allOperationByDate')->middleware(['middleware' => 'permission:show operation calendar']);
    Route::GET('operationbydate/edit/{id}', 'TreatmentPlanController@editOperationDates')->middleware(['middleware' => 'permission:edit operation date']);
    Route::GET('operation/cancel/{id}', 'TreatmentPlanController@cancelOperation')->middleware(['middleware' => 'permission:cancel operation']);

    //Users Operations
    Route::GET('definitions/users', 'UserController@index')->middleware(['middleware' => 'permission:show users'])->name('user.index');
    Route::POST('definitions/users/store', 'UserController@store')->middleware(['middleware' => 'permission:create users'])->name('user.store');
    Route::GET('definitions/users/edit/{id}', 'UserController@edit')->middleware(['middleware' => 'permission:edit users'])->name('user.edit');
    Route::POST('definitions/users/update/{id}', 'UserController@update')->middleware(['middleware' => 'permission:edit users'])->name('user.update');
    Route::GET('definitions/users/delete/{id}', 'UserController@destroy')->middleware(['middleware' => 'permission:delete users'])->name('user.destroy');

    //Roles and Permissions
    Route::GET('roles', 'RolePermissionController@index')->middleware(['middleware' => 'permission:show roles'])->name('role.index');
    Route::GET('roles/create', 'RolePermissionController@create')->middleware(['middleware' => 'permission:create roles'])->name('role.create');
    Route::POST('roles/store', 'RolePermissionController@store')->middleware(['middleware' => 'permission:create roles'])->name('role.store');
    Route::GET('roles/edit/{id}', 'RolePermissionController@edit')->middleware(['middleware' => 'permission:edit roles'])->name('role.edit');
    Route::POST('roles/update/{id}', 'RolePermissionController@update')->middleware(['middleware' => 'permission:edit roles'])->name('role.update');
    Route::GET('roles/delete/{id}', 'RolePermissionController@destroy')->middleware(['middleware' => 'permission:delete roles'])->name('role.destroy');
    Route::GET('roles/clone/{id}', 'RolePermissionController@cloneRole')->middleware(['middleware' => 'permission:edit roles']);
    //Roles and Permissions end

    //Reports
    Route::GET('userReport', 'ReportController@userReport')->middleware(['middleware' => 'permission:show user report']);
    Route::GET('treatmentReport', 'ReportController@treatmentReport')->middleware(['middleware' => 'permission:show treatment report']);
    Route::GET('logs', 'LogController@index')->middleware(['middleware' => 'permission:show logs']);
    //Reports end

    //Medical Department
    Route::GET('definitions/medicalDepartments', 'MedicalDepartmentController@index')->middleware(['middleware' => 'permission:show medical department'])->name('medicaldepartment.index');
    Route::POST('definitions/medicalDepartment/store', 'MedicalDepartmentController@store')->middleware(['middleware' => 'permission:create medical department'])->name('medicaldepartment.store');
    Route::GET('definitions/medicalDepartment/edit/{id}', 'MedicalDepartmentController@edit')->middleware(['middleware' => 'permission:edit medical department'])->name('medicaldepartment.edit');
    Route::POST('definitions/medicalDepartment/update/{id}', 'MedicalDepartmentController@update')->middleware(['middleware' => 'permission:edit medical department'])->name('medicaldepartment.update');
    Route::GET('definitions/medicalDepartment/destroy/{id}', 'MedicalDepartmentController@destroy')->middleware(['middleware' => 'permission:delete medical department'])->name('medicaldepartment.destroy');
    //Medical Department end

    //Medical Sub Department
    Route::GET('definitions/medicalSubDepartment', 'MedicalSubDepartmentController@index')->middleware(['middleware' => 'permission:show medical sub department'])->name('medicalsubdepartment.index');
    Route::POST('definitions/medicalSubDepartment/store', 'MedicalSubDepartmentController@store')->middleware(['middleware' => 'permission:create medical sub department'])->name('medicalsubdepartment.store');
    Route::GET('definitions/medicalSubDepartment/edit/{id}', 'MedicalSubDepartmentController@edit')->middleware(['middleware' => 'permission:edit medical sub department'])->name('medicalsubdepartment.edit');
    Route::POST('definitions/medicalSubDepartment/update/{id}', 'MedicalSubDepartmentController@update')->middleware(['middleware' => 'permission:edit medical sub department'])->name('medicalsubdepartment.update');
    Route::GET('definitions/medicalSubDepartment/destroy/{id}', 'MedicalSubDepartmentController@destroy')->middleware(['middleware' => 'permission:delete medical sub department'])->name('medicalsubdepartment.destroy');
    //Medical Sub Department end

    //Lead Sources
    Route::GET('definitions/leadsources', 'LeadSourceController@index')->middleware(['middleware' => 'permission:show lead source'])->name('leadsource.index');
    Route::POST('definitions/leadsources/store', 'LeadSourceController@store')->middleware(['middleware' => 'permission:create lead source'])->name('leadsource.store');
    Route::GET('definitions/leadsources/edit/{id}', 'LeadSourceController@edit')->middleware(['middleware' => 'permission:edit lead source'])->name('leadsource.edit');
    Route::POST('definitions/leadsources/update/{id}', 'LeadSourceController@update')->middleware(['middleware' => 'permission:edit lead source'])->name('leadsource.update');
    Route::GET('definitions/leadsources/destroy/{id}', 'LeadSourceController@destroy')->middleware(['middleware' => 'permission:delete lead source'])->name('leadsource.destroy');
    //Lead Sources

    //Discount
    Route::GET('definitions/discount', 'DiscountController@index')->middleware(['middleware' => 'permission:show discount'])->name('discount.index');
    Route::POST('definitions/discount/store', 'DiscountController@store')->middleware(['middleware' => 'permission:create discount'])->name('discount.store');
    Route::GET('definitions/discount/edit/{id}', 'DiscountController@edit')->middleware(['middleware' => 'permission:edit discount'])->name('discount.edit');
    Route::POST('definitions/discount/update/{id}', 'DiscountController@update')->middleware(['middleware' => 'permission:edit discount'])->name('discount.update');
    Route::GET('definitions/discount/destroy/{id}', 'DiscountController@destroy')->middleware(['middleware' => 'permission:delete discount'])->name('discount.destroy');
    //Discount

    //Countries
    Route::GET('definitions/countries', 'CountryController@index')->middleware(['middleware' => 'permission:show country'])->name('country.index');
    Route::POST('definitions/countries/store', 'CountryController@store')->middleware(['middleware' => 'permission:create country'])->name('country.store');
    Route::GET('definitions/countries/edit/{id}', 'CountryController@edit')->middleware(['middleware' => 'permission:edit country'])->name('country.edit');
    Route::POST('definitions/countries/update/{id}', 'CountryController@update')->middleware(['middleware' => 'permission:edit country'])->name('country.update');
    Route::GET('definitions/countries/destroy/{id}', 'CountryController@destroy')->middleware(['middleware' => 'permission:delete country'])->name('country.destroy');
    //Countries

    //Treatment
    Route::GET('definitions/treatments', 'TreatmentController@index')->middleware(['middleware' => 'permission:show treatment'])->name('treatment.index');
    Route::POST('definitions/treatments/store', 'TreatmentController@store')->middleware(['middleware' => 'permission:create treatment'])->name('treatment.store');
    Route::GET('definitions/treatments/edit/{id}', 'TreatmentController@edit')->middleware(['middleware' => 'permission:edit treatment'])->name('treatment.edit');
    Route::POST('definitions/treatments/update/{id}', 'TreatmentController@update')->middleware(['middleware' => 'permission:edit treatment'])->name('treatment.update');
    Route::GET('definitions/treatments/destroy/{id}', 'TreatmentController@destroy')->middleware(['middleware' => 'permission:delete treatment'])->name('treatment.destroy');
    //Treatment

    //Treatment Plan
    Route::POST('treatmentplans/store', 'TreatmentPlanController@store')->middleware(['middleware' => 'permission:create treatment plan'])->name('treatmentplan.store');
    Route::POST('treatmentplans/post/{id}', 'TreatmentPlanController@post');
    Route::GET('treatmentplans/create', 'TreatmentPlanController@create')->middleware(['middleware' => 'permission:create treatment plan'])->name('treatmentplan.create');
    Route::POST('treatmentplans/sendNotification', 'TreatmentPlanController@sendNotification')->middleware(['middleware' => 'permission:edit treatment plan']);
    Route::POST('changeTreatmentPlanDates/{id}', 'TreatmentPlanController@changeTreatmentPlanDates')->middleware(['middleware' => 'permission:change treatment plan dates']);
    Route::GET('treatmentplans/requested', 'TreatmentPlanController@requested')->middleware(['middleware' => 'permission:show requested treatment plan'])->name('treatmentplan.requested');
    Route::GET('treatmentplans/reconsult', 'TreatmentPlanController@reconsult')->middleware(['middleware' => 'permission:show reconsult treatment plan'])->name('treatmentplan.reconsult');
    Route::GET('treatmentplans/completed', 'TreatmentPlanController@completed')->middleware(['middleware' => 'permission:show completed treatment plan'])->name('treatmentplan.completed');
    Route::GET('treatmentplans/ticketreceived', 'TreatmentPlanController@ticketreceived')->middleware(['middleware' => 'permission:show ticket received'])->name('treatmentplan.ticketreceived');
    Route::GET('treatmentplans/edit/{id}', 'TreatmentPlanController@edit')->middleware(['middleware' => 'permission:edit treatment plan'])->name('treatmentplan.edit');
    Route::GET('treatmentplans/download/{id}', 'TreatmentPlanController@download')->middleware(['middleware' => 'permission:download treatment plan']);
    Route::POST('treatmentplans/update/{id}', 'TreatmentPlanController@update')->middleware(['middleware' => 'permission:edit treatment plan'])->name('treatmentplan.update');
    Route::POST('treatmentplans/updateOperationDate/{id}', 'TreatmentPlanController@updateOperationDate')->middleware(['middleware' => 'permission:edit treatment plan']);
    Route::GET('treatmentplans/destroy/{id}', 'TreatmentPlanController@destroy')->middleware(['middleware' => 'permission:delete treatment plan'])->name('treatmentplan.destroy');
    //Treatment Plan

    //Treatment Plan Status
    Route::GET('definitions/treatmentplanstatus', 'TreatmentPlanStatusController@index')->middleware(['middleware' => 'permission:show treatment plan status'])->name('treatmentplanstatus.index');
    Route::POST('definitions/treatmentplanstatus/store', 'TreatmentPlanStatusController@store')->middleware(['middleware' => 'permission:create treatment plan status'])->name('treatmentplanstatus.store');
    Route::GET('definitions/treatmentplanstatus/create', 'TreatmentPlanStatusController@create')->middleware(['middleware' => 'permission:create treatment plan status'])->name('treatmentplanstatus.create');
    Route::GET('definitions/treatmentplanstatus/edit/{id}', 'TreatmentPlanStatusController@edit')->middleware(['middleware' => 'permission:edit treatment plan status'])->name('treatmentplanstatus.edit');
    Route::POST('definitions/treatmentplanstatus/update/{id}', 'TreatmentPlanStatusController@update')->middleware(['middleware' => 'permission:edit treatment plan status'])->name('treatmentplanstatus.update');
    Route::GET('definitions/treatmentplanstatus/destroy/{id}', 'TreatmentPlanStatusController@destroy')->middleware(['middleware' => 'permission:delete treatment plan status'])->name('treatmentplanstatus.destroy');
    //Treatment Plan Status

    //Patients
    Route::GET('patients', 'PatientController@index')->middleware(['middleware' => 'permission:show patient'])->name('patient.index');
    Route::POST('patients/store', 'PatientController@store')->middleware(['middleware' => 'permission:create patient'])->name('patient.store');
    Route::POST('patients/createPatient', 'PatientController@createPatient')->middleware(['middleware' => 'permission:create patient']);
    Route::GET('patients/create', 'PatientController@create')->middleware(['middleware' => 'permission:create patient'])->name('patient.create');
    Route::GET('patients/edit/{id}', 'PatientController@edit')->middleware(['middleware' => 'permission:edit patient'])->name('patient.edit');
    Route::POST('patients/update/{id}', 'PatientController@update')->middleware(['middleware' => 'permission:edit patient'])->name('patient.update');
    Route::GET('patients/destroy/{id}', 'PatientController@destroy')->middleware(['middleware' => 'permission:delete patient'])->name('patient.destroy');
    //Patients

    //Sales Persons
    Route::GET('definitions/salespersons', 'SalesPersonController@index')->middleware(['middleware' => 'permission:show sales person'])->name('salesperson.index');
    Route::POST('definitions/salespersons/store', 'SalesPersonController@store')->middleware(['middleware' => 'permission:create sales person'])->name('salesperson.store');
    Route::GET('definitions/salespersons/edit/{id}', 'SalesPersonController@edit')->middleware(['middleware' => 'permission:edit sales person'])->name('salesperson.edit');
    Route::POST('definitions/salespersons/update/{id}', 'SalesPersonController@update')->middleware(['middleware' => 'permission:edit sales person'])->name('salesperson.update');
    Route::GET('definitions/salespersons/destroy/{id}', 'SalesPersonController@destroy')->middleware(['middleware' => 'permission:delete sales person'])->name('salesperson.destroy');
    //Sales Persons

    //Agents
    Route::GET('definitions/agents', 'AgentController@index')->middleware(['middleware' => 'permission:show agent'])->name('agent.index');
    Route::POST('definitions/agents/store', 'AgentController@store')->middleware(['middleware' => 'permission:create agent'])->name('agent.store');
    Route::GET('definitions/agents/edit/{id}', 'AgentController@edit')->middleware(['middleware' => 'permission:edit agent'])->name('agent.edit');
    Route::POST('definitions/agents/update/{id}', 'AgentController@update')->middleware(['middleware' => 'permission:edit agent'])->name('agent.update');
    Route::GET('definitions/agents/destroy/{id}', 'AgentController@destroy')->middleware(['middleware' => 'permission:delete agent'])->name('agent.destroy');
    //Agents

    Route::POST('files/store', 'TreatmentPlanPhotosController@store')->middleware(['middleware' => 'permission:upload file'])->name('file.store');
    Route::GET('files/destroy/{id}', 'TreatmentPlanPhotosController@destroy')->middleware(['middleware' => 'permission:delete file'])->name('file.destroy');

    Route::GET('view-qr-code', 'QRController@view');
});
