<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TiketTempatWisata extends Model {
    use HasFactory;

    protected $table = 'tiket_tempat_wisata';

    protected $primaryKey = 'id_tiket';

    protected $fillable = [
        'id_wisata',
        'nama_tiket',
        'harga',
        'jumlah',
        'deskripsi',
        'foto_tiket'
    ];

    public function tempatWisata() {
        return $this->belongsTo(TempatWisata::class, 'id_wisata');
    }

    public function transaksi() {
        return $this->hasMany(Transaksi::class, 'id_tiket');
    }
}

