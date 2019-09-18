<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {


	//if (Auth::guard('web')->check()){
		//return redirect()->route('home');
	//}
	//else{
	//	return view('welcome');
		//return view('auth.login');
	//}
	
    //return view('welcome');
//});
Route::get('/', 'SettingController@index')->name('sitesetting');
Route::get('/activate', 'SettingController@activate')->name('activate');
Route::post('/activate', 'SettingController@store')->name('storesetting');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/ban', 'HomeController@ban')->name('ban');
Route::get('/userban', 'HomeController@userban')->name('userban');

Route::get('/profile', 'HomeController@profile')->name('profile');

//Doctors
Route::get('/alldoctors', 'HomeController@alldoctors')->name('alldoctors');
Route::get('/doctors', 'HomeController@doctors')->name('doctors');
Route::get('/doctorschedule', 'DoctorController@doctorschedule')->name('doctorschedule');
Route::post('/updateschedule', 'DoctorController@updateschedule')->name('updateschedule');
Route::put('/updateschedule', 'DoctorController@updateschedule')->name('updateschedule');
Route::post('/doctors', 'HomeController@storedoctor')->name('storedoctor');
Route::delete('/deletedoctor/{id}', 'DoctorController@destroy')->name('deletedoctor');

//Patients
Route::get('/allpatients', 'HomeController@allpatients')->name('allpatients');
Route::get('/patients', 'HomeController@patients')->name('patients');
Route::post('/patients', 'HomeController@storepatient')->name('storepatient');
Route::get('/viewpatient', 'HomeController@viewpatient')->name('viewpatient');
Route::get('/editpatient', 'HomeController@editpatient')->name('editpatient');
Route::post('/editpatient', 'HomeController@updatepatient')->name('storeeditpatient');
Route::put('/editpatient', 'HomeController@updatepatient')->name('storeeditpatient');
Route::delete('/deletepatient/{id}', 'patientController@destroy')->name('deletepatient');

//Departments
Route::get('/alldepartments', 'DepartmentController@index')->name('alldepartments');
Route::get('/departments', 'DepartmentController@create')->name('departments');
Route::post('/departments', 'DepartmentController@store')->name('storedepartment');
Route::delete('/deletedepartment/{id}', 'DepartmentController@destroy')->name('deletedepartment');

//Wards
Route::get('/wards', 'WardController@index')->name('ward');
Route::get('/addward', 'WardController@create')->name('addward');
Route::post('/addward', 'WardController@store')->name('storeward');
Route::delete('/deleteward/{id}', 'WardController@destroy')->name('deleteward');

//Beds
Route::get('/beds', 'bedController@index')->name('bed');
Route::get('/viewbedorder', 'HomeController@viewbedorder')->name('viewbedorder');
Route::post('/viewbedorder', 'HomeController@storebedorder')->name('storebedorder');
Route::get('/admission', 'HomeController@admission')->name('admission');
Route::get('/addbed', 'bedController@create')->name('addbed');
Route::post('/addbed', 'bedController@store')->name('storebed');
Route::delete('/deletebed/{id}', 'bedController@destroy')->name('deletebed');

//Nurse
Route::get('/addstaff', 'HomeController@addstaff')->name('addstaff');
Route::get('/stafflist', 'HomeController@stafflist')->name('stafflist');
Route::post('/addbed', 'bedController@store')->name('storebed');
Route::delete('/deletebed/{id}', 'bedController@destroy')->name('deletebed');

//Report
Route::get('/report', 'HomeController@report')->name('report');
Route::get('/addreport', 'HomeController@addreport')->name('addreport');
Route::post('/addreport', 'HomeController@storereport')->name('storereport');
Route::get('/viewreport', 'HomeController@viewreport')->name('viewreport');

//Lab
Route::get('/laborders', 'LabController@index')->name('laborders');
Route::post('/laborders', 'LabController@store')->name('storeorders');
Route::get('/labreports', 'LabController@create')->name('labreports');
Route::get('/viewlab', 'LabController@show')->name('viewlab');

//Drug
Route::get('/alldrugs', 'DrugController@index')->name('alldrugs');
Route::post('/alldrugs', 'DrugController@store')->name('storedrug');
Route::get('/addcart/{id}', 'DrugController@addcart')->name('product.addToCart');
Route::get('/reduce/{id}', 'DrugController@getReduceByOne')->name('product.reduceByOne');
Route::get('/remove/{id}', 'DrugController@getRemoveItem')->name('product.remove');
Route::get('/shoppingcart', 'DrugController@shoppingcart')->name('shoppingcart');
Route::post('/shoppingcart', 'DrugController@checkout')->name('checkout');
Route::get('/orders', 'DrugController@orders')->name('orders');
Route::get('/vieworders', 'DrugController@vieworders')->name('vieworders');
Route::get('/prescription', 'DrugController@prescription')->name('prescription');
Route::get('/drugcat', 'MedicatController@index')->name('drugcat');
Route::post('/drugcat', 'MedicatController@store')->name('storecat');
Route::delete('/deletedrug/{id}', 'DrugController@destroy')->name('deletedug');
Route::delete('/deletecat/{id}', 'MedicatController@destroy')->name('deletecat');
Route::post('/editdrugcat', 'MedicatController@update')->name('category.update');
Route::put('/editdrugcat', 'MedicatController@update')->name('category.update');
Route::get('/drugsale', 'DrugController@drugsale')->name('drugsale');

//Password
Route::get('/password', 'HomeController@passwordget')->name('passwordget');
Route::post('/password', 'HomeController@password')->name('changepassword');

//Billing Service
Route::get('/servicelist', 'ServiceController@index')->name('service.index');
Route::get('/editservice', 'ServiceController@edit')->name('service.edit');
Route::post('/editservice', 'ServiceController@update')->name('service.update');
Route::put('/editservice', 'ServiceController@update')->name('service.update');
Route::post('/servicelist', 'ServiceController@store')->name('service.store');
Route::delete('/deleteservice/{id}', 'ServiceController@destroy')->name('deleteservice');


//Billing Package
Route::get('/packagelist', 'PackageController@index')->name('package.index');
Route::get('/viewpackage', 'PackageController@create')->name('package.create');
Route::post('/viewpackage', 'PackageController@update')->name('package.update');
Route::put('/viewpackage', 'PackageController@update')->name('package.update');
Route::post('/packagelist', 'PackageController@store')->name('package.store');
Route::delete('/deletepackage/{id}', 'PackageController@destroy')->name('deletePackage');

Route::get('/invoice', 'PackageController@invoice')->name('package.invoice');

//Appointment
Route::get('/appointments', 'HomeController@appointments')->name('appointments');
Route::post('/reschedule', 'HomeController@reschedule')->name('reschedule');
Route::get('/markpresent', 'HomeController@markpresent')->name('markpresent');
Route::post('/markpresent', 'HomeController@storemarkpresent')->name('storemarkpresent');

//Addmission
Route::get('/admissionstatus', 'HomeController@admissionstatus')->name('admissionstatus');
Route::get('/admissionhistory', 'HomeController@admissionhistory')->name('admissionhistory');

//Expense
Route::get('/expensecat', 'ExpensecatController@index')->name('expensecat');
Route::post('/expensecat', 'ExpensecatController@store')->name('storecat');
Route::post('/editexpensecat', 'ExpensecatController@update')->name('expensecat.update');
Route::put('/editexpensecat', 'ExpensecatController@update')->name('expensecat.update');
Route::get('/allexpense', 'ExpenseController@index')->name('allexpense');
Route::post('/allexpense', 'ExpenseController@store')->name('storeexpense');
Route::delete('/deleteexpense/{id}', 'ExpenseController@destroy')->name('deleteexpense');