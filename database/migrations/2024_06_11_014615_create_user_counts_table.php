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
        Schema::create('user_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnUpdate();
            $table->integer('total_direct')->default(0);
            $table->integer('total_unilevel')->default(0);
            $table->integer('total_binary_left')->default(0);
            $table->integer('total_binary_right')->default(0);
            $table->timestamps();

            $table->index('user_id');
            $table->index('total_direct');
            $table->index('total_unilevel');
            $table->index('total_binary_left');
            $table->index('total_binary_right');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_counts');
    }
};
