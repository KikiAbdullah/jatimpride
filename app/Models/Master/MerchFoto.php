<?php

namespace App\Models\Master;

use App\Models\Traits\CreatedByTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class MerchFoto extends Model
{
    use SoftDeletes;
    use CreatedByTrait;

    protected $table     = 'merch_fotos';
    protected $fillable = [
        'name',
        'urutan',
        'foto',
        'created_by',
    ];

    protected $appends = [
        'foto_url',
    ];

    public function getFotoUrlAttribute()
    {
        $path = 'merch/' . $this->foto;
        if (Storage::exists('public/' . $path)) {
            return asset('storage/' . $path);
        } else {
            return asset('app_local/img/tshirt-placeholder.jpg');
        }
    }
}
