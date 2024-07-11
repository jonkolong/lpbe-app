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
        Schema::table('tabel_berkas', function (Blueprint $table) {
            $table->string('posisi')->nullable(true)->default('Kosong')->after('file_call_center');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tabel_berkas', function (Blueprint $table) {
            $table->dropColumn('posisi');
        });
    }
};
