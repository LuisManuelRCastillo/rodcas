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
        Schema::table('cotizacion_detalles', function (Blueprint $table) {
            $table->string('descripcion')->nullable();
            $table->unsignedBigInteger('id_producto')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('cotizacion_detalles', function (Blueprint $table) {
            $table->dropColumn('descripcion');
            $table->unsignedBigInteger('id_producto')->nullable(false)->change();
        });
    }
};
