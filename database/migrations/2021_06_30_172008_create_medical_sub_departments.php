<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalSubDepartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_sub_departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('medical_department_id')->unsigned();
            $table->foreign('medical_department_id')->references('id')
              ->on('medical_departments')
              ->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->softDeletes();
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
        Schema::dropIfExists('medical_sub_departments');
    }
}
