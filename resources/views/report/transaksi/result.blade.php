<div class="card w-100 mx-auto">
    <div class="card-header d-flex flex-wrap">
        <h5 class="mb-0"><i class="ph-files me-1"></i>Result {{ $title ?? '' }}
            <div class="fs-sm text-body">
            </div>
        </h5>
        <div class="d-flex ms-auto justify-content-end fs-sm">
            <button type="button" id="btnexport" class="btn btn-success me-2 mb-2"
                onclick="ExportExcel('{{ $title }}')">
                <i class="ph-microsoft-excel-logo me-1"></i>
                Save Excel
            </button>
        </div>
    </div>
    <div class="content_isi">
        <div class="card-body">
            <table>
                <tbody>
                    <tr>
                        <td class="pr-2">
                            <div class="nh-icon nh-icon-report cyan"></div>
                        </td>
                        <td>
                            <div class="fw-bold font-size-lg">{{ $title }}</div>
                            <div>Tanggal: {{ $tanggal }}</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-xxs table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th rowspan="2" width="10%">Tanggal</th>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Customer</th>
                        <th rowspan="2">Jenis Pengiriman</th>
                        <th colspan="{{ count($merchSize) }}">Size</th>
                        <th rowspan="2">Qty</th>
                        <th rowspan="2">Keterangan</th>
                        <th rowspan="2">Status</th>
                        <th rowspan="2">Total(Rp)</th>
                    </tr>
                    <tr>
                        @foreach ($merchSize as $size)
                            <th>{{ $size }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td class="text-center">{{ formatDate('Y-m-d', 'd/m/Y', $item->tanggal) }}</td>
                            <td class="text-center">{{ $item->no }}</td>
                            <td class="text-center">{{ $item->customer->name ?? '' }}</td>
                            <td class="text-center">{{ $item->jenisPengiriman->name ?? '' }}</td>
                            @foreach ($merchSize as $merchId => $size)
                                <td class="text-center fw-semibold">
                                    {{ $item->lines->where('merch_id', $merchId)->sum('qty') ?? '' }}
                                </td>
                            @endforeach
                            <td class="text-end fw-semibold">{{ $item->lines->sum('qty') }}</td>
                            <td>
                                <small>{{ $item->text ?? '' }}</small>
                                @if ($item->status == 'rejected')
                                    <br><small>Rejected : {{ $item->text_reject ?? '' }}</small>
                                @endif
                            </td>
                            <td class="text-center">{!! $item->status_formatted !!}</td>
                            <td class="text-end fw-semibold">{{ cleanNumber($item->total) ?? '' }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="fw-semibold text-end" colspan="{{ count($merchSize) + 6 }}">Total</td>
                        <td class="text-end fw-semibold">{{ cleanNumber($items->sum('total')) ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
