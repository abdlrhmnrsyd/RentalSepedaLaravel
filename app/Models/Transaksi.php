<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaksi extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 'peminjam_id', 'sepeda_id', 'tgl_pinjam', 'tgl_pulang',
        'bayar', 'denda', 'jaminan', 'status'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class);
    }

    public function sepeda()
    {
        return $this->belongsTo(Sepeda::class);
    }
}
