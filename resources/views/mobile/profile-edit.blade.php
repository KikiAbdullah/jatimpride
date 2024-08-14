@extends('layouts.mobile')

@section('content')
    <div class="container">
        {!! Form::model($item, ['route' => ['mobile.profile-update', $item->id], 'method' => 'POST']) !!}
        <!-- Checkout Wrapper-->
        <div class="checkout-wrapper-area py-3">
            <!-- Billing Address-->
            <div class="billing-information-card mb-3">
                <div class="card billing-information-title-card bg-warning">
                    <div class="card-body text-center">
                        <img src="{{ asset('app_local/img/logo.png') }}" class="img-fluid" style="max-height: 100px;"
                            alt="">
                        <h6 class="text-center mb-0">Edit Profile</h6>
                    </div>
                </div>
                <div class="card user-data-card">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="title mb-2"><i class="lni lni-user"></i><span>Username</span>
                            </div>
                            @if (empty($item))
                                {!! Form::text('username', null, [
                                    'class' => in_array('username', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
                                    'placeholder' => 'Username',
                                ]) !!}
                            @else
                                {!! Form::text('username', null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Username',
                                    'disabled' => 'disabled',
                                ]) !!}
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="title mb-2"><i class="lni lni-user"></i><span>Nama
                                    Lengkap</span>
                            </div>
                            {!! Form::text('name', null, [
                                'class' => in_array('name', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
                                'placeholder' => 'Name',
                            ]) !!}
                        </div>
                        <div class="mb-3">
                            <div class="title mb-2"><i class="lni lni-envelope"></i><span>Email</span>
                            </div>
                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                        </div>
                        <div class="mb-3">
                            <div class="title mb-2"><i class="lni lni-phone"></i><span>Whatsapp</span>
                            </div>
                            {!! Form::text('nowa', null, ['class' => 'form-control', 'placeholder' => 'WhatsApp Number']) !!}
                        </div>

                        <div class="mb-3">
                            <div class="title mb-2"><i class="lni lni-pencil"></i><span>Password</span></div>
                            {!! Form::password('password', [
                                'class' => in_array('password', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
                                'placeholder' => 'Password',
                            ]) !!}
                        </div>
                    </div>
                    <!-- Cart Amount Area-->
                    <div class="card cart-amount-area">
                        <div class="card-body mb-2 justify-content-between">
                            <a href="{{ route('mobile.profile') }}" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection


@section('customjs')
@endsection
