<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasi';
    
    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'target_dana',
        'dana_terkumpul',
        'batas_waktu',
        'status',
        'gambar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksi()
    {
        return $this->hasMany(TransaksiDonasi::class);
    }

    public function penyaluran()
    {
        return $this->hasMany(PenyaluranDonasi::class);
    }

    public function progress()
    {
        return $this->hasMany(ProgressDonasi::class);
    }
} 