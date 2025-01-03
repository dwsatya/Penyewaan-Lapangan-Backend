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

// Auth
$router->post('/signin', 'AuthController@signin');

/*
CRUD USER
*/
$router->get('/users', 'UsersController@index');
$router->post('/users', 'UsersController@store');
$router->get('/users/{id}', 'UsersController@show');
$router->delete('/users/{id}', 'UsersController@destroy');
$router->put('/users/{id}', 'UsersController@update');

/*
CRUD LAPANGAN
*/
$router->get('/lapangan', 'DetailLapanganController@index');
$router->post('/lapangan', 'DetailLapanganController@store');
$router->get('/lapangan/{id}', 'DetailLapanganController@show');
$router->delete('/lapangan/{id}', 'DetailLapanganController@destroy');
$router->put('/lapangan/{id}', 'DetailLapanganController@update');

/*
CRUD PELATIH
*/
$router->get('/pelatih', 'PelatihController@index');
$router->post('/pelatih', 'PelatihController@store');
$router->get('/pelatih/{id}', 'PelatihController@show');
$router->delete('/pelatih/{id}', 'PelatihController@destroy');
$router->put('/pelatih/{id}', 'PelatihController@update');

/*
CRUD PELATIH
*/
$router->get('/transaksi', 'TransaksiController@index');
$router->post('/transaksi', 'TransaksiController@store');
$router->get('/transaksi/{id}', 'TransaksiController@show');
$router->delete('/transaksi/{id}', 'TransaksiController@destroy');
$router->put('/transaksi/{id}', 'TransaksiController@update');
