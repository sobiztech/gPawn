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
        Schema::create('schedule_runs', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('payable_id')->unsigned();
            $table->timestamps();
            $table->foreign('payable_id')->references('id')->on('payables')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_runs');
    }
};
