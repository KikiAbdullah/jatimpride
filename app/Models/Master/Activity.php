<?php

namespace App\Models\Master;

use App\Models\Traits\CreatedByTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Activity extends Model
{
    use SoftDeletes;
    use CreatedByTrait;

    protected $table     = 'activities';
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
        $path = 'activity/' . $this->foto;
        if (Storage::exists('public/' . $path)) {
            return asset('storage/' . $path);
        } else {
            return asset('app_local/img/tshirt-placeholder.jpg');
        }
    }
}
