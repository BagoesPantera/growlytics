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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('external_id', 64)->unique();
            $table->foreignId('item_id')->constrained()->restrictOnDelete();
            $table->enum('side', ['buy', 'sell']);
            $table->unsignedBigInteger('price_wl');
            $table->string('server')->nullable();
            $table->string('channel')->nullable();
            $table->string('world', 100)->nullable();
            $table->boolean('world_verified')->default(false);
            $table->text('url')->nullable();
            $table->timestamp('posted_at', 3);
            $table->timestamps();

            $table->index(['item_id', 'side', 'posted_at']);
            $table->index(['item_id', 'side', 'price_wl']);
            $table->index('posted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
