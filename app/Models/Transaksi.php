<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model {
    use HasFactory;

    protected $table = 'transaksi';

    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_wisatawan',
        'id_tiket',
        'jumlah_tiket',
        'status_transaksi',
        'tanggal_transaksi',
        'total_harga',
        'kode_transaksi',
        'catatan_transaksi'
    ];

    public function wisatawan() {
        return $this->belongsTo(Wisatawan::class, 'id_wisatawan');
    }

    public function tiket() {
        return $this->belongsTo(TiketTempatWisata::class, 'id_tiket');
    }

    public function pembayaran() {
        return $this->hasOne(Pembayaran::class, 'id_transaksi');
    }
}

