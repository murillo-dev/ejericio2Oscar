<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            if (!Schema::hasColumn('ventas', 'vendedor_id')) {
                $table->unsignedBigInteger('vendedor_id')->nullable()->after('id');
                $table->foreign('vendedor_id')->references('id')->on('vendedores')->onDelete('set null');
            }
            if (!Schema::hasColumn('ventas', 'tienda_id')) {
                $table->unsignedBigInteger('tienda_id')->nullable()->after('vendedor_id');
                $table->foreign('tienda_id')->references('id')->on('tiendas')->onDelete('set null');
            }
            if (!Schema::hasColumn('ventas', 'estado')) {
                $table->enum('estado', ['pendiente', 'completada', 'cancelada'])->default('pendiente')->after('tienda_id');
            }
            if (!Schema::hasColumn('ventas', 'total')) {
                $table->decimal('total', 10, 2)->default(0)->after('estado');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropForeignKey('ventas_vendedor_id_foreign');
            $table->dropForeignKey('ventas_tienda_id_foreign');
            $table->dropColumn(['vendedor_id', 'tienda_id', 'estado', 'total']);
        });
    }
};
