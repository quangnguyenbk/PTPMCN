<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $table = "Suppliers";

    public function purchase_orders()
    {
    	return $this->hasOne('App\Purchase_order', 'supplier_id','supplier_id');
    }
}
