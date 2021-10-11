<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pharmacy_id')->unsigned();
            $table->unsignedBigInteger('product_id')->unsigned();
            $table->unsignedDecimal('product_price');
            $table->unsignedBigInteger('product_quantity');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies')->onDelete('cascade');;
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pharmacy_product');
    }
}
