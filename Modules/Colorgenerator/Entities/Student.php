<?php

namespace Modules\Colorgenerator\Entities;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;

class Student extends Model implements FromCollection
{
    protected $table = 'colorgenerator__students';
    protected $fillable = ['studentId','color','gender','type'];

    public function collection()
    {
        return Student::all();
    }
}
