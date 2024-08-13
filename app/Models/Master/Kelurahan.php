<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelurahan extends Model
{
    use SoftDeletes;

    protected $table     = 'kelurahan';
    protected $fillable = [
        'kecamatan_id',
        'nama_kelurahan',
        'code',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // relation
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function area()
    {
        return $this->hasMany(Area::class);
    }
    //

    // get attribute
    public function getNamaKelurahanWithIdAttribute()
    {
        return $this->id . '|' . $this->nama_kelurahan;
    }
    //

    // scope
    //

    // data
    public function formatDataApi()
    {
        return [
            'id'                => $this->id,
            'nama'              => $this->nama_kelurahan,
        ];
    }
    //
}
