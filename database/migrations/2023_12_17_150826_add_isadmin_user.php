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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('is_admin')->default(0)->comment('1: Admin, 0: Customer')->after('remember_token');
            $table->integer('is_delete')->default(0)->comment('1: Deleted, 0: Not')->after('is_admin');
            $table->integer('status')->default(1)->comment('1: Active, 0: Inactive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_admin', 'is_delete', 'status']);
        });
    }
};
