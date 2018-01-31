<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Stories extends Model
{
    //
    protected $table = 'Stories';
	protected $primaryKey = 'StoryID';
    public $timestamps = false;
}
