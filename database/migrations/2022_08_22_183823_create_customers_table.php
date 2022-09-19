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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_number')->unique();
            $table->string('customer_first_name');
            $table->string('customer_sur_name');
            $table->integer('customer_type_id')->unsigned();
            $table->string('nic')->unique();
            $table->date('date_of_birth');
            $table->integer('gender');
            $table->integer('phone_number');
            $table->string('email',50)->unique()->nullable();
            $table->longText('address');
            $table->longText('image')->nullable();
            $table->integer('black_list_id');
            $table->integer('is_active');
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->foreign('customer_type_id')->references('id')->on('customer_types')->onDelete('cascade');
            $table->foreign('black_list_id')->references('id')->on('black_lists')->onDelete('cascade');
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
};
