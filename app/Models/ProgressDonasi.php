<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressDonasi extends Model
{
    use HasFactory;

    protected $table = 'progress_donasi';
    
    protected $fillable = [
        'donasi_id',
        'judul',
        'deskripsi',
        'persentase_progress',
        'foto'
    ];

    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }
} 