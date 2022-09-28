<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('zohoId')->nullable();
            $table->integer('lead_source_id')->unsigned();
            $table->foreign('lead_source_id')->references('id')
                ->on('lead_sources')
                ->onDelete('cascade');
            $table->string('name_surname');
            $table->string('phone_number')->nullable();
            $table->string('email_address')->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')
                ->on('countries');
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
