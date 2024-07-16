<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            //$table->string('name');
            $table->string('slug')->unique();
            $table->string('photo')->nullable();
            $table->string('cover')->nullable();
            //$table->longText('description')->nullable();
            $table->boolean('is_master')->default(false);
            $table->boolean('in_main_menu')->default(false);
            $table->boolean('in_side_menu')->default(false);
            $table->boolean('in_bottom_menu')->default(true);
            $table->enum('status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('pages');
    }
}
