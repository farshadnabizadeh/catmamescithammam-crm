<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhatsappNumbers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whatsapp_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone')->nullable();
            $table->string('name_surname')->nullable();
            $table->string('email')->nullable();
            $table->string('country')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('whatsapp_numbers');
    }
}
