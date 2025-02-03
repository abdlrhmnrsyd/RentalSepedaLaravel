<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'peminjam_id', 'sepeda_id', 'tgl_pinjam', 'tgl_pulang',
        'bayar', 'denda', 'jaminan', 'status'
    ];

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class);
    }

    public function sepeda()
    {
        return $this->belongsTo(Sepeda::class);
    }
}
