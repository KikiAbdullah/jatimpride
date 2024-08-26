<?php

namespace App\Models\Master;

use App\Models\Traits\CreatedByTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Crew extends Model
{
    use SoftDeletes;
    use CreatedByTrait;

    protected $table     = 'crews';
    protected $fillable = [
        'name',
        'jabatan',
        'urutan',
        'foto',
        'instagram',
        'facebook',
        'linkedin',
        'whatsapp',
        'created_by',
    ];

    protected $appends = [
        'foto_url',
    ];

    public function getFotoUrlAttribute()
    {
        $path = 'crew/' . $this->foto;
        if (Storage::exists('public/' . $path)) {
            return asset('storage/' . $path);
        } else {
            return asset('app_local/img/tshirt-placeholder.jpg');
        }
    }
}
