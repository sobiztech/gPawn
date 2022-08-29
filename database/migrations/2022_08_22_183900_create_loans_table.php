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
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('customer_id')->unsigned();
            $table->decimal('amount',10,2);
            $table->integer('period');
            $table->integer('interest');
            $table->integer('loan_type_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->foreign('loan_type_id')->references('id')->on('loan_types')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
};
