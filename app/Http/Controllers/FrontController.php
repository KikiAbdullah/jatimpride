<?php

namespace App\Http\Controllers;

use App\Models\Master\Merch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'is_login' => Auth::check(),
        ];

        return view('front.index', $data);
    }

    public function merchandise(Request $request)
    {
        $merch = Merch::all();

        $data = [
            'item' => (clone $merch)->first(),
            'list_size' => implode(', ', (clone $merch)->pluck('size', 'size')->toArray()),
            'harga' => 'Rp ' . cleanNumber((clone $merch)->min('harga')) . ' - Rp ' . cleanNumber((clone $merch)->max('harga')),

            'is_login' => Auth::check(),

        ];

        return view('front.merchandise', $data);
    }
}
