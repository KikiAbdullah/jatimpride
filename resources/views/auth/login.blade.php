@extends('front.layout')

@section('content')
    <!-- Contact Section -->
    <section id="contact" class="contact section mt-5">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>LOGIN</h2>
            <p>LOGIN</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4 justify-content-center">

                <div class="col-lg-8">
                    {!! Form::open([
                        'route' => 'login',
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
                        <div class="col-md-12">
                            {!! Form::text('username', null, [
                                'class' => 'form-control',
                                'placeholder' => 'Username',
                                'autofocus' => true,
                                'onfocus' => 'this.selectionStart = this.selectionEnd = this.value.length;',
                            ]) !!}
                        </div>

                        <div class="col-md-12 position-relative">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="•••••••••••">
                            <button type="button" id="togglePassword"
                                class="btn btn-outline-secondary position-absolute top-50 end-0 translate-middle-y">
                                <i class="bi bi-eye-fill"></i>
                            </button>
                        </div>


                        <div class="d-flex align-items-center mb-3">
                            <label class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" checked>
                                <span class="form-check-label">Ingatkan</span>
                            </label>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary w-100">Log In</button>
                        </div>

                        <div class="col-md-12 text-center">
                            <p>Belum memiliki akun? <a href="{{ route('front.register') }}">Daftar Akun</a></p>
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
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle the button text
            $(this).html(type === 'password' ? '<i class="bi bi-eye-fill"></i>' :
                '<i class="bi bi-eye-slash-fill"></i>');
        });
    </script>
@endsection
