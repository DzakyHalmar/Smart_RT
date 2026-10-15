<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->string('nama', 100);
            $table->string('jabatan', 100);
            $table->string('no_telepon', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->dropColumn([
                'nama',
                'jabatan',
                'no_telepon',
                'alamat',
                'foto',
            ]);
        });
    }
};