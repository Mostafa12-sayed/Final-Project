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
            $table->foreignId('store_id')->nullable()->constrained('stores')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('slug')->unique();

            $table->string('brand')->nullable();
            $table->float('weight')->default(0);

            $table->float('price')->default(0);
            $table->float('discount')->nullable();
            $table->date('expiry_date')->nullable();

            $table->json('gallery')->nullable();

            $table->string('code')->nullable();
            $table->float('tax')->default(0);

            $table->float('rating')->default(0)->nullable();

            $table->boolean('is_new')->default(1);

            $table->integer('stock')->default(0);
            $table->unsignedSmallInteger('quantity')->default(0);

            $table->json('options')->nullable();
            $table->enum('status', ['active', 'draft', 'archived'])->default('active');

            $table->timestamps();
            $table->softDeletes();
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
