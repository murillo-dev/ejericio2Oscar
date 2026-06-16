<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('titulares', function (Blueprint $table) {
            $table->string('email')->unique()->after('nombre');
            $table->string('telefono')->nullable()->after('email');
            $table->string('documento')->unique()->nullable()->after('telefono');
            $table->boolean('activo')->default(true)->after('documento');
        });
    }

    public function down(): void
    {
        Schema::table('titulares', function (Blueprint $table) {
            $table->dropColumn(['email', 'telefono', 'documento', 'activo']);
        });
    }
};
