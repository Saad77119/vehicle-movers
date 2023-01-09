<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_images', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->longText('car_front')->null();
            $table->longText('car_back')->null();
            $table->longText('car_top')->null();
            $table->longText('car_left')->null();
            $table->longText('car_right')->null();
            $table->integer('vehicle_id');
            $table->integer('customer_id');
            $table->integer('driver_id');
            $table->string('image_type');
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
        Schema::dropIfExists('vehicle_images');
    }
}
