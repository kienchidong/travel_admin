<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web router for your application. These
| router are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name(ROUTE_HOME);

Route::get('/language/{language}', 'LanguageController@changeLanguage')->name(CHANGE_LANGUAGE);

Auth::routes();

$router->post('uploadImage', 'Media\MediaController@upload')->name(UPLOAD_IMAGE);
$router->post('removeImage', 'Media\MediaController@removeImage')->name(REMOVE_IMAGE);

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/getUserLogin/{guard}', 'Admin\AdminController@getUserLogin')->name(ROUTE_GET_USER);
