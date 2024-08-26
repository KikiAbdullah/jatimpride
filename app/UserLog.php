<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table     = 'user_logs';
    protected $fillable = [
        'no',
        'user_id',
        'action',
        'menu',
        'message',
    ];

    protected $appends = [
        'action_formatted',
    ];

    public function getActionFormattedAttribute()
    {
        $icon = '';
        $color = '';

        switch ($this->action) {
            case 'Penambahan':
                $icon = '<i class="ph ph-plus-circle"></i>';
                $color = 'success';
                break;

            case 'Perubahan':
                $icon = '<i class="ph ph-pencil-circle"></i>';
                $color = 'indigo';
                break;

            case 'Penghapusan':
                $icon = '<i class="ph ph-x-circle"></i>';
                $color = 'danger';
                break;

            case 'Konfirmasi':
                $icon = '<i class="ph ph-check-circle"></i>';
                $color = 'success';
                break;

            case 'Batal Konfirmasi':
                $icon = '<i class="ph ph-x-circle"></i>';
                $color = 'danger';
                break;

            case 'Selesai':
                $icon = '<i class="ph ph-circle-wavy-check"></i>';
                $color = 'success';
                break;

            case 'Batal Selesai':
                $icon = '<i class="ph ph-x-circle"></i>';
                $color = 'danger';
                break;
        }

        return ' <div class="bg-' . $color . ' bg-opacity-10 text-' . $color . ' lh-1 rounded-pill p-2">
                                        ' . $icon . '
                                    </div>';
    }
}
