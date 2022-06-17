<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_forms', function (Blueprint $table) {
           $table->increments('id');
            $table->date('reservation_date');
            $table->string('reservation_time')->nullable();
            $table->string('name_surname')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('massage_package')->nullable();
            $table->string('hammam_package')->nullable();
            $table->string('male_pax')->nullable();
            $table->string('female_pax')->nullable();
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
        Schema::dropIfExists('booking_forms');
    }
}
