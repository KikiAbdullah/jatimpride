<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kecamatan extends Model
{
    use SoftDeletes;

    protected $table     = 'kecamatan';
    protected $fillable = [
        'kabupaten_id',
        'nama_kecamatan',
        'code',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts     = [
        'code'             => 'array',
    ];

    // relation
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class);
    }

    public function area()
    {
        return $this->hasMany(Area::class);
    }

    public function getCodeArrayAttribute()
    {
        return unserialize($this->code);
    }
    //

    // get attribute
    public function getNamaKecamatanWithIdAttribute()
    {
        return $this->id . '|' . $this->nama_kecamatan;
    }
    //

    // scope
    //

    // data
    public function formatDataApi()
    {
        return [
            'id'                => $this->id,
            'nama'              => $this->nama_kecamatan,
        ];
    }
    // 
}
