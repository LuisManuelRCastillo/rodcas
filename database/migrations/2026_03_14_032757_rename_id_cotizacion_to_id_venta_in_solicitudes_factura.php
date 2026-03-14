<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solicitudes_factura', function (Blueprint $table) {
            $table->renameColumn('id_cotizacion', 'id_venta');
        });
    }

    public function down(): void
    {
        Schema::table('solicitudes_factura', function (Blueprint $table) {
            $table->renameColumn('id_venta', 'id_cotizacion');
        });
    }
};
