<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales_order_item extends Model
{
    //
    protected $table='sales_order_items';
    public $timestamps = false;

    public function laptop(){
        return $this->belongsToMany("App\Laptop");
    }

    public function sales_order(){
        return $this->hasOne("App\SalesOrder");
    }
}
