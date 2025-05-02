<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMatakuliahCollection extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Buat koleksi 'matakuliah' jika belum ada
        Schema::connection('mongodb')->create('matakuliah', function ($collection) {
            // Tambahkan indeks jika diperlukan
            $collection->index('id_matakuliah');
            $collection->index('nama_matakuliah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus koleksi 'matakuliah' jika ada
        Schema::connection('mongodb')->drop('matakuliah');
    }
}
