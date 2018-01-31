<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    //
    protected $table = 'Exams';
	protected $primaryKey = 'ExamID';
    public $timestamps = false;
}
