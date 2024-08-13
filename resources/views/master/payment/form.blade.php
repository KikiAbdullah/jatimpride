<div class="row mb-3">
    <label class="col-lg-3 col-form-label text-lg-end d-none d-lg-block">Bank Name</label>
    <div class="col-lg-9">
        {!! Form::text('bank', null, [
            'class' => in_array('bank', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'Bank Name',
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
    <label class="col-lg-3 col-form-label text-lg-end d-none d-lg-block">No Rekening</label>
    <div class="col-lg-9">
        {!! Form::text('norek', null, [
            'class' => in_array('norek', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'No Rekening',
        ]) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-lg-3 col-form-label text-lg-end d-none d-lg-block">Keterangan</label>
    <div class="col-lg-9">
        {!! Form::textarea('text', null, ['class' => 'form-control', 'placeholder' => 'Keterangan', 'rows' => 2]) !!}
    </div>
</div>
