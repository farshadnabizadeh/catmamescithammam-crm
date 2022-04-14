<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayments extends Migration
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
            $table->string('total_customer')->nullable();
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')
                ->on('services')
                ->onDelete('cascade');
            $table->string('service_currency')->nullable();
            $table->string('service_cost')->nullable();
            $table->string('service_commission')->nullable();
            $table->string('country')->nullable();
            $table->integer('therapist_id')->unsigned();
            $table->foreign('therapist_id')->references('id')
                ->on('therapists')
                ->onDelete('cascade');
            $table->integer('source_id')->unsigned();
            $table->foreign('source_id')->references('id')
                ->on('sources')
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
        Schema::dropIfExists('payments');
    }
}
