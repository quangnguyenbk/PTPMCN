<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    //
    protected $table='laptops';

    public function ram(){
    	return $this->hasMany("App\Ram", "ram","ram_id");
    }
    public function vga(){
    	return $this->hasMany("App\Vga", "vga","vga_id");
    }
    public function cpu(){
    	return $this->hasMany("App\Cpu", "cpu","cpu_id");
    }
    public function branch(){
    	return $this->hasMany("App\Branch", "branch","branch_id");
    }
    public function monitor(){
    	return $this->hasMany("App\Monitor", "monitor","monitor_id");
    }
    public function sales_order_item(){
        return $this->belongsToMany("App\SalesOrderItem");
    }
}
