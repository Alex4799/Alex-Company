@extends('admin.layout.index')
@section('title')
    Add User
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <p class="fs-3"><a href="{{route('admin#userList')}}">User List</a>/Add User</p>
                <div class="col-lg-10 offset-lg-1">
                    <div class="card bg-secondary">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Add User</h3>
                            </div>
                            <hr>
                                <form action="{{route('admin#addUser')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4 offset-lg-1">
                                            <div class="image mb-3">
                                                <img src="{{asset('image/default-male-image.png')}}" class="w-100 shadow">
                                            </div>
                                        <input type="file" name="image" id="image" class=" form-control">

                                        <div class="row">
                                            <div class=" offset-1 my-3">

                                                <button type="submit" class=" btn btn-dark"><i class="fa-solid fa-pen-to-square"></i>Create Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 offset-lg-1">

                                        <div class=" my-3">
                                            <label for="" class=" control-label">Name</label>
                                            <input value="" type="text" name="name" class=" form-control @error('name') is-invalid @enderror" id="">

                                            @error('name')
                                            <small class=" text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class=" my-3">
                                            <label for="" class=" control-label">Position</label>
                                            <input value="" type="text" name="position" class=" form-control @error('position') is-invalid @enderror" id="">

                                            @error('position')
                                            <small class=" text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class=" my-3">
                                            <label for="" class=" control-label">NRC</label>
                                            <input value="" type="text" name="NRC" class=" form-control @error('NRC') is-invalid @enderror" id="">

                                            @error('NRC')
                                            <small class=" text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class=" my-3">
                                            <label for="" class=" control-label">Email</label>
                                            <input value="" type="email" name="email" class=" form-control @error('email') is-invalid @enderror" id="">
                                            @error('email')
                                            <small class=" text-danger">{{$message}}</small>
                                            @enderror
                                        </div>


                                        <div class=" my-3">
                                            <label for="" class=" control-label">Password</label>
                                            <input value="" type="password" name="password" class=" form-control @error('password') is-invalid @enderror" id="">
                                            @error('password')
                                            <small class=" text-danger">{{$message}}</small>
                                            @enderror
                                        </div>


                                        <div class=" my-3">
                                            <label for="" class=" control-label">Phone</label>
                                            <input value="" type="number" name="phone" class=" form-control @error('phone') is-invalid @enderror" id="">
                                            @error('phone')
                                            <small class=" text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class=" my-3">
                                            <label for="" class=" control-label">Address</label>
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="1"></textarea>
                                            @error('address')
                                            <small class=" text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class=" my-3">
                                            <label for="" class=" control-label">Gender</label>
                                            <select name="gender" id="" class=" form-control @error('gender') is-invalid @enderror">
                                                <option value="">Choose Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                            @error('gender')
                                            <small class=" text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <td class="col-2">
                                            <label for="" class=" control-label">Role</label>
                                            <select id="role" class="changeRole form-control" name="role">
                                                <option value="user">User</option>
                                            </select>
                                           </td>


                                    </div>
                                    </div>
                                </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
