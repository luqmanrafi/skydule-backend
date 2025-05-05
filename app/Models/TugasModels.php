<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TugasModels extends Model
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
