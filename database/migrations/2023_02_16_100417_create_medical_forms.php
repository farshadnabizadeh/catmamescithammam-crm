<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_surname');
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->nullable();
            $table->string('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('therapist_gender')->nullable();
            $table->string('heart_problems')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('varicose_veins')->nullable();
            $table->string('asthma')->nullable();
            $table->string('vertebral_problem')->nullable();
            $table->string('joint_problems')->nullable();
            $table->string('fractures')->nullable();
            $table->string('skin_allergies')->nullable();
            $table->string('lodine_allergies')->nullable();
            $table->string('hyperthyroidism')->nullable();
            $table->string('diabetes')->nullable();
            $table->string('epilepsy')->nullable();
            $table->string('pregnant')->nullable();
            $table->string('back_problems')->nullable();
            $table->string('covid')->nullable();
            $table->longText('covid_note')->nullable();
            $table->string('surgery')->nullable();
            $table->longText('surgery_note')->nullable();
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
        Schema::dropIfExists('medical_forms');
    }
}
