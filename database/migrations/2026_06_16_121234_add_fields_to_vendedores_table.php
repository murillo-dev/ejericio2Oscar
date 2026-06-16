<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vendedores', function (Blueprint $table) {
            $table->string('email')->unique()->after('nombre');
            $table->string('telefono')->nullable()->after('email');
            $table->boolean('activo')->default(true)->after('supervisor_id');
        });
    }

    public function down(): void
    {
        Schema::table('vendedores', function (Blueprint $table) {
            $table->dropColumn(['email', 'telefono', 'activo']);
        });
    }
};
