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
        Schema::create('user_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate();
            $table->decimal('personal_pts', 8, 2)->default(0);
            $table->decimal('left_pts', 12, 2)->default(0);
             $table->decimal('right_pts', 12, 2)->default(0);
            $table->decimal('unilevel_pts', 12, 2)->default(0);
            $table->enum('status', [1, 2, 3])->default(1)->comment('1: Active, 2: Process, 3: Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_points');
    }
};
