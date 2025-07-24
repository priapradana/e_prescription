<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResepDetail extends Model
{
    protected $table = 'resep_detail';
    protected $primaryKey = 'resep_detail_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'resep_id',
        'obatalkes_id',
        'racikan_id',
        'is_racikan_header',
        'nama_racikan',
        'signa_kode',
        'signa_nama',
        'jumlah',
    ];

    protected $casts = [
        'is_racikan_header' => 'boolean',
        'jumlah' => 'float',
        // 'resep_detail_id' => 'integer', // optional
    ];

    public function resep()
    {
        return $this->belongsTo(Resep::class, 'resep_id', 'resep_id');
    }

    public function obatalkes()
    {
        return $this->belongsTo(ObatalkesM::class, 'obatalkes_id');
    }
}

