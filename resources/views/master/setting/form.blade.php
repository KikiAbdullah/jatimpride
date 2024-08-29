<div class="row mb-2">
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Icon</label>
    <div class="col-lg-4 mb-1">
        {!! Form::file('icon', [
            'class' => 'form-control',
            'id' => 'iconUpload',
        ]) !!}
        @if (isset($item) && !empty($item->icon))
            <div class="row mb-2 justify-content-center mt-2">
                <div class="col-lg-4 col-4 mb-1">
                    <div class="d-flex mb-2" style="position: relative;">
                        <a href="#" style="position: absolute;right:0;" onclick="remove_file(this);">
                            <i class="ph-x-circle bg-white rounded-circle" style="color: red"></i>
                        </a>
                        <a href="{{ $item->icon_url }}">
                            <img src="{{ $item->icon_url }}" class="rounded"
                                style="max-height:100px;max-width:100px;object-fit:cover;">
                        </a>
                        <input type="hidden" name="icon_exist" value="1">
                    </div>
                </div>
            </div>
        @endif
    </div>
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Logo</label>
    <div class="col-lg-4">
        {!! Form::file('logo', [
            'class' => 'form-control',
            'id' => 'logoUpload',
        ]) !!}
        @if (isset($item) && !empty($item->logo))
            <div class="row mb-2 justify-content-center mt-2">
                <div class="col-lg-4 col-4 mb-1">
                    <div class="d-flex mb-2" style="position: relative;">
                        <a href="#" style="position: absolute;right:0;" onclick="remove_file(this);">
                            <i class="ph-x-circle bg-white rounded-circle" style="color: red"></i>
                        </a>
                        <a href="{{ $item->logo_url }}">
                            <img src="{{ $item->logo_url }}" class="rounded"
                                style="max-height:100px;max-width:100px;object-fit:cover;">
                        </a>
                        <input type="hidden" name="logo_exist" value="1">
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<hr>
<div class="row mb-3">
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Event Logo</label>
    <div class="col-lg-4">
        {!! Form::file('event_logo', [
            'class' => 'form-control',
            'id' => 'eventLogoUpload',
        ]) !!}
        @if (isset($item) && !empty($item->event_logo))
            <div class="row mb-2 justify-content-center mt-2">
                <div class="col-lg-4 col-4 mb-1">
                    <div class="d-flex mb-2" style="position: relative;">
                        <a href="#" style="position: absolute;right:0;" onclick="remove_file(this);">
                            <i class="ph-x-circle bg-white rounded-circle" style="color: red"></i>
                        </a>
                        <a href="{{ $item->event_logo_url }}">
                            <img src="{{ $item->event_logo_url }}" class="rounded"
                                style="max-height:100px;max-width:100px;object-fit:cover;">
                        </a>
                        <input type="hidden" name="event_logo_exist" value="1">
                    </div>
                </div>
            </div>
        @endif
    </div>
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Event Date</label>
    <div class="col-lg-4">
        {!! Form::text('event_date', formatDate('Y-m-d H:i:s', 'd-m-Y H:i:s', $item->event_date), [
            'class' => in_array('event_date', $errors->keys())
                ? 'form-control daterange-single-time is-invalid'
                : 'form-control daterange-single-time',
            'placeholder' => 'Event Date',
        ]) !!}
    </div>
</div>

