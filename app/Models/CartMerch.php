<?php

namespace App\Models;

use App\Models\Master\Merch;
use App\Models\Traits\CreatedByTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartMerch extends Model
{
    use SoftDeletes;
    use CreatedByTrait;

    protected $table     = 'cart_merches';
    protected $fillable = [
        'merch_id',
        'qty',
        'created_by',
    ];

    protected $appends = [
        'total',
        'total_formatted',
        'harga_formatted',
    ];

    public function merch()
    {
        return $this->belongsTo(Merch::class, 'merch_id', 'id');
    }

    public function getTotalAttribute()
    {
        return $this->merch->harga * $this->qty;
    }

    public function getTotalFormattedAttribute()
    {
        return 'Rp ' . cleanNumber($this->total);
    }

    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . cleanNumber($this->harga);
    }
}
