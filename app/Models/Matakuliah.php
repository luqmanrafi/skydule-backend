<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Matakuliah extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'matakuliah';
    protected $fillable = [
        'id_matakuliah',
        'nama_matakuliah',
        'dosen_pengajar',
        'jenis_matakuliah',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
    ];
}
