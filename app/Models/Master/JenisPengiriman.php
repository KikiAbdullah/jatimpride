<?php

namespace App\Models\Master;

use App\Models\Traits\CreatedByTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisPengiriman extends Model
{
    use SoftDeletes;
    use CreatedByTrait;

    protected $table     = 'jenis_pengiriman';
    protected $fillable = [
        'name',
        'text',
        'created_by',
    ];
}
