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
            $table->string('order_number')->nullable();
            $table->string('stripe_session_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company_name')->nullable(); // Campo opcional
            $table->string('country')->nullable();
            $table->string('address_one')->nullable();
            $table->string('address_two')->nullable(); // Campo opcional
            $table->string('city')->nullable();
            $table->string('status')->nullable()->comment('0: Pending, 1: Inprogress, 2: Delivered, 3: Completed, 4: Cancelled');
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
            $table->integer('state')->default(1);
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
