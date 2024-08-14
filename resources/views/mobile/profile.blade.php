@extends('layouts.mobile')

@section('content')
    <div class="container">
        <!-- Profile Wrapper-->
        <div class="profile-wrapper-area py-3">
            <!-- User Information-->
            <div class="card user-info-card">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="user-profile me-3"><img src="{{ asset('mobile-asset/img/bg-img/9.jpg') }}" alt="">
                    </div>
                    <div class="user-info">
                        <p class="mb-0 text-white">{{ $item->username }}</p>
                        <h5 class="mb-0">{{ $item->name }}</h5>
                    </div>
                </div>
            </div>
            <!-- User Meta Data-->
            <div class="card user-data-card">
                <div class="card-body">
                    <div class="single-profile-data d-flex align-items-center justify-content-between">
                        <div class="title d-flex align-items-center"><i class="lni lni-user"></i><span>Username</span></div>
                        <div class="data-content">{{ $item->username }}</div>
                    </div>
                    <div class="single-profile-data d-flex align-items-center justify-content-between">
                        <div class="title d-flex align-items-center"><i class="lni lni-user"></i><span>Full Name</span>
                        </div>
                        <div class="data-content">{{ $item->name }}</div>
                    </div>
                    <div class="single-profile-data d-flex align-items-center justify-content-between">
                        <div class="title d-flex align-items-center"><i class="lni lni-phone"></i><span>Whatsapp</span>
                        </div>
                        <div class="data-content">{{ $item->nowa }}</div>
                    </div>
                    <div class="single-profile-data d-flex align-items-center justify-content-between">
                        <div class="title d-flex align-items-center"><i class="lni lni-envelope"></i><span>Email
                                Address</span></div>
                        <div class="data-content">{{ $item->email }} </div>
                    </div>
                    <!-- Edit Profile-->
                    <div class="edit-profile-btn mt-3"><a class="btn btn-primary w-100" href="{{ route('mobile.profile-edit') }}"><i
                                class="lni lni-pencil me-2"></i>Edit Profile</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('customjs')
@endsection
