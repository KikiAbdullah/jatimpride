<?php

namespace App\Models;

use App\Models\Master\Merch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransLine extends Model
{
    use SoftDeletes;

    protected $table     = 'trans_lines';
    protected $fillable = [
        'trans_id',
        'merch_id',
        'size',
        'text',
        'qty',
        'harga',
    ];

    protected $appends = [
        'total',
    ];

    public function trans()
    {
        return $this->belongsTo(Trans::class);
    }

    public function merch()
    {
        return $this->belongsTo(Merch::class);
    }

    public function getTotalAttribute()
    {
        return $this->harga * $this->qty;
    }
}
