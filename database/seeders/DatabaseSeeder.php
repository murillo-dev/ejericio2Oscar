<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Supervisor;
use App\Models\Tienda;
use App\Models\Titular;
use App\Models\Venta;
use App\Models\VentaItem;
use App\Models\Vendedor;
use App\Models\Zona;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        echo "Iniciando seeding...\n";

        // Crear zonas
        echo "Creando zonas...\n";
        $zonas = Zona::insert([
            ['nombre' => 'Zona Metropolitana', 'descripcion' => 'Área metropolitana central', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Zona Norte', 'descripcion' => 'Zona norte de la región', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Zona Sur', 'descripcion' => 'Zona sur de la región', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Zona Oriente', 'descripcion' => 'Zona oriental de la región', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Crear titulares
        echo "Creando titulares...\n";
        Titular::insert([
            ['nombre' => 'Juan García López', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'María Rodríguez Pérez', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Carlos Martínez Silva', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Ana Fernández González', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Pedro López Jiménez', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Crear tiendas
        echo "Creando tiendas...\n";
        Tienda::insert([
            ['nombre' => 'Tienda Centro 1', 'titular_id' => 1, 'zona_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Tienda Centro 2', 'titular_id' => 2, 'zona_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Tienda Norte 1', 'titular_id' => 3, 'zona_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Tienda Sur 1', 'titular_id' => 4, 'zona_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Tienda Oriente 1', 'titular_id' => 5, 'zona_id' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Crear supervisores
        echo "Creando supervisores...\n";
        Supervisor::insert([
            ['nombre' => 'Supervisor 1 - Roberto', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Supervisor 2 - Javier', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Supervisor 3 - Miguel', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Crear vendedores
        echo "Creando vendedores...\n";
        Vendedor::insert([
            ['nombre' => 'Vendedor 1 - Luis', 'supervisor_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Vendedor 2 - Diego', 'supervisor_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Vendedor 3 - Fernando', 'supervisor_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Vendedor 4 - Ricardo', 'supervisor_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Vendedor 5 - Andrés', 'supervisor_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Crear productos
        echo "Creando productos...\n";
        Producto::insert([
            ['nombre' => 'Producto A - Bebida Cola', 'precio' => 2.50, 'stock' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Producto B - Jugo Natural', 'precio' => 3.00, 'stock' => 80, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Producto C - Agua Mineral', 'precio' => 1.50, 'stock' => 150, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Producto D - Cerveza', 'precio' => 4.50, 'stock' => 60, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Producto E - Refresco Frutal', 'precio' => 2.00, 'stock' => 120, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Crear ventas
        echo "Creando ventas...\n";
        Venta::insert([
            ['fecha' => now()->subDays(10), 'vendedor_id' => 1, 'tienda_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['fecha' => now()->subDays(9), 'vendedor_id' => 2, 'tienda_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['fecha' => now()->subDays(8), 'vendedor_id' => 3, 'tienda_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['fecha' => now()->subDays(7), 'vendedor_id' => 4, 'tienda_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['fecha' => now()->subDays(6), 'vendedor_id' => 5, 'tienda_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Crear items de ventas
        echo "Creando detalles de ventas...\n";
        VentaItem::insert([
            ['venta_id' => 1, 'producto_id' => 1, 'cantidad' => 10, 'unidad_medida' => 'caja', 'precio_venta' => 2.50, 'created_at' => now(), 'updated_at' => now()],
            ['venta_id' => 1, 'producto_id' => 3, 'cantidad' => 5, 'unidad_medida' => 'caja', 'precio_venta' => 1.50, 'created_at' => now(), 'updated_at' => now()],
            ['venta_id' => 2, 'producto_id' => 2, 'cantidad' => 8, 'unidad_medida' => 'caja', 'precio_venta' => 3.00, 'created_at' => now(), 'updated_at' => now()],
            ['venta_id' => 2, 'producto_id' => 4, 'cantidad' => 6, 'unidad_medida' => 'caja', 'precio_venta' => 4.50, 'created_at' => now(), 'updated_at' => now()],
            ['venta_id' => 3, 'producto_id' => 1, 'cantidad' => 12, 'unidad_medida' => 'caja', 'precio_venta' => 2.50, 'created_at' => now(), 'updated_at' => now()],
            ['venta_id' => 3, 'producto_id' => 5, 'cantidad' => 10, 'unidad_medida' => 'caja', 'precio_venta' => 2.00, 'created_at' => now(), 'updated_at' => now()],
            ['venta_id' => 4, 'producto_id' => 2, 'cantidad' => 7, 'unidad_medida' => 'caja', 'precio_venta' => 3.00, 'created_at' => now(), 'updated_at' => now()],
            ['venta_id' => 5, 'producto_id' => 3, 'cantidad' => 15, 'unidad_medida' => 'caja', 'precio_venta' => 1.50, 'created_at' => now(), 'updated_at' => now()],
        ]);

        echo "¡Seeding completado exitosamente!\n";
    }
}
