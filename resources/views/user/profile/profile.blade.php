@extends('user.layout.index')
@section('title')
    Profile
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-lg-1">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="card-title">
                            <h1 class="text-center title-2">Profile</h1>
                        </div>
                        @if (session('profileUpdate'))
                            <div class="alert alert-success alert-dismissible fade show col-6 offset-6" role="alert">
                                {{session('profileUpdate')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('successPass'))
                        <div class="alert alert-success alert-dismissible fade show col-6 offset-6" role="alert">
                            {{session('successPass')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('EnrollmentSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-triangle-exclamation"></i>{{session('EnrollmentSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <hr>
                        <div class="row">
                            <div class="col-lg-3 offset-lg-1">
                                    <div class="image">
                                        <a href="#">
                                            @if (Auth::user()->image==null)
                                            @if (Auth::user()->gender=='male')
                                                <img src="{{asset('image/default-male-image.png')}}" class="w-100 shadow">
                                            @else
                                                <img src="{{asset('image/default-female-image.webp')}}" class="w-100 shadow">
                                            @endif
                                            @else
                                                <img src="{{asset('storage/'.Auth::user()->image)}}" class="w-100 shadow">
                                            @endif
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 offset-lg-1">
                                <div class=" my-3"><h3><i class="fa-solid fa-user px-3"></i>{{Auth::user()->name}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-user px-3"></i>{{Auth::user()->position}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-user px-3"></i>{{Auth::user()->NRC}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-envelope px-3"></i>{{Auth::user()->email}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-phone px-3"></i>{{Auth::user()->phone}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-map-location px-3"></i>{{Auth::user()->address}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-mars-and-venus px-3"></i>{{Auth::user()->gender}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-user-clock px-3"></i>{{Auth::user()->created_at->format('d-m-Y')}}</h3></div>

                            </div>
                        </div>
                        <div class="row">
                            <div class=" offset-1">
                                <a href="{{route('user#editProfile',Auth::user()->id)}}" class=" btn btn-dark"><i class="fa-solid fa-pen-to-square"></i>Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
