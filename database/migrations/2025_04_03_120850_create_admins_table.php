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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
   
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('username')->unique();
            $table->foreignId('store_id')->nullable()->constrained('stores','id')->nullOnDelete();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();

            $table->enum('type',['user','admin'])->default('user');

            $table->enum('status',['active' ,'pending' , 'inactive'])->default('pending'); // Default status is 'active'
            $table->string('remember_token')->nullable();
            $table->string('profile_picture')->nullable(); // Optional profile picture
            $table->string('last_login_ip')->nullable(); // Optional last login IP
            $table->timestamp('last_login_at')->nullable(); // Optional last login timestamp
            $table->string('verification_token')->nullable(); // Optional verification token
            $table->boolean('is_verified')->default(false); // Default is not verified
            $table->boolean('is_suspended')->default(false); // Default is not suspended
            $table->boolean('is_deleted')->default(false); // Default is not deleted
            $table->string('created_by')->nullable(); // Optional created by user
            $table->string('updated_by')->nullable(); // Optional updated by user
            $table->string('deleted_by')->nullable(); // Optional deleted by user
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
