<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('seller_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('buyer_status', ['pending', 'approved', 'cancelled', 'completed'])->default('pending');
            $table->enum('admin_status', ['pending', 'approved', 'rejected'])->default('pending');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('seller_status');
            $table->dropColumn('buyer_status');
            $table->dropColumn('admin_status');

        });
    }
};
