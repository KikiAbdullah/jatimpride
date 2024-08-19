<?php

namespace App\Models\Master;

use App\Models\Traits\CreatedByTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Merch extends Model
{
    use SoftDeletes;
    use CreatedByTrait;

    protected $table     = 'merches';
    protected $fillable = [
        'name',
        'size',
        'text',
        'harga',
        'stok',
        'thumbnail',
        'created_by',
    ];

    protected $appends = [
        'thumb_mobile',
    ];

    public function getThumbMobileAttribute()
    {
        $path = 'thumbnail/' . $this->id . '/' . $this->thumbnail;
        if (Storage::exists('public/' . $path)) {
            return asset('storage/' . $path);
        } else {
            return asset('app_local/img/tshirt-placeholder.jpg');
        }
    }

    public function getNameSizeAttribute()
    {
        return $this->name . ' - ' . strtoupper($this->size);
    }

    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . cleanNumber($this->harga);
    }
}
