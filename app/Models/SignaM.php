<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class SignaM extends Model
{
    protected $table = 'signa_m';
    protected $primaryKey = 'signa_id';
    public $timestamps = false;

    protected $fillable = [
        'signa_kode',
        'signa_nama',
        'is_active',
        'is_deleted',
        'created_date',
        'created_by',
        'last_modified_date',
        'last_modified_by',
        'deleted_date',
        'deleted_by',
    ];

    protected static function booted()
    {
        static::addGlobalScope('notDeleted', function (Builder $builder) {
            $builder->where('is_deleted', '!=', 1);
        });
    }
}
