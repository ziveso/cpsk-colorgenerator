<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/colorgenerator'], function (Router $router) {
    $router->bind('student', function ($id) {
        return app('Modules\Colorgenerator\Repositories\StudentRepository')->find($id);
    });
    $router->get('students', [
        'as' => 'admin.colorgenerator.student.index',
        'uses' => 'StudentController@index',
        'middleware' => 'can:colorgenerator.students.index'
    ]);
    $router->get('students/create', [
        'as' => 'admin.colorgenerator.student.create',
        'uses' => 'StudentController@create',
        'middleware' => 'can:colorgenerator.students.create'
    ]);
    $router->post('students', [
        'as' => 'admin.colorgenerator.student.store',
        'uses' => 'StudentController@store',
        'middleware' => 'can:colorgenerator.students.create'
    ]);
    $router->get('students/{student}/edit', [
        'as' => 'admin.colorgenerator.student.edit',
        'uses' => 'StudentController@edit',
        'middleware' => 'can:colorgenerator.students.edit'
    ]);
    $router->put('students/{student}', [
        'as' => 'admin.colorgenerator.student.update',
        'uses' => 'StudentController@update',
        'middleware' => 'can:colorgenerator.students.edit'
    ]);
    $router->delete('students/{student}', [
        'as' => 'admin.colorgenerator.student.destroy',
        'uses' => 'StudentController@destroy',
        'middleware' => 'can:colorgenerator.students.destroy'
    ]);
// append

});
