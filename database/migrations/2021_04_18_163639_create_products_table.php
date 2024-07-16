<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('sku')->nullable();
            $table->string('slug')->unique();
            // $table->mediumText('summary');
            // $table->longText('description')->nullable();
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('child_cat_id')->nullable();
            $table->longText('photo');
            $table->float('price')->nullable()->default(0);
            $table->float('old_price')->nullable()->default(0);
            $table->float('discount')->nullable()->default(0);
            $table->integer('liked')->nullable();
            $table->string('size')->default(0);
            $table->enum('status',['active','inactive'])->default('active');
            $table->enum('conditions',['featured','new','sale'])->default('new');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('child_cat_id')->references('id')->on('categories')->onDelete('SET NULL');
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
        Schema::dropIfExists('products');
    }
}
