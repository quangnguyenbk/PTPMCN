<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ship_schedule extends Model
{
    //
    protected $table='ship_schedules';
    public $fillable=['status'];
}
