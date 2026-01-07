<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PemilikTempatWisata extends Model {
    use HasFactory;

    protected $table = 'pemilik_tempat_wisata';

    protected $primaryKey = 'id_ptw';

    protected $fillable = [
        'id_user',
        'jabatan',
        'nama_organisasi',
        'alamat_bisnis',
        'npwp',
        'siu',
        'foto_organisasi',
        'status_akun',
        'catatan_revisi'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tempatWisata() {
        return $this->hasMany(TempatWisata::class, 'id_ptw');
    }
}

