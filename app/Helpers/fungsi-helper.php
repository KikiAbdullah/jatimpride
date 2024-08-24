<?php

use App\Models\Master\Setting;
use Carbon\Carbon;

function st_aktif($var)
{
    if (empty($var)) {
        return "<center><div class=\"badge bg-primary\">Enabled</div></center>";
    } else {
        return "<center><div class=\"badge bg-light text-body\">Disabled</div></center>";
    }
}

function cleanNumber($val)
{
    return  str_replace('.00', '', number_format($val, 2, '.', ','));
}

function namaBulan($var)
{
    switch ($var) {
        case 1:
            $result = "Januari";
            break;
        case 2:
            $result = "Februari";
            break;
        case 3:
            $result = "Maret";
            break;
        case 4:
            $result = "April";
            break;
        case 5:
            $result = "Mei";
            break;
        case 6:
            $result = "Juni";
            break;
        case 7:
            $result = "Juli";
            break;
        case 8:
            $result = "Agustus";
            break;
        case 9:
            $result = "September";
            break;
        case 10:
            $result = "Oktober";
            break;
        case 11:
            $result = "November";
            break;
        case 12:
            $result = "Desember";
            break;
        default:
            $result = "";
    }
    return $result;
}

if (!function_exists('formatDate')) {

    function formatDate($from, $to, $date)
    {
        if (!empty($date)) {
            return Carbon::createFromFormat($from, $date)->format($to);
        }
    }
}


if (!function_exists('responseSuccess')) {

    function responseSuccess($data = [], $message = 'Data saved.')
    {
        return [
            'status'            => true,
            'msg'               => $message,
            'data'              => $data,
        ];
    }
}

if (!function_exists('responseFailed')) {

    function responseFailed($message = 'Gagal')
    {
        return [
            'status'            => false,
            'msg'               => $message,
            'data'              => [],
        ];
    }
}


if (!function_exists('imgToBase64')) {

    function imgToBase64($image)
    {
        $imageContent = file_get_contents($image);
        // Mengonversi gambar ke base64
        $base64 = base64_encode($imageContent);
        // Menambahkan tipe konten gambar untuk penggunaan yang lebih mudah
        $mimeType = mime_content_type($image);

        return  'data:' . $mimeType . ';base64,' . $base64;
    }
}



if (!function_exists('setting')) {

    function setting($column)
    {
        return Setting::first()->{$column} ?? '';
    }
}
