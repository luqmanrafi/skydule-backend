<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Tugas extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'tugas';
    protected $fillable = [
       'nama_matakuliah',
       'judul_tugas',
       'deadline_tugas',
       'deskripsi_tugas'
        
    ];
}
