<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('vendor_id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->double('product_price');
            $table->integer('quantity');
            $table->double('shipping_price');
            $table->integer('shipping_days')->nullable();
            $table->boolean('review')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('order_products');
    }
}
