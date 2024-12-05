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
        Schema::create('orders_items', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('quantity')->default(0);
            $table->decimal('price')->default(0);
            $table->string('color_id')->nullable();
            $table->string('color_name')->nullable();
            $table->string('size_id')->nullable();
            $table->string('size_name')->nullable();
            $table->decimal('size_amount')->default(0); 
            $table->decimal('total_price')->default(0); 
            $table->timestamps();
            $table->integer('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_items');
    }
};
