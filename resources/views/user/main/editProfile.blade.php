@extends('user.layout.index')
@section('title')
    Profile
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <p class="fs-3"><a href="{{route('user#profile')}}">Profile</a>/Edit Profile</p>
            <div class="col-lg-10 offset-lg-1">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="card-title">
                            <h1 class="text-center title-2">Edit Profile</h1>
                        </div>
                        <hr>
                            <form action="{{route('profile#Update',$data->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 offset-lg-1">
                                        <div class="image mb-3">
                                            @if ($data->image==null)
                                            @if ($data->gender=='male')
                                                <img src="{{asset('image/default-male-image.png')}}" class="w-100 shadow">
                                            @else
                                                <img src="{{asset('image/default-female-image.webp')}}" class="w-100 shadow">
                                            @endif
                                            @else
                                                <img src="{{asset('storage/'.$data->image)}}" class="w-100 shadow">
                                            @endif
                                    </div>
                                    <input type="file" name="image" id="image" class=" form-control">

                                    <div class="row">
                                        <div class=" offset-1 my-3">

                                            <button type="submit" class=" btn btn-dark"><i class="fa-solid fa-pen-to-square"></i>Update Profile</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 offset-lg-1">

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Name</label>
                                        <input value="{{$data->name}}" type="text" name="name" class=" form-control @error('name') is-invalid @enderror" id="">

                                        @error('name')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Position</label>
                                        <input value="{{$data->position}}" type="text" name="position" class=" form-control @error('position') is-invalid @enderror" id="">
                                        @error('position')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Email</label>
                                        <input value="{{$data->email}}" type="email" name="email" class=" form-control @error('email') is-invalid @enderror" id="">
                                        @error('email')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Phone</label>
                                        <input value="{{$data->phone}}" type="number" name="phone" class=" form-control @error('phone') is-invalid @enderror" id="">
                                        @error('phone')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">NRC</label>
                                        <input value="{{$data->NRC}}" type="text" name="NRC" class=" form-control @error('NRC') is-invalid @enderror" id="">
                                        @error('NRC')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Address</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="1">{{$data->address}}</textarea>
                                        @error('address')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Gender</label>
                                        <select name="gender" id="" class=" form-control @error('gender') is-invalid @enderror">
                                            <option value="">Choose Gender</option>
                                            <option value="male" @if ($data->gender=='male') selected @endif>Male</option>
                                            <option value="female" @if ($data->gender=='female') selected @endif>Female</option>
                                        </select>
                                        @error('gender')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                        <input value="{{$data->role}}" type="hidden" name="role" class=" form-control @error('role') is-invalid @enderror" id="">


                                </div>
                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
