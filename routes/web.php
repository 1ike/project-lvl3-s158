<?php

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


$router->get('/', ['as' => 'home', function () {
    $title = 'PageSpeed - optimization guide (learning project)';
    $routeName = app('request')->route()[1]['as'];
    return view('home', [
        'title' => $title,
        'routeName' => $routeName,
        'url' => '',
        'errors' => '',
    ]);
}]);

$router->get('/domains', ['as' => 'domains', 'uses' => 'DomainController@showAll']);

$router->get('/domains/{id}', ['as' => 'domain','uses' => 'DomainController@show']);

$router->post('/domains', ['uses' => 'DomainController@create']);
