<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class polis extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_poli',
        'kode',
        'user_id',
    ];
}
