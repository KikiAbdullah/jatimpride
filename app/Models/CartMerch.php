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

    public function merch()
    {
        return $this->belongsTo(Merch::class, 'merch_id', 'id');
    }

    public function getTotalAttribute()
    {
        return $this->merch->harga * $this->qty;
    }
}
