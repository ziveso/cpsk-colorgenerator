<?php

namespace Modules\Colorgenerator\Entities;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'colorgenerator__students';
    protected $fillable = ['studentId','color','gender','type'];
}
