<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penilaian extends Model {
    use HasFactory;

    protected $table = 'penilaian';

    protected $primaryKey = 'id_penilaian';

    protected $fillable = [
        'id_wisatawan',
        'id_wisata',
        'penilaian',
        'ulasan',
        'judul_ulasan',
        'foto_ulasan',
        'tanggal_penilaian',
        'status_penilaian'
    ];

    public function wisatawan() {
        return $this->belongsTo(Wisatawan::class, 'id_wisatawan');
    }

    public function tempatWisata() {
        return $this->belongsTo(TempatWisata::class, 'id_wisata');
    }
}

