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
            $table->string('rut', 50)->nullable();
            $table->string('bs_name', 100);
            $table->string('name', 100)->nullable();
            $table->string('contact_name', 100);
            $table->string('position', 100);
            $table->string('phone1', 20);
            $table->string('phone2', 20)->nullable();
            $table->string('phone3', 20)->nullable();
            $table->string('email1', 50);
            $table->string('email2', 50)->nullable();
            $table->string('email3', 50)->nullable();
            $table->string('web', 100)->nullable();
            $table->enum('status', [0, 1, 2])->default(0);
            $table->date('next_mng');
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('customers');
    }
}
