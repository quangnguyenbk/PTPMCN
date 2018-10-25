<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaptopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laptops', function (Blueprint $table) {
            $table->increments('laptop_id');
            $table->string('laptop_name');
            $table->integer('quantity');
            $table->string('status');
            $table->text('comment');
            $table->integer('ram');
            $table->integer('vga');
            $table->integer('cpu');
            $table->integer('brand');
            $table->integer('monitor');
            $table->string('color');
            $table->string('harddrive');
            $table->string('image');
            $table->string('price')
            $table->text('description');
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
        Schema::dropIfExists('laptops');
    }
}
