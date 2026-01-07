<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model {
    use HasFactory;

    protected $table = 'pembayaran';

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_transaksi',
        'tanggal_bayar',
        'jumlah_pembayaran',
        'metode_pembayaran',
        'status_pembayaran',
        'bukti_pembayaran'
    ];

    public function transaksi() {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }
}

