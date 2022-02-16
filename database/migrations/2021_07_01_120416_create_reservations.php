<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->date('arrival_date');
            $table->string('arrival_time')->nullable();
            $table->string('total_customer')->nullable();
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')
                ->onDelete('cascade');
            $table->string('service_currency')->nullable();
            $table->string('service_cost')->nullable();
            $table->string('service_commission')->nullable();
            $table->integer('therapist_id')->unsigned();
            $table->foreign('therapist_id')->references('id')->on('therapists')
                ->onDelete('cascade');
            $table->foreign('source_id')->references('id')->on('sources')
                ->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->softDeletes();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
