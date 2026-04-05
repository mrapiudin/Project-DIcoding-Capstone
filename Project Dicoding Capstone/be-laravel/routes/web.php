<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

// API Routes
$router->group(['prefix' => 'api'], function () use ($router) {
    
    // Users Routes
    $router->get('users', 'UserController@index');
    $router->post('users', 'UserController@store');
    $router->get('users/{id}', 'UserController@show');
    $router->put('users/{id}', 'UserController@update');
    $router->delete('users/{id}', 'UserController@destroy');
    
    // Activities Routes  
    $router->get('activities', 'ActivityController@index');
    $router->post('activities', 'ActivityController@store');
    $router->get('activities/{id}', 'ActivityController@show');
    $router->put('activities/{id}', 'ActivityController@update');
    $router->delete('activities/{id}', 'ActivityController@destroy');
    
    // Sleep Routes
    $router->get('sleep', 'SleepController@index');
    $router->post('sleep', 'SleepController@store');
    $router->get('sleep/{id}', 'SleepController@show');
    $router->put('sleep/{id}', 'SleepController@update');
    $router->delete('sleep/{id}', 'SleepController@destroy');
    
    // Articles Routes
    $router->get('articles', 'ArticleController@index');
    $router->post('articles', 'ArticleController@store');
    $router->get('articles/{id}', 'ArticleController@show');
    $router->put('articles/{id}', 'ArticleController@update');
    $router->delete('articles/{id}', 'ArticleController@destroy');
    
});
