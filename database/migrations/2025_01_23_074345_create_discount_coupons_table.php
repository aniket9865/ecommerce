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
        Schema::create('discount_coupons', function (Blueprint $table) {
            $table->id();

            //The discount coupon code
            $table->string('code');

            //The human readable discount coupon code name
            $table->string('name')->nullable();

            //The description of the coupon - Not necessary
            $table->text('description')->nullable();

            //The max user this discount coupon has
            $table->integer('max_users')->nullable();

            //How many times a user can use this coupon
            $table->integer('max_uses_users')->nullable();

            //Whether or not the coupon is a percentage or a fixed price
            $table->enum('type',['percentage','fixed'])->default('fixed');

            //The amount to discount based on type
            $table->double('discount_amount',10,2);

            //The amount to discount based on type
            $table->double('min_amount',10,2)->nullable();

            $table->integer('status')->default(1);

            // When the coupon begins
            $table->dateTime('starts_at')->nullable();

            // When the coupon ends
            $table->dateTime('expires_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_coupons');
    }
};
