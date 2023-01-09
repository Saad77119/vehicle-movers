<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('cnic')->nullable();
            $table->string('address')->nullable();
            $table->string('temp_address')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->default('0');
            $table->integer('customer_type_id')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('landline_no')->nullable();
            $table->string('email')->nullable();
            $table->enum('sms_alert', ['YES', 'NO'])->default('YES');
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
        Schema::dropIfExists('customers');
    }
}
