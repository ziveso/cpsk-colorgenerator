<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/colorgenerator'], function (Router $router) {
    // append
    $router->get('/',[
        'uses' => '',
        'as' => ''
    ])
});
