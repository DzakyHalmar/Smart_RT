<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('iuran', function (Blueprint $table) {
            $table->string('no_kk', 16)->nullable()->after('warga_id');
        });

        // Hubungkan catatan iuran lama dengan nomor KK warga.
        DB::statement("
            UPDATE iuran
            INNER JOIN warga ON iuran.warga_id = warga.id
            SET iuran.no_kk = warga.no_kk
            WHERE iuran.no_kk IS NULL
        ");

        Schema::table('iuran', function (Blueprint $table) {
            $table->dropUnique('iuran_warga_tahun_bulan_unique');

            $table->unique(
                ['no_kk', 'tahun', 'bulan'],
                'iuran_no_kk_tahun_bulan_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('iuran', function (Blueprint $table) {
            $table->dropUnique('iuran_no_kk_tahun_bulan_unique');

            $table->unique(
                ['warga_id', 'tahun', 'bulan'],
                'iuran_warga_tahun_bulan_unique'
            );

            $table->dropColumn('no_kk');
        });
    }
};
