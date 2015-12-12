<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('catalog_products', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->integer('category');
            $table->text('content');
            $table->text('image');
            $table->integer('price');
            $table->boolean('status');
            $table->text('author');
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
        //
        Schema::drop('catalog_products');
    }
}
