<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurplusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create category table
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('enable')->default(true);
            $table->timestamps();
        });

        // create product table
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->boolean('enable')->default(true);
            $table->timestamps();
        });

        // create category product pivot table
        Schema::create('category_product', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->primary(['category_id', 'product_id']);
        });

        // create image table
        Schema::create('image', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file');
            $table->boolean('enable')->default(true);
            $table->timestamps();
        });

        // create product image pivot table
        Schema::create('product_image', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('image_id');
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->foreign('image_id')->references('id')->on('image')->onDelete('cascade');
            $table->primary(['product_id', 'image_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // drop pivot tables first
        // Schema::dropIfExists('category_product');
        // Schema::dropIfExists('product_image');

        // drop other tables
        // Schema::dropIfExists('category');
        // Schema::dropIfExists('product');
        // Schema::dropIfExists('image');
    }
}
