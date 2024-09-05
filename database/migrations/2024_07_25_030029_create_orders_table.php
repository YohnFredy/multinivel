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
            $table->string('public_order_number')->unique();
            $table->foreignId('user_id')->constrained();
            $table->string('contact');
            $table->string('phone');
            $table->string('status')->default('pending');
            $table->enum('envio_type', [1, 2]);
            $table->float('discount')->nullable();
            $table->float('shipping_cost')->nullable();
            $table->float('total');
            $table->decimal('total_pts', 10, 2)->default(0);
            $table->foreignId('country_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('city_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('addCity')->nullable();
            $table->string('address')->nullable();
            $table->string('additional_address')->nullable();
            $table->string('payment_id')->nullable();
            $table->timestamps();

            $table->index('public_order_number');
            
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
