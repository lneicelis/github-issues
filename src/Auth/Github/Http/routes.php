<?php

/** @var \Illuminate\Routing\Router $router */

$router->group([
    'prefix'    => '/auth/github',
], function ($router) {
    /** @var \Illuminate\Routing\Router $router */

    $router->get('/user', [
        'uses' => 'AuthController@getUser'
    ]);

    $router->post('/login', [
        'as'   => 'issues::login',
        'uses' => 'AuthController@login'
    ]);

    $router->post('/logout', [
        'as'   => 'issues::logout',
        'uses' => 'AuthController@logout'
    ]);
});