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
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_number')->unique();
            $table->string('employee_first_name');
            $table->string('employee_sur_name');
            $table->integer('role_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->string('nic')->unique();
            $table->date('date_of_birth');
            $table->integer('gender');
            $table->integer('phone_number');
            $table->string('email',50)->unique()->nullable();
            $table->longText('address');
            $table->longText('image')->nullable();
            $table->date('contract_start_date');
            $table->date('contract_end_date');
            $table->integer('is_active');
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
