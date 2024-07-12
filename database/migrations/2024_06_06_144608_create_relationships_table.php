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
        Schema::create('relationships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnUpdate();
            $table->foreignId('parent_id')->nullable()->constrained('users')->cascadeOnUpdate();
            $table->foreignId('binary_parent_id')->nullable()->constrained('users')->cascadeOnUpdate();
            $table->enum('position', ['left', 'right'])->nullable();
            $table->timestamps();

            $table->unique(['binary_parent_id', 'position']);
            $table->index('user_id');
            $table->index('parent_id');
            $table->index('binary_parent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relationships');
    }
};
