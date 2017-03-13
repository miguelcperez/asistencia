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
Route::get('personal/today', 'AttendanceController@personalToday');
Route::post('personal/check-in', 'AttendanceController@checkIn');
Route::post('personal/check-out', 'AttendanceController@checkOut');

Route::post('personal/validate', 'AttendanceController@codeValidate');

Route::get('registro', 'PersonalController@create');
Route::post('registro', 'PersonalController@store');

Route::get('reporte', 'ReportController@index');
Route::get('reporte/personal', 'ReportController@personalData');

Route::get('reporte/data', 'ReportController@show');

Route::get('reporte/total', 'ReportController@total');

Route::get('reporte/{id}/{state}', 'ReportController@changeState');

Route::get('reporte/pdf', 'ReportController@printPdf');

//Route::get('reporte', 'ReportController@show');