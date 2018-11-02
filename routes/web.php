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

Route::get('/', function () {
   return view('welcome');
});


//Route::get('/', function () {
//	return view('form');
//});

Route::post('/post', 'FormController@getData');
Route::get('/getcsvdata', 'FormController@getCsv');
Route::get('/getmap', 'MapController@getMap');


Route::get('index', 'ExcelController@index');
Route::get('downloadExcel/{type}', 'ExcelController@downloadExcel');
Route::post('importExcel', 'ExcelController@importExcel');
Route::get('displaydata','ExcelController@displayData');
Route::get('getdata','ExcelController@getData');

Route::post('postdata', 'ExcelController@postdata')->name('ajaxdata.postdata');
