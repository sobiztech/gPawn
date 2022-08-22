<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('department_number')->uniqiue();
            $table->string('department_name');
            $table->integer('properties_id')->unsigned();
            $table->integer('phone_number')->uniqiue()->nullable();
            $table->string('email',50)->uniqiue()->nullable();
            $table->longText('location');
            $table->integer('is_active');
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->foreign('properties_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
};
