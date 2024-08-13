<?php

namespace App\Models\Master;

use App\Models\Traits\CreatedByTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    use CreatedByTrait;

    protected $table     = 'payments';
    protected $fillable = [
        'name',
        'norek',
        'text',
        'created_by',
    ];
}
