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
        Schema::create('solicitudes_factura', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cotizacion')->nullable();
            $table->string('rfc', 13);
            $table->string('nombre');
            $table->string('codigo_postal', 10);
            $table->string('regimen_fiscal');
            $table->string('uso_cfdi');
            $table->string('email');
            $table->enum('estatus', ['pendiente', 'completada'])->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_factura');
    }
};
