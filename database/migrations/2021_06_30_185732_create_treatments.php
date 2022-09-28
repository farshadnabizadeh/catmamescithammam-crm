<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en');
            $table->string('name_de')->nullable();
            $table->string('name_fr')->nullable();
            $table->string('name_it')->nullable();
            $table->string('name_es')->nullable();
            $table->string('name_pt')->nullable();
            $table->string('name_pl')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('name_tr')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('desc')->nullable();
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
        Schema::dropIfExists('treatments');
    }
}
