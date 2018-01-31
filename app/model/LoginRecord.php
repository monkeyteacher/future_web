<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LoginRecord extends Model
{
    //
    protected $table = 'LoginRecord';
	protected $primaryKey = 'LoginID';
    public $timestamps = false;
}
