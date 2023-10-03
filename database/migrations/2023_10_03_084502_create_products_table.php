<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('unit_id');
            $table->string('image');
            $table->string('barcode')->unique();
            $table->string('title');
            $table->bigInteger('buy_price');
            $table->bigInteger('sell_price');
            $table->integer('stock');
            $table->enum('tax_type', ['PPN', 'NON-PPN'])->default('PPN');
            $table->enum('periode', ['Regular', 'Seasonal'])->default('Regular');
            $table->timestamps();

            //relationship categories
            $table->foreign('category_id')->references('id')->on('categories');
            //relationship vendors
            $table->foreign('vendor_id')->references('id')->on('vendors');
            //relationship units
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
