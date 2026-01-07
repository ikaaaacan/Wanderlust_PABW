<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Administrator extends Model {
    use HasFactory;

    protected $table = 'administrator';

    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'id_user',
        'jabatan'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}
