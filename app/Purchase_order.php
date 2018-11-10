<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase_order extends Model
{
    //
    protected $table='purchase_orders';

    public function supplier(){
    	return $this->hasMany("App\Supplier", "supplier_id","supplier_id");
    }

}
