<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

Route::group([
    'prefix' => 'api'
], function() {

    /**
     * Routing for authentication
     */
    Route::group([
        'prefix' => 'auth'
    ], function() {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('user-profile', 'AuthController@me');
    });

    /**
     * Routing for menu
     */
    Route::group([
        'prefix' => 'menu'
    ], function() {
        Route::get('/', 'MenuController@allMenu');
        Route::get('/{id}', 'MenuController@getDetailMenu');
        Route::post('/', 'MenuController@store');
        Route::put('/{id}', 'MenuController@update');
        Route::delete('/{id}', 'MenuController@delete');
    });

    /**
     * Routing for table
     */
    Route::group([
        'prefix' => 'table'
    ], function() {
        Route::get('/', 'TableController@allTable');
        Route::get('/{id}', 'TableController@getDetailTable');
        Route::post('/', 'TableController@store');
        Route::put('/{id}', 'TableController@update');
        Route::delete('/{id}', 'TableController@delete');
    });

    /**
     * Routing for table
     */
    Route::group([
        'prefix' => 'order'
    ], function() {
        Route::post('/', 'OrderController@createOrder');
        Route::put('/update/{id}/status', 'OrderController@updateStatus');
    });

});
