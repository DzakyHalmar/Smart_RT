<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('iuran', function (Blueprint $table) {
            $table->unsignedTinyInteger('bulan')
                ->nullable()
                ->after('warga_id');

            $table->unsignedSmallInteger('tahun')
                ->nullable()
                ->after('bulan');

            $table->unique(
                ['warga_id', 'tahun', 'bulan'],
                'iuran_warga_tahun_bulan_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('iuran', function (Blueprint $table) {
            $table->dropUnique('iuran_warga_tahun_bulan_unique');
            $table->dropColumn(['bulan', 'tahun']);
        });
    }
};
