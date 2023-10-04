<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsMedicalForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations_medical_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('reservation_id')->unsigned();
            $table->foreign('reservation_id')
                ->references('id')
                ->on('reservations')
                ->onDelete('cascade');
            $table->integer('medical_form_id')->unsigned();
            $table->foreign('medical_form_id')
                ->references('id')
                ->on('medical_forms')
                ->onDelete('cascade');
            $table->string('piece')->nullable();
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
        Schema::dropIfExists('reservations_medical_forms');
    }
}
