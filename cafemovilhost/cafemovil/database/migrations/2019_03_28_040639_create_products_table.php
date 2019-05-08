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
            $table->decimal('unit_price',13,4);
            $table->integer('at_inventory');
            $table->string('description');
            $table->string('image_url');
            $table->boolean('status');
            $table->bigInteger('id_seller')->unsigned();
            $table->bigInteger('id_product_type')->unsigned();
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            //add foreign keys
            $table->foreign('id_product_type')->references('id')->on('products_types');
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
