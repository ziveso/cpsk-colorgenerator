<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/oldcpsk'], function (Router $router) {
    $router->bind('student', function ($id) {
        return app('Modules\Oldcpsk\Repositories\StudentRepository')->find($id);
    });
    $router->get('students', [
        'as' => 'admin.oldcpsk.student.index',
        'uses' => 'StudentController@index',
        'middleware' => 'can:oldcpsk.students.index'
    ]);
    $router->get('students/create', [
        'as' => 'admin.oldcpsk.student.create',
        'uses' => 'StudentController@create',
        'middleware' => 'can:oldcpsk.students.create'
    ]);
    $router->post('students', [
        'as' => 'admin.oldcpsk.student.store',
        'uses' => 'StudentController@store',
        'middleware' => 'can:oldcpsk.students.create'
    ]);
    $router->get('students/{student}/edit', [
        'as' => 'admin.oldcpsk.student.edit',
        'uses' => 'StudentController@edit',
        'middleware' => 'can:oldcpsk.students.edit'
    ]);
    $router->put('students/{student}', [
        'as' => 'admin.oldcpsk.student.update',
        'uses' => 'StudentController@update',
        'middleware' => 'can:oldcpsk.students.edit'
    ]);
    $router->delete('students/{student}', [
        'as' => 'admin.oldcpsk.student.destroy',
        'uses' => 'StudentController@destroy',
        'middleware' => 'can:oldcpsk.students.destroy'
    ]);
// append

});
