@extends('front.layout')

@section('content')
    <!-- Contact Section -->
    <section id="contact" class="contact section mt-5">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Daftar Akun</h2>
            <p>Daftar Akun</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4 justify-content-center">

                <div class="col-lg-8">
                    {!! Form::open([
                        'route' => 'front.register-store',
                        'method' => 'POST',
                        'class' => 'form-login',
                        'data-aos' => 'fade-up',
                        'data-aos-delay' => '200',
                        'id' => 'l-modal-form',
                    ]) !!}
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {!! $error . '<br/>' !!}
                            @endforeach
                        </div>
                    @endif
                    <div class="row gy-4">
                        <div class="col-md-6">
                            {!! Form::text('username', null, [
                                'class' => in_array('username', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
                                'placeholder' => 'Username',
                            ]) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Form::text('name', null, [
                                'class' => in_array('name', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
                                'placeholder' => 'Nama',
                            ]) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Form::text('nowa', null, ['class' => 'form-control', 'placeholder' => 'No Whatsapp']) !!}
                        </div>

                        <div class="col-md-12">
                            {!! Form::password('password', [
                                'class' => in_array('password', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
                                'placeholder' => 'Password',
                            ]) !!}
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Daftar Akun</button>
                        </div>

                        <div class="col-md-12 text-center">
                            <p>Sudah memiliki akun? <a href="{{ route('login') }}">Log In</a></p>
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div><!-- End Contact Form -->

            </div>

        </div>

    </section><!-- /Contact Section -->
@endsection


@section('customjs')
    <script>
        $(document).ready(function() {
            $('body').on("submit", '#l-modal-form', function(e) {
                e.preventDefault();

                let urlForm = $(this).attr('action');
                let dataForm = $(this).serialize();

                $.ajax({
                        type: 'POST',
                        url: urlForm,
                        data: dataForm,
                        dataType: "json",
                        success: (response) => {

                            if (response.status == true) {
                                Swal.fire({
                                    toast: true,
                                    title: 'Berhasil',
                                    text: response.msg,
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    willClose: () => {
                                        window.location.href = '{{ route('login') }}';
                                    }
                                })
                            } else {
                                Swal.fire({
                                    toast: true,
                                    title: 'Gagal',
                                    text: response.msg,
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });
                            }
                        },
                    })
                    .done(function(data) {
                        return data;
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {

                        if (jqXHR.status == 422) {
                            var xhr = JSON.stringify(JSON.parse(jqXHR.responseText).errors);
                        } else {
                            var xhr = JSON.stringify(JSON.parse(jqXHR.responseText));

                        }

                        Swal.fire({
                            toast: true,
                            title: 'Request Error',
                            text: xhr.substring(0, 160),
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        })

                        $("#l-modal-form").find('button[type="submit"]').prop('disabled', false);
                    });
            });
        });
    </script>
@endsection
