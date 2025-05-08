<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTugasCollection extends Migration
{
    public function up()
    {
        Schema::connection('mongodb')->create('tugas', function ($collection) {
            $collection->index('nama_matakuliah');
            $collection->index('judul_tugas');
            $collection->index('deadline_tugas');
            $collection->index('deskripsi_tugas');
        });
    }

    public function down()
    {
   
        Schema::connection('mongodb')->drop('tugas');
    }
}
