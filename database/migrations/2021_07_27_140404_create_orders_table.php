<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // detail of user
            $table->string('full_name');
            $table->string('mobile_number');
            $table->string('email');
            
            // detail of address
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->string('zip_code')->nullable()->default(0);

            // order details
            $table->float('sub_total')->default(0);
            $table->float('total_amount')->default(0);
            $table->integer('payment_method')->default(0);
            $table->enum('status',['new','pending','canceled','completed'])->default('new');
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
        Schema::dropIfExists('orders');
    }
}
