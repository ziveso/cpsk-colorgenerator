<?php

namespace Modules\Colorgenerator\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Colorgenerator\Repositories\StudentRepository;

class PublicController extends BasePublicController
{
    /**
     * @var PageRepository
     */
    private $students;

    public function __construct(StudentRepository $students)
    {
        parent::__construct();
    }

    public function test() {
        return date("Y-m-d H:i:s");
    }

    public function create(Request $request) {
        $studentid = $request->data['studentId'];
        // generate color here
        $data = [];
        $data['name'] = 'Mock a Fucking Name';
        $data['color'] = 'Mock a Fucking Color';
        return $data;
    }
}
