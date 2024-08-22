<?php

namespace App\Http\Controllers;

use App\Models\Master\Merch;
use App\Models\Trans;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    ///HELPER
    public function makeRequest($data)
    {
        ['tanggal_awal' => $data['tanggal_awal'], 'tanggal_akhir' => $data['tanggal_akhir']]         = $this->explodeTanggal($data['tanggal']);

        unset($data['tanggal']);

        return $data;
    }

    public function explodeTanggal($tanggal)
    {
        $explode                = explode(' - ', $tanggal);

        return [
            'tanggal_awal'      => formatDate('d/m/Y', 'Y-m-d', $explode[0]),
            'tanggal_akhir'     => formatDate('d/m/Y', 'Y-m-d', $explode[1]),
        ];
    }
    ///HELPER

    ///TRANSAKSI
    public function transaksiIndex(Request $request)
    {
        $view             = [
            'title'             => 'Transaksi',
            'data'              => [
                'list_size'             => $this->listMerch(),
                'list_jenis_pengiriman' => $this->listJenisPengiriman(),
                'list_status'           => $this->listStatus(),
            ],
        ];

        return view('report.transaksi.index')->with($view);
    }

    public function transaksiResult(Request $request)
    {

        $validator                     = Validator::make($request->all(), [
            'tanggal'                 => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($this->makeValidationMessage($validator->messages()), Response::HTTP_BAD_REQUEST);
        }

        $data                         = $this->makeRequest($request->all());

        $items                         =  $this->makeReportTransaksi($data);

        $response                   = responseFailed();

        if (!empty($items)) {
            $view                   = [
                'title'                 => "Laporan Transaksi",
                'items'                 => $items,
                'tanggal'               => $request->tanggal,
            ];

            $render                 = view('report.transaksi.result', $view)->render();
            $response               = responseSuccess($render);
        }

        return response()->json($response);
    }

    public function makeReportTransaksi($data)
    {
        $trans = Trans::with(['lines'])
            ->whereBetween('tanggal', [$data['tanggal_awal'], $data['tanggal_akhir']])
            ->reportTransaksiFilter($data)
            ->get();

        return $trans;
    }
    ///TRANSAKSI


    ///STOK MERCH
    public function stokMerchIndex(Request $request)
    {
        $view             = [
            'title'             => 'Stok Merch',
            'data'              => [
                'list_size'             => $this->listSize(),
            ],
        ];

        return view('report.stok_merch.index')->with($view);
    }

    public function stokMerchResult(Request $request)
    {

        $validator                     = Validator::make($request->all(), [
            'tanggal'                 => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($this->makeValidationMessage($validator->messages()), Response::HTTP_BAD_REQUEST);
        }

        $data                         = $this->makeRequest($request->all());

        $items                         =  $this->makeReportStokMerch($data);

        $response                   = responseFailed();

        if (!empty($items)) {
            $view                   = [
                'title'                 => "Laporan Transaksi",
                'items'                 => $items,
                'list_size'             => $this->listSize(),
                'tanggal'               => $request->tanggal,
            ];

            $render                 = view('report.stok_merch.result', $view)->render();
            $response               = responseSuccess($render);
        }

        return response()->json($response);
    }

    public function makeReportStokMerch($data)
    {
        $trans = Trans::with(['lines', 'lines.merch'])
            ->whereBetween('tanggal', [$data['tanggal_awal'], $data['tanggal_akhir']])
            ->reportTransaksiFilter($data)
            ->whereHas('lines', function ($query) use ($data) {
                if ($data['merch_id']) {
                    $query->where('merch_id', $data['merch_id']);
                }
            })
            ->orderBy('tanggal', 'desc')
            ->get();

        $results = [];
        $total = [];

        foreach ($trans->groupBy('tanggal') as $tanggal => $tr) {
            foreach ($tr as $trx) {
                foreach ($trx->lines as $line) {
                    @$results[$tanggal][$line->merch_id] += $line->qty;
                    @$total[$line->merch_id] += $line->qty;
                }
            }
        }

        return [
            'result'    => $results,
            'total'     => $total,
        ];
    }
    ///STOK MERCH

}
