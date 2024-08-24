<div class="row mb-3">
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Tanggal</label>
    <div class="col-lg-10">
        {!! Form::text('tanggal', null, [
            'class' => in_array('tanggal', $errors->keys()) ? 'form-control daterange is-invalid' : 'form-control daterange',
            'placeholder' => 'Tanggal',
        ]) !!}
    </div>
</div>

<div class="row mb-3">
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Jenis Pengiriman ID</label>
    <div class="col-lg-4">
        {!! Form::select('jenis_pengiriman_id', $data['list_jenis_pengiriman'], null, [
            'class' => in_array('jenis_pengiriman_id', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'Pilih Jenis Pengiriman',
            'onchange' => 'toggleAddressRow(this)',
        ]) !!}
    </div>
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Bukti</label>
    <div class="col-lg-4">
        {!! Form::file('bukti', [
            'class' => in_array('bukti', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
        ]) !!}
    </div>
</div>

<div class="dikirim-row" style="display: none;">
    <div class="row mb-2">
        <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Provinsi</label>
        <div class="col-lg-4 mb-2">
            {!! Form::select('provinsi_id', $data['list_provinsi'], null, [
                'class' => 'form-control select provinsi_pribadi',
                'placeholder' => 'Provinsi',
                'onchange' => 'stateChange("/get-kota", this, "kota","nama_provinsi_pribadi")',
            ]) !!}
        </div>
        <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Kabupaten</label>
        <div class="col-lg-4">
            {!! Form::select('kabupaten_id', isset($custom_data) ? $custom_data['list_kabupaten'] : [], null, [
                'class' => 'form-control select kota',
                'placeholder' => 'Kabupaten',
                'onchange' => 'stateChange("/get-kecamatan", this, "kecamatan", "nama_kota_pribadi")',
            ]) !!}
        </div>
    </div>
    <div class="row mb-2">
        <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Kecamatan</label>
        <div class="col-lg-4 mb-2">
            {!! Form::select('kecamatan_id', isset($custom_data) ? $custom_data['list_kecamatan'] : [], null, [
                'class' => 'form-control select kecamatan',
                'placeholder' => 'Kecamatan',
                'onchange' => 'stateChange("/get-kelurahan", this, "kelurahan", "nama_kecamatan_pribadi")',
            ]) !!}
        </div>
        <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Kelurahan</label>
        <div class="col-lg-4">
            {!! Form::select('kelurahan_id', isset($custom_data) ? $custom_data['list_kelurahan'] : [], null, [
                'class' => 'form-control select kelurahan',
                'placeholder' => 'Kelurahan',
                'onchange' => 'stateChange(null, this, null, "nama_kelurahan_pribadi")',
            ]) !!}
        </div>
    </div>
    <div class="row mb-2">
        <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Alamat Lengkap</label>
        <div class="col-lg-10 mb-2">
            {!! Form::textarea('alamat', null, [
                'class' => 'form-control',
                'placeholder' => 'Alamat Lengkap',
                'rows' => 2,
            ]) !!}
        </div>
    </div>

</div>


<div class="row mb-3">
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Keterangan</label>
    <div class="col-lg-10">
        {!! Form::textarea('text', null, [
            'class' => in_array('text', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'Keterangan',
            'rows' => 2,
        ]) !!}
    </div>
</div>

<hr>

<div class="table-responsive">
    <table class="table table-bordered table-xxs">
        <thead>
            <tr>
                <th width="20%">Item</th>
                <th width="20%" class="text-end">Qty</th>
                <th width="5%">
                    <div onclick="DuplicateForm()" class="btn_add_row"><i class="ph-plus-circle text-primary"></i></div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {!! Form::select('merch_id[]', $data['list_merch'], null, [
                        'class' => 'form-control tform select',
                        'placeholder' => 'Item',
                    ]) !!}
                </td>
                <td>
                    {!! Form::number('qty', null, [
                        'class' => in_array('qty', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
                        'placeholder' => 'Qty',
                    ]) !!}
                </td>
                <td>
                    <div onclick="RemoveRow(this)" class="btn_add_row">
                        <i class="ph-x-circle text-danger"></i>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
