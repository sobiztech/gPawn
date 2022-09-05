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
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('loan_id')->unsigned();
            $table->string('invoice_no')->unique();
            $table->decimal('amount',10,2)->default(0.00);
            $table->decimal('discount',10,2)->default(0.00);
            $table->integer('payment_type_id')->unsigned();
            $table->integer('emp_id')->unsigned();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('cascade');
            $table->foreign('emp_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
