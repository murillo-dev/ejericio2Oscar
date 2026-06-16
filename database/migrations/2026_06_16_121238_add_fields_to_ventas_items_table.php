<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ventas_items', function (Blueprint $table) {
            if (!Schema::hasColumn('ventas_items', 'venta_id')) {
                $table->unsignedBigInteger('venta_id')->after('id');
                $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('cascade');
            }
            if (!Schema::hasColumn('ventas_items', 'producto_id')) {
                $table->unsignedBigInteger('producto_id')->after('venta_id');
                $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            }
            if (!Schema::hasColumn('ventas_items', 'cantidad')) {
                $table->integer('cantidad')->after('producto_id');
            }
            if (!Schema::hasColumn('ventas_items', 'precio_unitario')) {
                $table->decimal('precio_unitario', 10, 2)->after('cantidad');
            }
            if (!Schema::hasColumn('ventas_items', 'subtotal')) {
                $table->decimal('subtotal', 10, 2)->after('precio_unitario');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ventas_items', function (Blueprint $table) {
            $table->dropForeignKey('ventas_items_venta_id_foreign');
            $table->dropForeignKey('ventas_items_producto_id_foreign');
            $table->dropColumn(['venta_id', 'producto_id', 'cantidad', 'precio_unitario', 'subtotal']);
        });
    }
};
