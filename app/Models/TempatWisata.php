<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    // Balikkan ke tabel wisatas beb!
    protected $table = 'tempat_wisatas'; 
    protected $fillable = [
        'nama_wisata', 
        'pemilik', 
        'deskripsi', 
        'status'
    ];
}