<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->date('created_date')->nullable();
            $table->timestamp('post_time')->nullable();
            $table->date('arrival_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->date('operation_date')->nullable();
            $table->string('zohoId')->nullable();
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')
                ->on('patients')
                ->onDelete('cascade');
            $table->integer('treatment_id')->unsigned();
            $table->foreign('treatment_id')->references('id')
                ->on('treatments')
                ->onDelete('cascade');
            $table->integer('sales_person_id')->unsigned()->nullable();
            $table->foreign('sales_person_id')->references('id')
                ->on('sales_persons')
                ->onDelete('cascade');
            $table->integer('doctor_id')->unsigned()->nullable();
            $table->text('duration_of_stay')->nullable();
            $table->text('hospitalization')->nullable();
            $table->string('total_price')->nullable();
            $table->string('price_currency')->nullable();
            $table->longText('is_asthma')->nullable();
            $table->longText('is_diabetes')->nullable();
            $table->longText('is_hyper_tension')->nullable();
            $table->longText('is_breathing_problem')->nullable();
            $table->longText('is_chronic_illness')->nullable();
            $table->longText('is_hiv')->nullable();
            $table->longText('is_stroke')->nullable();
            $table->longText('is_hepatitis')->nullable();
            $table->longText('is_cancer')->nullable();
            $table->longText('is_sickle')->nullable();
            $table->longText('is_anaemia')->nullable();
            $table->longText('is_kidney_problem')->nullable();
            $table->longText('is_smoking')->nullable();
            $table->longText('is_alcohol')->nullable();
            $table->longText('is_allergie')->nullable();
            $table->longText('is_surgery_history')->nullable();
            $table->longText('is_covid_vaccine')->nullable();
            $table->string('weight')->nullable();
            $table->string('weight_unit')->nullable();
            $table->string('height')->nullable();
            $table->string('height_unit')->nullable();
            $table->longText('note')->nullable();
            $table->integer('medical_department_id')->unsigned();
            $table->foreign('medical_department_id')->references('id')
                ->on('medical_departments')
                ->onDelete('cascade');
            $table->integer('medical_sub_department_id')->unsigned();
            $table->foreign('medical_sub_department_id')->references('id')
                ->on('medical_sub_departments')
                ->onDelete('cascade');
            $table->integer('recommended_treatment_id')->unsigned()->nullable();
            $table->foreign('recommended_treatment_id')->references('id')
                ->on('treatments')
                ->onDelete('cascade');
            $table->integer('treatment_plan_status_id')->unsigned();
            $table->foreign('treatment_plan_status_id')->references('id')
                ->on('treatment_plan_statuses')
                ->onDelete('cascade');
            $table->longText('doctor_explanation')->nullable();
            $table->integer('is_suitable')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('answered_user_id')->unsigned()->nullable();
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
        Schema::dropIfExists('treatment_plans');
    }
}
