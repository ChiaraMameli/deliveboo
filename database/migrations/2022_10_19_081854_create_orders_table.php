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
            $table->unsignedBigInteger('restaurant_id')->nullable(); 
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('set null');
            $table->string('status');
            $table->smallInteger('amount');
            $table->string('customer_name');
            $table->string('customer_phone', 15);
            $table->string('customer_email');
            $table->string('customer_address');
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