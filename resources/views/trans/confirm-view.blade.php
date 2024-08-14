<div class="row">
    <div class="col-lg-9">
        <div class="row mb-1">
            <label class="col-lg-3 text-lg-end fw-normal text-muted form-custom-head">Tanggal</label>
            <div class="col-lg-9 mb-1">
                <div class="fw-semibold form-control-plaintext">
                    {{ formatDate('Y-m-d H:i:s', 'd/m/Y H:i:s', $item->created_at) }}</div>
            </div>
        </div>
        <div class="row mb-1">
            <label class="col-lg-3 text-lg-end fw-normal text-muted form-custom-head">No</label>
            <div class="col-lg-9 mb-1">
                <div class="fw-semibold form-control-plaintext">{{ ucwords($item->no) }}</div>
            </div>
        </div>
        <div class="row mb-1">
            <label class="col-lg-3 text-lg-end fw-normal text-muted form-custom-head">Customer</label>
            <div class="col-lg-9 mb-1">
                <div class="fw-semibold form-control-plaintext">{{ ucwords($item->customer->name) }}</div>
            </div>
        </div>
        <div class="row mb-1">
            <label class="col-lg-3 text-lg-end fw-normal text-muted form-custom-head">Keterangan</label>
            <div class="col-lg-9 mb-1">
                <div class="form-control-plaintext">{{ $item->text }}</div>
            </div>
        </div>
        <div class="row mb-1">
            <label class="col-lg-3 text-lg-end fw-normal text-muted form-custom-head">Alamat</label>
            <div class="col-lg-9 mb-1">
                <div class="form-control-plaintext">{{ $item->alamat_prov }}</div>
                <div class="form-control-plaintext">{{ $item->alamat }}</div>
            </div>
        </div>
        <div class="row mb-1">
            <label class="col-lg-3 text-lg-end fw-normal text-muted form-custom-head">Status</label>
            <div class="col-lg-9 mb-1">
                <div class="form-control-plaintext">{!! $item->status_formatted !!}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 text-center">
        <div class="card">
            <div class="card-img-actions m-1">
                <img class="card-img img-fluid" style="max-height: 300px;"
                    src="{{ asset('storage/bukti_pengiriman/' . $item->id . '/' . $item->bukti) }}" alt="">
                <div class="card-img-actions-overlay card-img">
                    <a href="{{ asset('storage/bukti_pengiriman/' . $item->id . '/' . $item->bukti) }}"
                        class="btn btn-outline-white btn-icon rounded-pill" data-bs-popup="lightbox"
                        data-gallery="gallery1">
                        <i class="ph-magnifying-glass"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-xxs table-bordered" id="dtable">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th width="10%">Size</th>
                        <th width="10%" class="text-end">Qty</th>
                        <th width="20%" class="text-end">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item->lines as $line)
                        <tr>
                            <td>{{ $line->merch->name ?? '' }}</td>
                            <td>{{ $line->size }}</td>
                            <td class="text-end">{{ $line->qty }}</td>
                            <td class="text-end">{{ cleanNumber($line->harga) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="3">Total</th>
                        <th class="text-end">{{ cleanNumber($item->lines->sum('total')) }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end align-items-center mt-3">
    <a href="{{ route($url, $id) }}" data-title="Konfirmasi" data-icon="question" data-tipe="confirm"
        class="btn btn-success btn-labeled btn-labeled-start rounded-pill btnOption">
        <span class="btn-labeled-icon bg-black bg-opacity-20 m-1 rounded-pill">
            <i class="ph-check-circle"></i>
        </span>
        Konfirmasi
    </a>
</div>
