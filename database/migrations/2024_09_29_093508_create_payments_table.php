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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('notification_id')->unique()->nullable(); // UUID de la notificación
            $table->string('type', 50)->nullable(); // Tipo de la notificación
            $table->string('subject')->nullable(); // ID de la transacción
            $table->string('source')->nullable(); // Recurso que lanzó la notificación
            $table->string('spec_version')->nullable(); // Versión de la especificación
            $table->string('time')->nullable(); // Hora de emisión en formato POSIX como string
            $table->string('payment_gateway')->nullable(); // Pasarela de pago
            $table->string('payment_id_generated')->nullable(); // ID de la transacción generado por Bold
            $table->string('merchant_id')->nullable(); // ID del comercio
            $table->string('user_id')->nullable(); // ID del usuario
            $table->decimal('total_amount', 10, 2)->nullable(); // Monto total
            $table->decimal('tip', 10, 2)->nullable(); // Propina
            $table->string('cardholder_name')->nullable(); // Nombre del tarjetahabiente
            $table->string('franchise')->nullable(); // Franquicia de la tarjeta
            $table->string('capture_mode')->nullable(); // Método de captura
            $table->string('terminal_id')->nullable(); // ID del datáfono
            $table->string('reference')->nullable(); // Referencia de pago
            $table->string('payment_method')->nullable(); // Método de pago como string
            $table->json('taxes')->nullable(); // Lista de impuestos (en formato JSON)
            $table->json('unknown_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
