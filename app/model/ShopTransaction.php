<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShopTransaction extends Model
{
    //
    protected $table = 'ShopTransaction';
	protected $primaryKey = 'TransactionID';
    public $timestamps = false;
}
