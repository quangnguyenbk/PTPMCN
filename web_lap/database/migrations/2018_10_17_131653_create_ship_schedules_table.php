<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_schedules', function (Blueprint $table) {
            $table->increments('schedule_id');
            $table->integer('shipper_id');
            $table->integer('order_id');
            $table->dateTime('date_ship');
            $table->dateTime('estimate_time');
            $table->dateTime('actual_time');
            $table->integer('shipper_chosen_by');
            $table->integer('shipper_replaced_with');
            $table->text('comment');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ship_schedules');
    }
}
