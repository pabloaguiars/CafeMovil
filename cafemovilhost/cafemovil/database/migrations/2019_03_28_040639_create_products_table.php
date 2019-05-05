<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            //columns
            $table->bigIncrements('id');
            $table->string('id_at_store');
            $table->string('name');
            $table->string('unit_price');
            $table->string('description');
            $table->string('image_url');
            $table->boolean('status');
            $table->timestamps();
            $table->bigInteger('id_seller')->unsigned();
        });

        Schema::table('products', function (Blueprint $table) {
            //add foreign keys
            $table->foreign('id_seller')->references('id')->on('sellers');
            $table->unique(['id_at_store','id_seller']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
