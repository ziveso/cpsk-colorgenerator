<?php

namespace Modules\Colorgenerator\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Colorgenerator\Repositories\StudentRepository;
use Modules\Colorgenerator\Entities\Student;
use Excel;

class PublicController extends BasePublicController
{
    /**
     * @var PageRepository
     */
    private $students;
    private $studentData;

    public function __construct(StudentRepository $students)
    {
        parent::__construct();
        $this->students = $students;
        $path = storage_path() . "/studentinfo.json";
        $this->studentData = json_decode(file_get_contents($path), true);
    }

    public function getStudentdata() {
        return $this->studentData;
    }

    public function create(Request $request) {
        $studentid = $request->data['studentId'];
        $type = strpos($studentid, '611054') !== false ? 'SKE' : 'CPE';
        $gender = in_array($studentid, $this->getStudentdata()['female']) ? 'female' : 'male';

        $currentColor = $this->getCurrentLength();

        $minPeople = 999;
        
        foreach($currentColor as $color) {
            if($color['total'] < $minPeople) 
                $minPeople = $color['total'];
        }

        // generate color here
        $diffcolor = 50;
        $difftype = 30;
        // $diffgender = 30;

        // initialize droprate
        $rate = [];
        $rate['น้ำตาล'] = 100;
        $rate['แสด'] = 100;
        $rate['น้ำเงิน'] = 100;
        $rate['เขียว'] = 100;
        $rate['เหลือง'] = 100;
        $rate['แดง'] = 100;

        // make lowest mung has highest posibility
        foreach($rate as $r => $value) {
            $rate[$r] -= ($currentColor[$r]['total'] - $minPeople) * $diffcolor;
        }

        $minfemale = 999;
        foreach($currentColor as $c) {
            if($c['female'] < $minfemale) {
                $minfemale = $c['female'];
            }
        }

        $maxfemale = $minfemale <= 3 ? 3 : $minfemale + 1;

        // make balance gender
        foreach($rate as $r => $value) {

            if($gender==='female') {
                if($currentColor[$r]['female'] - $maxfemale === 0) {
                    $rate[$r] -= 100;
                }
            }
        }

        // make balance type
        foreach($rate as $r => $value) {
            if($type === 'CPE' && $currentColor[$r]['cpe'] > $currentColor[$r]['ske']){
                // $rate[$r] -= ($currentColor[$r]['cpe'] - $currentColor[$r]['ske']) * $difftype;
                $rate[$r] -= $difftype;
            }
            if($type === 'SKE' && $currentColor[$r]['ske'] < $currentColor[$r]['cpe']) {
                // $rate[$r] -= ($currentColor[$r]['ske'] - $currentColor[$r]['cpe']) * $difftype;
                $rate[$r] -= $difftype;
            }
        }

        foreach($rate as $r => $value) {
            if($value < 0) {
                $rate[$r] = 0;
            } 
        }

        // time to random
        $maxValue = 0;
        foreach($rate as $r) {
            $maxValue += $r;
        }
        $randValue = rand(0,$maxValue);

        $color = '';
        if($randValue < $rate['น้ำตาล']) {
            $color = 'น้ำตาล';
        } else if($randValue < $rate['น้ำตาล'] + $rate['แสด']) {
            $color = 'แสด';
        } else if($randValue < $rate['น้ำตาล'] + $rate['แสด'] + $rate['น้ำเงิน']) {
            $color = 'น้ำเงิน';
        } else if($randValue < $rate['น้ำตาล'] + $rate['แสด'] + $rate['น้ำเงิน'] + $rate['เขียว']) {
            $color = 'เขียว';
        } else if($randValue < $rate['น้ำตาล'] + $rate['แสด'] + $rate['น้ำเงิน'] + $rate['เขียว'] + $rate['เหลือง']) {
            $color = 'เหลือง';
        } else {
            $color = 'แดง';
        }


        // save to database
        $student = [];
        $student['studentId'] = $studentid;
        $student['color'] = $color;
        $student['gender'] = $gender;
        $student['type'] = $type;
        $this->students->create($student);

        // output
        $data = [];
        $data['name'] = $studentid;
        $data['color'] = $color;
        $data['gender'] = $gender;
        
        return $data;
    }

    private function getCurrentLength() {
        $colors = ['น้ำตาล','แสด','น้ำเงิน','เขียว','เหลือง','แดง'];
        $data = [];
        foreach($colors as $color) {
            $total = $this->students->allWithBuilder()->where('color',$color)->count();
            $cpe = $this->students->allWithBuilder()->where('color',$color)->where('type','CPE')->count();
            $ske = $this->students->allWithBuilder()->where('color',$color)->where('type','SKE')->count();
            $male = $this->students->allWithBuilder()->where('color',$color)->where('gender','male')->count();
            $female = $this->students->allWithBuilder()->where('color',$color)->where('gender','female')->count();

            $data[$color] = compact('cpe','ske','male','female','total');
        }

        return $data;
    }

    public function download() {
        return Excel::download(new Student, 'studentdata.xlsx');
    }

    public function getAllStudent() {
        return $this->students->all();
    }
}
