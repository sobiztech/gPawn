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
            $table->string('invoice_no')->unique();
            $table->integer('customer_id')->unsigned();
            $table->decimal('amount',10,2)->default(0.00);
            $table->integer('period');
            $table->decimal('interest',4,2);
            $table->decimal('total_payable',10,2);
            $table->integer('loan_type_id')->unsigned();
            $table->enum('pay_type', ['Daily', 'Weekly', 'Monthly']);
            $table->integer('loan_status')->default(0);
            $table->decimal('schedule_payment_amount',10,2)->default(0.00);
            $table->date('loan_end_date');
            $table->date('finished_at')->nullable();
            $table->integer('emp_id')->unsigned();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('loan_type_id')->references('id')->on('loan_types')->onDelete('cascade');
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
        Schema::dropIfExists('loans');
    }
};
