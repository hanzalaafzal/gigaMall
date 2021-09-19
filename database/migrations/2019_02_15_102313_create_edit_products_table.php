<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edit_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('shop_id');
            $table->string('title');
            $table->text('description');
            $table->string('photo');
            $table->integer('price');
            $table->integer('shipping_price');
            $table->integer('quantity');
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->integer('product_type');
            $table->string('slug');
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
        Schema::dropIfExists('edit_products');
    }
}
