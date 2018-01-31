<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    //
    protected $table = 'Members';
	protected $primaryKey = 'MemberID';
    public $timestamps = false;
}
