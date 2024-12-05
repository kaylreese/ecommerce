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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company_name')->nullable(); // Campo opcional
            $table->string('country')->nullable();
            $table->string('address_one')->nullable();
            $table->string('address_two')->nullable(); // Campo opcional
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('notes')->nullable(); // Campo opcional
            $table->string('discount_code')->nullable();
            $table->string('discount_amount', 25)->nullable();
            $table->integer('shipping_id')->nullable();
            $table->decimal('shipping_amount')->default(0);
            $table->decimal('total_amount')->default(0); 
            $table->string('payment_method', 25)->default(); // Métodos de pago
            $table->timestamps();
            $table->integer('deleted')->default(0);
            $table->integer('is_payment')->default(0);
            $table->text('payment_data')->nullable();
            $table->integer('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
