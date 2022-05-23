<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web router for your application. These
| router are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$router->get('/login', 'AdminController@login')->name(ADMIN_LOGIN);
$router->post('/loginPost', 'AdminController@loginPost')->name(ADMIN_LOGIN_POST);
$router->get('/logout', 'AdminController@logout')->name(ADMIN_LOGOUT);


$router->prefix('/')->middleware('auth:admin')->group(function () use ($router) {
    $router->post('/getAdminLogin', 'AdminController@getAdminLogin')->name(GET_ADMIN_LOGIN);

    $router->get('/getList', 'AdminController@getList')->name(GET_LIST_ADMIN);
    $router->get('/getRoles', 'AdminController@getRoles')->name(GET_LIST_ROLES);
    $router->get('/getPermissions', 'AdminController@getPermissions')->name(GET_LIST_PERMISSIONS);
    $router->get('/adminHasPermission', 'AdminController@adminHasPermission')->name(ADMIN_HAS_PERMISSIONS);
    $router->post('/setPermission', 'AdminController@setPermission')->name(ADMIN_SET_PERMISSIONS);


    $router->post('/createAdmin', 'AdminController@store')->name(CREATE_ADMIN);

    $router->get('/', 'AdminController@index')->where(['all' => '.*']);
    $router->get('/{all}', 'AdminController@index')->where('all', '(.*)')->name(ADMIN_INDEX);
});
