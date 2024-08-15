<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="{{ env('APP_NAME') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#100DD1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags -->
    <!-- Title -->
    <title>{{ $title ?? (env('APP_NAME') ?? '') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('app_local/img/favicon.png') }}">
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="{{ asset('app_local/img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('app_local/img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('app_local/img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('app_local/img/favicon.png') }}">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('mobile-asset/css/bootstrap.min.css') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('mobile-asset/style.css') }}">
    <!-- Web App Manifest -->
    <link rel="manifest" href="{{ asset('mobile-asset/manifest.json') }}">
</head>

<body>
    <!-- Login Wrapper Area-->
    <div class="login-wrapper d-flex align-items-center justify-content-center text-center">
        <!-- Background Shape-->
        <div class="background-shape"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 col-lg-8">
                    <img src="{{ asset('app_local/img/logo.png') }}" class="img-fluid big-logo"
                        alt="">
                    <!-- Register Form-->
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {!! $error . '<br/>' !!}
                            @endforeach
                        </div>
                    @endif
                    <div class="register-form mt-5">
                        {!! Form::open(['route' => 'login', 'class' => 'login-form']) !!}
                        <div class="form-group text-start mb-4"><span>Username</span>
                            <label for="username"><i class="fa-solid fa-user"></i></label>
                            {!! Form::text('username', null, [
                                'class' => 'form-control',
                                'placeholder' => 'Username',
                                'autofocus' => true,
                                'onfocus' => 'this.selectionStart = this.selectionEnd = this.value.length;',
                            ]) !!}
                        </div>
                        <div class="form-group text-start mb-4"><span>Password</span>
                            <label for="password"><i class="fa-solid fa-key"></i></label>
                            <input type="password" name="password" class="form-control" placeholder="•••••••••••">
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <label class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" checked>
                                <span class="form-check-label">Remember</span>
                            </label>
                        </div>
                        <button class="btn btn-warning btn-lg w-100" type="submit">Log In</button>
                        {!! Form::close() !!}
                    </div>
                    <!-- Login Meta-->
                    <div class="login-meta-data">
                        <p class="mb-0">Didn't have an account?<a class="mx-1"
                                href="{{ route('mobile.register') }}">Register Now</a>
                        </p>
                    </div>
                    <!-- View As Guest-->
                    <div class="view-as-guest mt-3"><a class="btn" href="{{ url('/') }}">View as Guest</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- All JavaScript Files-->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
</body>

</html>
