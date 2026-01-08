<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisatawan extends Model
{
    // Beritahu Laravel kalau tabelnya bernama 'wisatawan'
    protected $table = 'wisatawan';

    protected $fillable = [
        'nama',
        'email',
        'status',
    ];
}