<div class="row mb-3">
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Event Google Maps Link</label>
    <div class="col-lg-10">
        {!! Form::text('event_gmaps', null, [
            'class' => in_array('event_gmaps', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'Event Google Maps Link',
        ]) !!}
    </div>
</div>
<hr>
<div class="row mb-3">
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">About Name</label>
    <div class="col-lg-4">
        {!! Form::text('about_name', null, [
            'class' => in_array('about_name', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'About Name',
        ]) !!}
    </div>
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">About Jabatan</label>
    <div class="col-lg-4">
        {!! Form::text('about_jabatan', null, [
            'class' => in_array('about_jabatan', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'About Jabatan',
        ]) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">About Photo</label>
    <div class="col-lg-4">
        {!! Form::file('about_foto', [
            'class' => 'form-control',
            'id' => 'aboutPhotoUpload',
        ]) !!}
        @if (isset($item) && !empty($item->about_foto))
            <div class="row mb-2 justify-content-center mt-2">
                <div class="col-lg-4 col-4 mb-1">
                    <div class="d-flex mb-2" style="position: relative;">
                        <a href="#" style="position: absolute;right:0;" onclick="remove_file(this);">
                            <i class="ph-x-circle bg-white rounded-circle" style="color: red"></i>
                        </a>
                        <a href="{{ $item->about_foto_url }}">
                            <img src="{{ $item->about_foto_url }}" class="rounded"
                                style="max-height:100px;max-width:100px;object-fit:cover;">
                        </a>
                        <input type="hidden" name="about_foto_exist" value="1">
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>


<div class="row mb-3">
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">About Text</label>
    <div class="col-lg-10">
        <div class="quill-basic">
            {!! $item->about_text ?? '' !!}
        </div>
        {!! Form::hidden('about_text', null, ['id' => 'about-text']) !!}
    </div>
</div>
<br><br>
<hr>


<div class="row mb-3">
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Merch Foto</label>
    <div class="col-lg-4">
        {!! Form::file('merch_foto_1', [
            'class' => 'form-control',
            'id' => 'merchFoto1Upload',
        ]) !!}
        @if (isset($item) && !empty($item->merch_foto_1))
            <div class="row mb-2 justify-content-center mt-2">
                <div class="col-lg-4 col-4 mb-1">
                    <div class="d-flex mb-2" style="position: relative;">
                        <a href="#" style="position: absolute;right:0;" onclick="remove_file(this);">
                            <i class="ph-x-circle bg-white rounded-circle" style="color: red"></i>
                        </a>
                        <a href="{{ $item->merch_foto_1_url }}">
                            <img src="{{ $item->merch_foto_1_url }}" class="rounded"
                                style="max-height:100px;max-width:100px;object-fit:cover;">
                        </a>
                        <input type="hidden" name="merch_foto_1_exist" value="1">
                    </div>
                </div>
            </div>
        @endif
    </div>
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Merch Foto</label>
    <div class="col-lg-4">
        {!! Form::file('merch_foto_2', [
            'class' => 'form-control',
            'id' => 'merchFoto2Upload',
        ]) !!}
        @if (isset($item) && !empty($item->merch_foto_2))
            <div class="row mb-2 justify-content-center mt-2">
                <div class="col-lg-4 col-4 mb-1">
                    <div class="d-flex mb-2" style="position: relative;">
                        <a href="#" style="position: absolute;right:0;" onclick="remove_file(this);">
                            <i class="ph-x-circle bg-white rounded-circle" style="color: red"></i>
                        </a>
                        <a href="{{ $item->merch_foto_2_url }}">
                            <img src="{{ $item->merch_foto_2_url }}" class="rounded"
                                style="max-height:100px;max-width:100px;object-fit:cover;">
                        </a>
                        <input type="hidden" name="merch_foto_2_exist" value="1">
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>


<div class="row mb-3">
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Merch Text</label>
    <div class="col-lg-10">
        {!! Form::textarea('merch_text', null, ['class' => 'form-control', 'rows' => 2]) !!}
    </div>
</div>

<br><br>
<hr>

<div class="row mb-3">
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Contact Name</label>
    <div class="col-lg-4">
        {!! Form::text('contact_name', null, [
            'class' => in_array('contact_name', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'Contact Name',
        ]) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Alamat</label>
    <div class="col-lg-4">
        {!! Form::textarea('contact_alamat', null, [
            'class' => in_array('contact_alamat', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'Alamat',
            'rows' => 2,
        ]) !!}
    </div>
</div>

<div class="row mb-3">
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">WhatsApp</label>
    <div class="col-lg-4">
        {!! Form::text('contact_whatsapp', null, [
            'class' => in_array('contact_whatsapp', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'WhatsApp',
        ]) !!}
    </div>
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Email</label>
    <div class="col-lg-4">
        {!! Form::email('contact_email', null, [
            'class' => in_array('contact_email', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'Email',
        ]) !!}
    </div>
</div>

<div class="row mb-3">
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">Instagram</label>
    <div class="col-lg-4">
        {!! Form::text('contact_instagram', null, [
            'class' => in_array('contact_instagram', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'Instagram',
        ]) !!}
    </div>
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">TikTok</label>
    <div class="col-lg-4">
        {!! Form::text('contact_tiktok', null, [
            'class' => in_array('contact_tiktok', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'TikTok',
        ]) !!}
    </div>
</div>

<div class="row mb-3">
    <label class="col-lg-2 col-form-label text-lg-end d-none d-lg-block">YouTube</label>
    <div class="col-lg-4">
        {!! Form::text('contact_youtube', null, [
            'class' => in_array('contact_youtube', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => 'YouTube',
        ]) !!}
    </div>
</div>
