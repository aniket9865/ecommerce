<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rating_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Who liked/disliked
            $table->foreignId('product_rating_id')->constrained()->onDelete('cascade'); // Which rating
            $table->enum('type', ['like', 'dislike']);
            $table->timestamps();

            // Optional: Prevent multiple likes/dislikes from same user on same rating
            $table->unique(['user_id', 'product_rating_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rating_reactions');
    }
};
