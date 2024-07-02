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
        Schema::table('tabel_tandatangan_naskah', function (Blueprint $table) {
            $table->string('pangkat')->nullable(true)->default('Kosong')->after('nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tabel_tandatangan_naskah', function (Blueprint $table) {
            $table->dropColumn('pangkat');
        });
    }
};
