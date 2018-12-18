<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    //
    protected $table='laptops';
    public $fillable = ['status'];

    public function ram(){
    	return $this->hasOne("App\Ram", "id","ram");
    }
    public function vga(){
    	return $this->hasOne("App\Vga", "id","vga");
    }
    public function cpu(){
    	return $this->hasOne("App\Cpu", "id","cpu");
    }
    public function brand(){
    	return $this->hasOne("App\Branch", "id","brand");
    }
    public function monitor(){
    	return $this->hasOne("App\Monitor", "id","monitor");
    }
    public function harddrive(){
        return $this->hasOne("App\Harddrive", "id","harddrive");
    }
    public function sales_order_item(){
        return $this->belongsToMany("App\SalesOrderItem");
    }
}
