<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'StudentController@student')->name('student');
Route::get('add_student', 'StudentController@add_student')->name('add_student');
Route::post('addstudent', 'StudentController@addstudent')->name('addstudent');
Route::get('edit_student/{id}', 'StudentController@edit_student')->name('edit_student');
Route::post('update_student', 'StudentController@update_student')->name('update_student');
Route::get('delete_student/{id}', 'StudentController@delete_student')->name('delete_student');