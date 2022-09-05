<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payables', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('loan_id')->unsigned();
            $table->decimal('amount',10,2)->default(0.00);
            $table->timestamps();
            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payables');
    }
};
