<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    //
    protected $table = 'Courses';
	protected $primaryKey = 'CourseID';
    public $timestamps = false;
}
