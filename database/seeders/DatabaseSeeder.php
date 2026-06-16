<?php

namespace Database\Seeders;

use App\Models\Zona;
use App\Models\Supervisor;
use App\Models\Vendedor;
use App\Models\Titular;
use App\Models\Tienda;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\VentaItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Iniciando seeding...');

        // Crear Zonas
        $this->command->line('Creando zonas...');
        $zonasData = [
            ['nombre' => 'Centro', 'descripcion' => 'Zona Centro de la ciudad', 'codigo' => 'CTR'],
            ['nombre' => 'Norte', 'descripcion' => 'Zona Norte de la ciudad', 'codigo' => 'NRT'],
            ['nombre' => 'Sur', 'descripcion' => 'Zona Sur de la ciudad', 'codigo' => 'SUR'],
            ['nombre' => 'Este', 'descripcion' => 'Zona Este de la ciudad', 'codigo' => 'EST'],
            ['nombre' => 'Oeste', 'descripcion' => 'Zona Oeste de la ciudad', 'codigo' => 'OES'],
        ];
        $zonas = [];
        foreach ($zonasData as $data) {
            $zonas[] = Zona::create($data);
        }

        // Crear Supervisores
        $this->command->line('Creando supervisores...');
        $supervisoresData = [
            ['nombre' => 'Carlos López', 'email' => 'carlos.lopez@empresa.com', 'telefono' => '1234567890', 'activo' => true],
            ['nombre' => 'María García', 'email' => 'maria.garcia@empresa.com', 'telefono' => '1234567891', 'activo' => true],
            ['nombre' => 'Juan Rodríguez', 'email' => 'juan.rodriguez@empresa.com', 'telefono' => '1234567892', 'activo' => true],
            ['nombre' => 'Ana Martínez', 'email' => 'ana.martinez@empresa.com', 'telefono' => '1234567893', 'activo' => true],
            ['nombre' => 'Luis Fernández', 'email' => 'luis.fernandez@empresa.com', 'telefono' => '1234567894', 'activo' => true],
        ];
        $supervisores = [];
        foreach ($supervisoresData as $data) {
            $supervisores[] = Supervisor::create($data);
        }

        // Crear Vendedores
        $this->command->line('Creando vendedores...');
        for ($i = 1; $i <= 20; $i++) {
            Vendedor::create([
                'nombre' => "Vendedor $i",
                'email' => "vendedor$i@empresa.com",
                'telefono' => '123456789' . $i,
                'zona_id' => $zonas[($i - 1) % 5]->id,
                'supervisor_id' => $supervisores[($i - 1) % 5]->id,
                'activo' => true
            ]);
        }

        // Crear Titulares
        $this->command->line('Creando titulares...');
        $titularesData = [
            ['nombre' => 'Pedro González', 'email' => 'pedro.gonzalez@tiendas.com', 'telefono' => '9876543210', 'documento' => '12345678A', 'activo' => true],
            ['nombre' => 'Rosa Sánchez', 'email' => 'rosa.sanchez@tiendas.com', 'telefono' => '9876543211', 'documento' => '12345678B', 'activo' => true],
            ['nombre' => 'Miguel Pérez', 'email' => 'miguel.perez@tiendas.com', 'telefono' => '9876543212', 'documento' => '12345678C', 'activo' => true],
            ['nombre' => 'Luisa Jiménez', 'email' => 'luisa.jimenez@tiendas.com', 'telefono' => '9876543213', 'documento' => '12345678D', 'activo' => true],
            ['nombre' => 'Fernando Ruiz', 'email' => 'fernando.ruiz@tiendas.com', 'telefono' => '9876543214', 'documento' => '12345678E', 'activo' => true],
        ];
        $titulares = [];
        foreach ($titularesData as $data) {
            $titulares[] = Titular::create($data);
        }

        // Crear Tiendas
        $this->command->line('Creando tiendas...');
        $tiendas = [];
        for ($i = 1; $i <= 15; $i++) {
            $tiendas[] = Tienda::create([
                'nombre' => "Tienda $i",
                'direccion' => "Calle Principal $i, Ciudad",
                'zona_id' => $zonas[($i - 1) % 5]->id,
                'titular_id' => $titulares[($i - 1) % 5]->id,
                'activo' => true
            ]);
        }

        // Crear Productos
        $this->command->line('Creando productos...');
        $productos = [];
        $productosData = [
            ['nombre' => 'Laptop Dell', 'descripcion' => 'Laptop profesional Dell XPS', 'precio' => 999.99, 'sku' => 'DELL-XPS-001'],
            ['nombre' => 'Monitor LG 27"', 'descripcion' => 'Monitor LG 4K 27 pulgadas', 'precio' => 299.99, 'sku' => 'LG-MON-001'],
            ['nombre' => 'Teclado Mecánico', 'descripcion' => 'Teclado mecánico RGB', 'precio' => 129.99, 'sku' => 'KEY-MEC-001'],
            ['nombre' => 'Mouse Logitech', 'descripcion' => 'Mouse inalámbrico Logitech', 'precio' => 49.99, 'sku' => 'MOUSE-LOG-001'],
            ['nombre' => 'Auriculares Sony', 'descripcion' => 'Auriculares inalámbricos Sony', 'precio' => 199.99, 'sku' => 'SONY-AUR-001'],
            ['nombre' => 'Webcam HD', 'descripcion' => 'Webcam Full HD 1080p', 'precio' => 79.99, 'sku' => 'WEB-CAM-001'],
            ['nombre' => 'Cable HDMI', 'descripcion' => 'Cable HDMI 2.1 de 2m', 'precio' => 14.99, 'sku' => 'HDMI-CAB-001'],
            ['nombre' => 'Hub USB-C', 'descripcion' => 'Hub USB-C 7 en 1', 'precio' => 59.99, 'sku' => 'HUB-USB-001'],
            ['nombre' => 'SSD 1TB', 'descripcion' => 'SSD 1TB NVMe M.2', 'precio' => 99.99, 'sku' => 'SSD-NVM-001'],
            ['nombre' => 'Ram 16GB DDR4', 'descripcion' => 'RAM 16GB DDR4 3200MHz', 'precio' => 79.99, 'sku' => 'RAM-DDR4-001'],
        ];

        foreach ($productosData as $data) {
            $productos[] = Producto::create([
                'nombre' => $data['nombre'],
                'descripcion' => $data['descripcion'],
                'precio' => $data['precio'],
                'stock' => rand(20, 100),
                'sku' => $data['sku']
            ]);
        }

        // Crear Ventas y VentaItems
        $this->command->line('Creando ventas...');
        $vendedores = Vendedor::all();
        
        for ($v = 1; $v <= 30; $v++) {
            $venta = Venta::create([
                'fecha' => now()->subDays(rand(0, 30)),
                'vendedor_id' => $vendedores->random()->id,
                'tienda_id' => $tiendas[array_rand($tiendas)]->id,
                'estado' => ['pendiente', 'completada', 'cancelada'][rand(0, 2)],
                'total' => 0
            ]);

            $total = 0;
            $itemCount = rand(1, 5);
            
            for ($i = 0; $i < $itemCount; $i++) {
                $producto = $productos[array_rand($productos)];
                $cantidad = rand(1, 5);
                $subtotal = $cantidad * $producto->precio;
                $total += $subtotal;

                VentaItem::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $producto->precio,
                    'subtotal' => $subtotal
                ]);
            }

            $venta->update(['total' => $total]);
        }

        $this->command->info('✅ Seeding completado exitosamente!');
        $this->command->info('📊 Datos creados:');
        $this->command->info('  - ' . Zona::count() . ' zonas');
        $this->command->info('  - ' . Supervisor::count() . ' supervisores');
        $this->command->info('  - ' . Vendedor::count() . ' vendedores');
        $this->command->info('  - ' . Titular::count() . ' titulares');
        $this->command->info('  - ' . Tienda::count() . ' tiendas');
        $this->command->info('  - ' . Producto::count() . ' productos');
        $this->command->info('  - ' . Venta::count() . ' ventas');
        $this->command->info('  - ' . VentaItem::count() . ' items de venta');
    }
}

