<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wisatawan extends Model {
    use HasFactory;

    protected $table = 'wisatawan';

    protected $primaryKey = 'id_wisatawan';

    protected $fillable = [
        'id_user',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'usia',
        'status_akun',
        'kota_asal',
        'preferensi_wisata'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function transaksi() {
        return $this->hasMany(Transaksi::class, 'id_wisatawan');
    }

    public function penilaian() {
        return $this->hasMany(Penilaian::class, 'id_wisatawan');
    }

    public function bookmark() {
        return $this->hasMany(Bookmark::class, 'id_wisatawan');
    }
}
