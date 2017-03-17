<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managements', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->string('st_details')->default('En Gestion');
            $table->integer('quantity')->default('0');
            $table->double('price')->nullable()->default('0.0');
            $table->date('dispatch_date')->nullable()->default(null);
            $table->time('dispatch_time')->nullable()->default(null);

            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->dateTime('created_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('managements');
    }
}

