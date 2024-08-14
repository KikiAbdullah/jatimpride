<?php

namespace App\Models;

use App\Models\Master\JenisPengiriman;
use App\Models\Master\Kabupaten;
use App\Models\Master\Kecamatan;
use App\Models\Master\Kelurahan;
use App\Models\Master\Payment;
use App\Models\Master\Provinsi;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trans extends Model
{
    use SoftDeletes;

    protected $table     = 'trans';
    protected $fillable = [
        'no',
        'tanggal',
        'customer_id',
        'jenis_pengiriman_id',
        'text',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'kelurahan_id',
        'alamat',
        'bukti',
        'noresi',
        'status',

        'confirm_by',
        'confirm_at',

        'closed_by',
        'closed_at',

        'rejected_by',
        'rejected_at',

        'text_reject',
    ];

    protected $appends = [
        'alamat_prov',
    ];

    /**
     * Relation to Customer model.
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    /**
     * Relation to JenisPengiriman model.
     */
    public function jenisPengiriman()
    {
        return $this->belongsTo(JenisPengiriman::class);
    }

    /**
     * Relation to Payment model.
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Relation to Lines model.
     */
    public function lines()
    {
        return $this->hasMany(TransLine::class, 'trans_id', 'id');
    }


    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    public function getStatusFormattedAttribute()
    {
        $title      = '';
        $badge      = '';

        switch ($this->status) {
            case 'open':
                $title      = 'Open';
                $badge      = 'info';
                break;
            case 'confirm':
                $title      = 'Confirmed';
                $badge      = 'secondary';
                break;
            case 'closed':
                $title      = 'Closed';
                $badge      = 'success';
                break;
            case 'rejected':
                $title      = 'Rejected';
                $badge      = 'danger';
                break;
        }

        return '<span class="badge bg-' . $badge . '">' . $title . '</span>';
    }


    public function getAlamatProvAttribute()
    {
        $result = $this->provinsi->nama_provinsi ?? "";
        if (!empty($result)) {
            $result .= " // ";
        }
        $result .= $this->kabupaten->nama_kabupaten ?? "";
        if (!empty($result)) {
            $result .= " // ";
        }
        $result .= $this->kecamatan->nama_kecamatan ?? "";
        return $result;
    }
}
