<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mengantri extends Model
{
    use HasFactory;
    protected $fillable = ['nama_pelanggan', 'kode_antrian', 'alamat', 'nomor_hp', 'tanggal_ngantri', 'id_poli_tsd', 'user_id', 'created_at'];
    public function antrian()
    {
        return $this->belongsTo(poli_tsds::class);
    }
}
