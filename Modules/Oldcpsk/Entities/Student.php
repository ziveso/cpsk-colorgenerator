<?php

namespace Modules\Oldcpsk\Entities;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'oldcpsk__students';
    protected $fillable = ['gender','color','year','total','type'];
}
