@extends('user.layout.index')
@section('title')
    Profile
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <p class="fs-3"><a href="{{route('user#customerList')}}">Customer List</a>/View Profile</p>
            <div class="col-lg-10 offset-lg-1">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Profile</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-3 offset-lg-1">
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
                            <div class="col-lg-6 offset-lg-1">
                                <div class=" my-3"><h3><i class="fa-solid fa-user px-3"></i>{{$data->name}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-envelope px-3"></i>{{$data->email}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-phone px-3"></i>{{$data->phone}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-map-location px-3"></i>{{$data->address}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-mars-and-venus px-3"></i>{{$data->gender}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-user-clock px-3"></i>{{$data->created_at->format('d-m-Y')}}</h3></div>
                                <div class=" my-3"><h3><a class="text-dark text-decoration-none" href="{{route('user#orderHistory',['search_key'=> $data->name])}}"><i class="fa-solid fa-chart-bar px-3"></i>{{$orderCount}}</a></h3></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
