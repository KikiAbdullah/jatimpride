<?php

namespace App\Models\Master;

use App\Models\Traits\CreatedByTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function getNameSizeAttribute()
    {
        return $this->name . ' - ' . strtoupper($this->size);
    }

    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . cleanNumber($this->harga);
    }
}
