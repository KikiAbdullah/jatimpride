<?php

namespace App\Models\Master;

use App\Models\Traits\CreatedByTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    use SoftDeletes;
    use CreatedByTrait;

    protected $table     = 'settings';
    protected $fillable = [
        'icon',
        'logo',
        'event_logo',
        'event_gmaps',
        'event_date',
        'about_foto',
        'about_name',
        'about_jabatan',
        'about_text',
        'contact_name',
        'contact_alamat',
        'contact_whatsapp',
        'contact_email',
        'contact_instagram',
        'contact_tiktok',
        'contact_youtube',
    ];

    protected $appends = [
        'icon_url',
        'logo_url',
        'event_logo_url',
        'about_foto_url',
    ];

    public function getIconUrlAttribute()
    {
        $path = 'icon/' . $this->icon;
        if (Storage::exists('public/' . $path)) {
            return asset('storage/' . $path);
        } else {
            return asset('app_local/img/favicon.png');
        }
    }

    public function getLogoUrlAttribute()
    {
        $path = 'logo/' . $this->logo;
        if (Storage::exists('public/' . $path)) {
            return asset('storage/' . $path);
        } else {
            return asset('app_local/img/logo.png');
        }
    }

    public function getEventLogoUrlAttribute()
    {
        $path = 'event_logo/' . $this->event_logo;
        if (Storage::exists('public/' . $path)) {
            return asset('storage/' . $path);
        } else {
            return asset('app_local/img/jp4.png');
        }
    }

    public function getAboutFotoUrlAttribute()
    {
        $path = 'about_foto/' . $this->about_foto;
        if (Storage::exists('public/' . $path)) {
            return asset('storage/' . $path);
        } else {
            return asset('app_local/img/mas-fadh.jpg');
        }
    }


    //SET
    public function setEventDateAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['event_date']  = formatDate('d-m-Y H:i:s', 'Y-m-d H:i:s', $value);
        }
    }
}
