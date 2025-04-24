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
        Schema::table('stores', function (Blueprint $table) {
            $table->foreignId('admin_id')->after('id')->constrained('admins')->onDelete('cascade');
            $table->decimal('commission_rate', 5, 2)->default(0);
            $table->enum('is_approved', ['yes', 'no'])->default('no');
            $table->decimal('rate', 4, 2)->after('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('', function (Blueprint $table) {});
    }
};
