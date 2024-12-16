<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyaluranDonasi extends Model
{
    use HasFactory;

    protected $table = 'penyaluran_donasi';
    
    protected $fillable = [
        'donasi_id',
        'mitra_id',
        'jumlah',
        'keterangan',
        'tanggal_penyaluran',
        'bukti_penyaluran'
    ];

    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }
} 