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
        Schema::create('iuran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warga_id');
            $table->string('jenis_iuran', 100);
            $table->decimal('nominal', 12, 2);
            $table->date('tanggal_iuran');
            $table->string('status')->default('belum_bayar');
            $table->timestamps();

            $table->foreign('warga_id')
                ->references('id')
                ->on('warga')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iuran');
    }
};
