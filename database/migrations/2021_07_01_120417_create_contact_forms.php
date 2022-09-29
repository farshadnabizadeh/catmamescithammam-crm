    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_surname');
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->nullable();
            $table->integer('form_status_id')->unsigned()->nullable();
            $table->foreign('form_status_id')->references('id')
                ->on('form_statuses')
                ->onDelete('cascade');
            $table->timestamp('answered_time')->nullable();
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
        Schema::dropIfExists('contact_forms');
    }
}
