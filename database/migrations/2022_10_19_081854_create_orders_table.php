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
            $table->smallInteger('amount')->default(50);
            $table->string('customer_name')->default('pippo');
            $table->string('customer_phone', 15)->default(1234567890);
            $table->string('customer_email')->default('io@tu.noi');
            $table->string('customer_address')->default('casatua');
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