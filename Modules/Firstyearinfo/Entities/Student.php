<?php

namespace Modules\Firstyearinfo\Entities;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'firstyearinfo__students';
    protected $fillable = ['studentId','gender','name'];
}
