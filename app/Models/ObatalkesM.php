<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ObatalkesM extends Model
{
    protected $table = 'obatalkes_m';

    protected $primaryKey = 'obatalkes_id'; 
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'obatalkes_kode',
        'obatalkes_nama',
        'stok',
        'additional_data',
        'created_date',
        'created_by',
        'modified_count',
        'last_modified_date',
        'last_modified_by',
        'is_deleted',
        'is_active',
        'deleted_date',
        'deleted_by'

    ];

    public $timestamps = false;

    protected static function booted()
    {
        static::addGlobalScope('notDeleted', function (Builder $builder) {
            $builder->where('is_deleted', '!=', 1);
        });
    }

    public function resepDetails()
    {
        return $this->hasMany(\App\Models\ResepDetail::class, 'obatalkes_id', 'obatalkes_id');
    }

    
}
