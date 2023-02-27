@extends('admin.layout.index')
@section('title')
    Profile
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <p class="fs-3"><a href="{{route('admin#adminList')}}">Admin List</a>/View Profile</p>
            <div class="col-lg-10 offset-lg-1">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Profile</h3>
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
                        <hr>
                        <div class="row">
                            <div class="col-3 offset-1">
                                    <div class="image">
                                        <a href="#">
                                            @if ($data->image==null)
                                            @if ($data->gender=='male')
                                                <img src="{{asset('image/default-male-image.png')}}" class="w-100 shadow">
                                            @else
                                                <img src="{{asset('image/default-female-image.webp')}}" class="w-100 shadow">
                                            @endif
                                            @else
                                                <img src="{{asset('storage/'.$data->image)}}" class="w-100 shadow">
                                            @endif
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 offset-1">
                                <div class=" my-3"><h3><i class="fa-solid fa-user px-3"></i>{{$data->name}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-user px-3"></i>{{$data->position}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-user px-3"></i>{{$data->NRC}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-envelope px-3"></i>{{$data->email}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-phone px-3"></i>{{$data->phone}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-map-location px-3"></i>{{$data->address}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-mars-and-venus px-3"></i>{{$data->gender}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-user-clock px-3"></i>{{$data->created_at->format('d-m-Y')}}</h3></div>

                            </div>
                        </div>
                        <div class="row">
                            <div class=" offset-1">
                                <a href="{{route('admin#editAdmin',$data->id)}}" class=" btn btn-dark"><i class="fa-solid fa-pen-to-square"></i>Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
