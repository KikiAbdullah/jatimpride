<?php

namespace App\Http\Controllers;

use App\Models\Master\Merch;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        return view('front.index');
    }

    public function merchandise(Request $request)
    {
        $merch = Merch::all();

        $data = [
            'item' => (clone $merch)->first(),
            'list_size' => implode(', ', (clone $merch)->pluck('size', 'size')->toArray()),
            'harga' => 'Rp '. cleanNumber((clone $merch)->min('harga')) . ' - Rp ' . cleanNumber((clone $merch)->max('harga')),
        ];

        return view('front.merchandise', $data);
    }
}
