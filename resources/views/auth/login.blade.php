@extends('front.layout')

@section('content')
    <!-- Contact Section -->
    <section id="contact" class="contact section mt-5">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>LOG IN</h2>
            <p>LOG IN</p>
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

                        <div class="col-md-12">
                            <input type="password" name="password" class="form-control" placeholder="•••••••••••">
                        </div>


                        <div class="d-flex align-items-center mb-3">
                            <label class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" checked>
                                <span class="form-check-label">Remember</span>
                            </label>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary w-100">Sign in</button>
                        </div>

                        <div class="col-md-12 text-center">
                            <p>Don't have an account? <a href="{{ route('front.register') }}">Register</a></p>
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div><!-- End Contact Form -->

            </div>

        </div>

    </section><!-- /Contact Section -->
@endsection


@section('customjs')
@endsection
