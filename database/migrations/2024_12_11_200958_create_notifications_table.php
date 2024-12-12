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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('url')->nullable();
            $table->string('message')->nullable();
            $table->integer('is_read')->nullable();
            $table->timestamps();
            $table->integer('status')->default(1)->comment('1: Active, 0: Deleted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
