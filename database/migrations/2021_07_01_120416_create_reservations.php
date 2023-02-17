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
            $table->date('reservation_date');
            $table->string('reservation_time')->nullable();
            $table->string('total_customer')->nullable();
            $table->string('pickup_time')->nullable();
            $table->string('room_number')->nullable();
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')
                ->on('customers')
                ->onDelete('cascade');
            $table->integer('discount_id')->unsigned()->nullable();
            $table->foreign('discount_id')->references('id')->on('discounts')
                ->onDelete('cascade');
            $table->integer('source_id')->unsigned();
            $table->foreign('source_id')->references('id')
                ->on('sources')
                ->onDelete('cascade');
            $table->longText('reservation_note')->nullable();
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
        Schema::dropIfExists('reservations');
    }
}
