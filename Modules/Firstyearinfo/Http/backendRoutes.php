<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/firstyearinfo'], function (Router $router) {
    $router->bind('student', function ($id) {
        return app('Modules\Firstyearinfo\Repositories\StudentRepository')->find($id);
    });
    $router->get('students', [
        'as' => 'admin.firstyearinfo.student.index',
        'uses' => 'StudentController@index',
        'middleware' => 'can:firstyearinfo.students.index'
    ]);
    $router->get('students/create', [
        'as' => 'admin.firstyearinfo.student.create',
        'uses' => 'StudentController@create',
        'middleware' => 'can:firstyearinfo.students.create'
    ]);
    $router->post('students', [
        'as' => 'admin.firstyearinfo.student.store',
        'uses' => 'StudentController@store',
        'middleware' => 'can:firstyearinfo.students.create'
    ]);
    $router->get('students/{student}/edit', [
        'as' => 'admin.firstyearinfo.student.edit',
        'uses' => 'StudentController@edit',
        'middleware' => 'can:firstyearinfo.students.edit'
    ]);
    $router->put('students/{student}', [
        'as' => 'admin.firstyearinfo.student.update',
        'uses' => 'StudentController@update',
        'middleware' => 'can:firstyearinfo.students.edit'
    ]);
    $router->delete('students/{student}', [
        'as' => 'admin.firstyearinfo.student.destroy',
        'uses' => 'StudentController@destroy',
        'middleware' => 'can:firstyearinfo.students.destroy'
    ]);
// append

});
