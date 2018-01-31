<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Recursive extends Model
{
    //
    protected $table = 'Recursive';
	protected $primaryKey = 'ResultID';
    public $timestamps = false;
}
