<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/colorgenerator'], function (Router $router) {
    $router->post('/create',[
        'uses' => 'PublicController@create',
        'as' => 'color.create'
    ]);

    $router->get('/studentdata',[
        'uses' => 'PublicController@getStudentdata',
        'as' => 'student.data'
    ]);

    $router->get('/download', [
        'uses' => 'PublicController@download',
        'as' => 'student.download'
    ]);
});
