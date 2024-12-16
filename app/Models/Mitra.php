<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $table = 'mitra';
    
    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'alamat',
        'deskripsi',
        'logo',
        'status'
    ];

    public function penyaluranDonasi()
    {
        return $this->hasMany(PenyaluranDonasi::class);
    }
} 