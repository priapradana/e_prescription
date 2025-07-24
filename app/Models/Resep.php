<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $table = 'resep';
    protected $primaryKey = 'resep_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'no_resep',
        'tanggal',
        'pasien_nama',
        'created_by',
    ];

    // Jika butuh
    protected $casts = [
        'tanggal' => 'date',
        // 'resep_id' => 'integer', // optional
    ];

    public function details()
    {
        return $this->hasMany(ResepDetail::class, 'resep_id', 'resep_id');
    }
    
}

