<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Decimal;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->decimal('sale_income', 10, 2)->default(0);
            $table->decimal('commission_income', 10, 2)->default(0);
            $table->decimal('binary_points_for_payment', 10, 2)->default(0);
            $table->decimal('pool1_percentage')->default(40);
            $table->decimal('pts_value')->default(1);
            $table->enum('status', [1, 2, 3])->default(1)->comment('1: Active, 2: Process, 3: Inactive');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
