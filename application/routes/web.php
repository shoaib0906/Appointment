<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

$this->get('registration', 'Auth\RegisterController@create')->name('auth.register');
$this->post('registration', 'Auth\RegisterController@store')->name('auth.register');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('clients', 'Admin\ClientsController');
    Route::post('clients_mass_destroy', ['uses' => 'Admin\ClientsController@massDestroy', 'as' => 'clients.mass_destroy']);
	Route::get('get-employees', 'Admin\EmployeesController@GetEmployees');
    Route::get('TimeSlot','Admin\AppointmentsController@TimeSlot');


    Route::resource('employees', 'Admin\EmployeesController');
    Route::post('employees_mass_destroy', ['uses' => 'Admin\EmployeesController@massDestroy', 'as' => 'employees.mass_destroy']);
    Route::resource('working_hours', 'Admin\WorkingHoursController');
    Route::post('working_hours_mass_destroy', ['uses' => 'Admin\WorkingHoursController@massDestroy', 'as' => 'working_hours.mass_destroy']);
    Route::resource('appointments', 'Admin\AppointmentsController');
    Route::get('approve_appoint/{id}', ['uses' => 'Admin\AppointmentsController@approve', 'as' => 'appointments.approve']);
    Route::get('reject_appoint/{id}', ['uses' => 'Admin\AppointmentsController@reject', 'as' => 'appointments.reject']);
    

    Route::post('appointments_mass_destroy', ['uses' => 'Admin\AppointmentsController@massDestroy', 'as' => 'appointments.mass_destroy']);
	Route::resource('services', 'Admin\ServicesController');
	Route::post('services_mass_destroy', ['uses' => 'Admin\ServicesController@massDestroy', 'as' => 'services.mass_destroy']);

	
});
Route::get('/login/{social}','Auth\LoginController@socialLogin')
        ->where('social','twitter|facebook|linkedin|google|github');
Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')
        ->where('social','twitter|facebook|linkedin|google|github');  


