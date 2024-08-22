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
                        <th width="10%">Tanggal</th>
                        @foreach ($list_size as $size)
                            <th>{{ strtoupper($size) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items['result'] as $tanggal => $item)
                        <tr>
                            <td>{{ $tanggal }}</td>
                            @foreach ($list_size as $id => $size)
                                <td class="text-center">{{ $item[$id] ?? 0 }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    <tr>
                        <td class="fw-semibold">Total</td>
                        @foreach ($list_size as $id => $size)
                            <td class="text-center fw-semibold">{{ $items['total'][$id] ?? 0 }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
