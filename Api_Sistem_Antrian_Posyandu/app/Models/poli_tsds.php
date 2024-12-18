<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class poli_tsds extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_poli_tsd',
        'kode_poli_tsd',
        'deskripsi',
        'slug',
        'syarat',
        'kuota',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Ambilantrians()
    {
        return $this->hasMany(mengantri::class);
    }

    public function layanan()
    {
        return $this->belongsTo(polis::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_antrian'
            ]
        ];
    }


}
