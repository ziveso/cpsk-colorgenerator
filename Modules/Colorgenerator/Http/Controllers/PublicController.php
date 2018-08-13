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
        $gender = in_array($studentid, $this->getStudentdata()['male']) ? 'male' : 'female';

        $currentColor = $this->getCurrentLength();

        $minPeople = 999;
        
        foreach($currentColor as $color) {
            if($color['total'] < $minPeople) 
                $minPeople = $color['total'];
        }

        // generate color here
        $diffcolor = 30;
        $difftype = 15;
        $diffgender = 10;

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

        // make balance gender
        foreach($rate as $r => $value) {
            if($gender === 'male' && $currentColor[$r]['male'] > $currentColor[$r]['female']){
                $rate[$r] -= ($currentColor[$r]['male'] - $currentColor[$r]['female']) * $diffgender;
            }
            if($gender === 'female' && $currentColor[$r]['male'] < $currentColor[$r]['female']) {
                $rate[$r] -= ($currentColor[$r]['female'] - $currentColor[$r]['male']) * $diffgender;
            }
        }

        // make balance type
        foreach($rate as $r => $value) {
            if($type === 'CPE' && $currentColor[$r]['cpe'] > $currentColor[$r]['ske']){
                $rate[$r] -= ($currentColor[$r]['cpe'] - $currentColor[$r]['ske']) * $difftype;
            }
            if($type === 'SKE' && $currentColor[$r]['ske'] < $currentColor[$r]['cpe']) {
                $rate[$r] -= ($currentColor[$r]['ske'] - $currentColor[$r]['cpe']) * $difftype;
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

        dd($rate,$data,$student);
        return $data;
    }

    private function getCurrentLength() {
        $colors = ['น้ำตาล','แสด','น้ำเงิน','เขียว','เหลือง','แดง'];
        $data = [];
        foreach($colors as $color) {
            // $CPEMALE = $this->students->allWithBuilder()->where('color', $color)->where('type','CPE')->where('gender','male')->count();
            // $CPEFEMALE = $this->students->allWithBuilder()->where('color', $color)->where('type','CPE')->where('gender','female')->count();
            // $SKEMALE = $this->students->allWithBuilder()->where('color', $color)->where('type','SKE')->where('gender','male')->count();
            // $SKEFEMALE = $this->students->allWithBuilder()->where('color', $color)->where('type','SKE')->where('gender','female')->count();
            $total = $this->students->allWithBuilder()->where('color',$color)->count();
            $cpe = $this->students->allWithBuilder()->where('type','CPE')->count();
            $ske = $this->students->allWithBuilder()->where('type','SKE')->count();
            $male = $this->students->allWithBuilder()->where('gender','male')->count();
            $female = $this->students->allWithBuilder()->where('gender','female')->count();

            $data[$color] = compact('cpe','ske','male','female','total');
        }

        return $data;
    }
}
