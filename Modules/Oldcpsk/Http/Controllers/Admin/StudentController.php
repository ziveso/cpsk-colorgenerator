<?php

namespace Modules\Oldcpsk\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Oldcpsk\Entities\Student;
use Modules\Oldcpsk\Http\Requests\CreateStudentRequest;
use Modules\Oldcpsk\Http\Requests\UpdateStudentRequest;
use Modules\Oldcpsk\Repositories\StudentRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class StudentController extends AdminBaseController
{
    /**
     * @var StudentRepository
     */
    private $student;

    public function __construct(StudentRepository $student)
    {
        parent::__construct();

        $this->student = $student;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $students = $this->student->all();

        return view('oldcpsk::admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('oldcpsk::admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateStudentRequest $request
     * @return Response
     */
    public function store(CreateStudentRequest $request)
    {
        $this->student->create($request->all());

        return redirect()->route('admin.oldcpsk.student.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('oldcpsk::students.title.students')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Student $student
     * @return Response
     */
    public function edit(Student $student)
    {
        return view('oldcpsk::admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Student $student
     * @param  UpdateStudentRequest $request
     * @return Response
     */
    public function update(Student $student, UpdateStudentRequest $request)
    {
        $this->student->update($student, $request->all());

        return redirect()->route('admin.oldcpsk.student.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('oldcpsk::students.title.students')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Student $student
     * @return Response
     */
    public function destroy(Student $student)
    {
        $this->student->destroy($student);

        return redirect()->route('admin.oldcpsk.student.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('oldcpsk::students.title.students')]));
    }
}
