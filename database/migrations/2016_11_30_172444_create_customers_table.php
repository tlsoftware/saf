<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut', 50)->nullable()->default(null);
            $table->string('bs_name', 100)->nullable()->default(null);
            $table->string('name', 100);
            $table->string('phone1', 50)->nullable();
            $table->string('phone2', 50)->nullable()->default(null);
            $table->string('phone3', 50)->nullable()->default(null);
            $table->string('contact_name', 100)->nullable();
            $table->string('position', 100)->nullable()->default(null);
            $table->string('email1', 100)->nullable()->default(null);
            $table->string('email2', 100)->nullable()->default(null);
            $table->string('email3', 100)->nullable()->default(null);
            $table->string('web', 250)->nullable()->default(null);
            $table->dateTime('last_mng')->nullable()->default(null);
            $table->date('next_mng');

            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses_details');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('bstype_id')->unsigned();
            $table->foreign('bstype_id')->references('id')->on('bstypes');

            $table->date('created_at');
            $table->date('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
