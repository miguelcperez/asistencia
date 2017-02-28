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

Route::get('/', 'AttendanceController@index');
Route::get('/personal/today', 'AttendanceController@personalToday');
Route::post('/personal/check-in', 'AttendanceController@checkIn');
Route::post('/personal/check-out', 'AttendanceController@checkOut');

Route::get('registro', 'PersonalController@index');
Route::post('registro', 'PersonalController@create');

Route::get('/reporte', function() {
	return view('report');
});