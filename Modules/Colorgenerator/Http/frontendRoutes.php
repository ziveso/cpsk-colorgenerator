<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/colorgenerator'], function (Router $router) {
    // append
    $router->get('/',[
        'uses' => 'PublicController@test',
        'as' => 'generator.test'
    ]);

    $router->post('/create',[
        'uses' => 'PublicController@create',
        'as' => 'color.create'
    ]);
});
