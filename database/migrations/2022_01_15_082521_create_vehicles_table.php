<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->integer('make')->nullable();
            $table->integer('model')->nullable();
            $table->string('year_of_manufacture')->nullable();
            $table->integer('port')->nullable();
            $table->string('address')->nullable();
            $table->string('pickup_address')->nullable();
            $table->integer('country')->nullable();
            $table->integer('city')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('driver_id')->nullable();
            $table->enum('status', ['Pending', 'Delivered'])->default('Pending');
            $table->datetime('estimate_pickup_time')->nullable();
            $table->datetime('estimate_delivery_time')->nullable();
            $table->string('location')->nullable();
            $table->string('route')->nullable();
            $table->string('tally_sheet')->nullable();
            $table->string('images')->nullable();
            $table->string('attachments')->nullable();
            $table->string('port_manager')->nullable();
            $table->string('contact_person_vehicle')->nullable();
            $table->string('vin')->nullable();
            $table->string('instruction_by_customer')->nullable();
            $table->string('instruction_for_driver')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
