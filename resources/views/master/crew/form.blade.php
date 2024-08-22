@if (isset($item) && !empty($item->foto))
    <div class="row mb-2">
        <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">&nbsp;</label>
        <div class="col-lg-2 col-4 mb-1">
            <div class="d-flex mb-2" style="position: relative;">
                <a href="#" style="position: absolute;right:0;" onclick="remove_file(this);"><i
                        class="ph-x-circle bg-white rounded-circle" style="color: red"></i></a>
                <a href="{{ asset($item->foto_formatted) }}">
                    <img src="{{ asset($item->foto_formatted) }}" class="rounded" style="width:100%;object-fit:cover;">
                </a>
                <input type="hidden" name="file_exist" value="1">
            </div>
        </div>
    </div>
@endif

<div class="row mb-2">
    <label class="col-lg-3 col-form-label text-lg-end d-none d-lg-block">Foto</label>
    <div class="col-lg-9 mb-1">
        {!! Form::file('foto', [
            'class' => 'form-control',
            'id' => 'fileToUpload',
        ]) !!}
    </div>
</div>

<div class="row mb-3">
    <label class="col-lg-3 col-form-label text-lg-end d-none d-lg-block">Name</label>
    <div class="col-lg-9">
        {!! Form::text('name', null, [
            'class' => in_array('name', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'Name',
        ]) !!}
    </div>
</div>

<div class="row mb-3">
    <label class="col-lg-3 col-form-label text-lg-end d-none d-lg-block">Jabatan</label>
    <div class="col-lg-9">
        {!! Form::text('jabatan', null, [
            'class' => in_array('jabatan', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'Jabatan',
        ]) !!}
    </div>
</div>

<div class="row mb-3">
    <label class="col-lg-3 col-form-label text-lg-end d-none d-lg-block">Urutan</label>
    <div class="col-lg-9">
        {!! Form::number('urutan', null, [
            'class' => in_array('urutan', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'Urutan',
        ]) !!}
    </div>
</div>
