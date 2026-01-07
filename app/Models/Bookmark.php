<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bookmark extends Model {
    use HasFactory;

    protected $table = 'bookmark';

    protected $primaryKey = 'id_bookmark';

    protected $fillable = [
        'id_wisatawan',
        'id_wisata',
        'tanggal_simpan',
        'catatan',
        'kategori'
    ];

    public function wisatawan() {
        return $this->belongsTo(Wisatawan::class, 'id_wisatawan');
    }

    public function tempatWisata() {
        return $this->belongsTo(TempatWisata::class, 'id_wisata');
    }
}

