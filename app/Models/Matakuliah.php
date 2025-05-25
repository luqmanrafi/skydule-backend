<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Operation\FindOneAndUpdate;

class Matakuliah extends Model
{
    use HasFactory;
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

    protected static function booted(){
        static::creating(function ($matakuliah) {
            if(empty($matakuliah->id_matakuliah)){
                $matakuliah->id_matakuliah = static::generateNextIdMatakuliah();
            }
        });
    }

    protected static function generateNextIdMatakuliah()
    {
        $countersCollectionName = 'counters';
        $sequenceIdName = 'matakuliah_id';
        $database = DB::connection('mongodb')->getMongoDB();

        $countersCollection = $database->selectCollection($countersCollectionName);
        $counterDoc = $countersCollection->findOneAndUpdate(
                ['_id' => $sequenceIdName],
                ['$inc' => ['seq' => 1]],
                [
                    'upsert' => true,
                    'returnDocument' => FindOneAndUpdate::RETURN_DOCUMENT_AFTER
                ]
            );
        $nextNumber = $counterDoc && isset($counterDoc->seq) ? $counterDoc->seq : 1;
        $formattedNumber = str_pad((string) $nextNumber, 3, '0', STR_PAD_LEFT);

        return 'MK' . $formattedNumber;
    }

}
