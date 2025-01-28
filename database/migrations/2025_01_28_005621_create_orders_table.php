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
            // Customer Information
            $table->string('name')->nullable(); // Name of the customer
            $table->string('email')->nullable(); // Email of the customer
            $table->string('phone', 20)->nullable(); // Phone number
            $table->text('address')->nullable(); // Address of the customer
            $table->unsignedBigInteger('user_id')->nullable(); // Reference to users table

            // Product Information
            $table->string('product_title')->nullable(); // Title of the product
            $table->integer('quantity')->nullable(); // Quantity of the product
            $table->decimal('price', 10, 2)->nullable(); // Price of the product
            $table->string('image')->nullable(); // Path to the product image
            $table->unsignedBigInteger('product_id')->nullable(); // Reference to products table

            // Order Status
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending'); // Payment status
            $table->enum('delivery_status', ['pending', 'shipped', 'delivered', 'cancelled'])->default('pending'); // Delivery status

            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
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
