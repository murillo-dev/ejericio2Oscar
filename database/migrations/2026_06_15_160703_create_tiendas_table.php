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
        Schema::create('tiendas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);

            $table->foreignId('titular_id')
                ->constrained('titulares')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('zona_id')
                ->constrained('zonas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->softDeletes();

            $table->timestamps();

            $table->index(['zona_id', 'titular_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiendas');
    }
};
