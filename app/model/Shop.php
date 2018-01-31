<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //
    protected $table = 'Shop';
	protected $primaryKey = 'GoodID';
    public $timestamps = false;
}
