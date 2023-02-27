@extends('admin.layout.index')
@section('title')
    Edit Category
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <p class="fs-3"><a href="{{route('admin#categoryList')}}">Category</a>/Edit Category</p>
                <div class="col-lg-10 offset-lg-1">
                    <div class="card bg-secondary">
                        <div class="card-body">
                            <div class="card-title">
                                <h1 class="text-center title-2">Edit Category</h1>
                            </div>
                            <hr>
                                <form action="{{route('admin#updateCategory',$data->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="">
                                        <div class="col-lg-6 offset-lg-3 my-3">
                                            <label for="" class=" control-label">Name</label>
                                            <input value="{{$data->name}}" type="text" name="name" class=" form-control @error('name') is-invalid @enderror" id="">

                                            @error('name')
                                            <small class=" text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <button type="submit" class="col-lg-2 offset-lg-7 btn btn-dark"><i class="fa-solid fa-pen-to-square"></i>Update</button>
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
