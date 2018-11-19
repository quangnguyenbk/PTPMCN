<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales_order extends Model
{
    //
    protected $table='sales_orders';
    public $timestamps = false;

    public function user(){
        return $this->belongsToMany("App\User");
    }
}
