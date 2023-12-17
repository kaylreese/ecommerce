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
            $table->string('title')->nullable(false);
            $table->string('url');
            $table->string('category_id');
            $table->string('subcategory_id');
            $table->string('size');
            $table->string('color');
            $table->string('brand_id');
            $table->double('old_price')->default(0.00000)->nullable(false);
            $table->double('price')->default(0.00000)->nullable(false);
            $table->text('short_description');
            $table->text('description');
            $table->text('additional_information');
            $table->text('shipping_returns');
            $table->integer('created_by');
            $table->timestamps();
            $table->integer('status')->default(1)->comment('1: Active, 0: Deleted');
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
