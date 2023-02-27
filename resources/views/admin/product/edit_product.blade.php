@extends('admin.layout.index')
@section('title')
    Edit Product
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <p class="fs-3"><a href="{{route('admin#productList')}}">Product</a>/Edit Product</p>
                <div class="col-lg-10 offset-lg-1">
                    <div class="card bg-secondary">
                        <div class="card-body">
                            <div class="card-title">
                                <h1 class="text-center title-2">Edit Product</h1>
                            </div>
                            <hr>
                                <form action="{{route('admin#productUpdate',$product->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4 offset-lg-1">
                                            <div class="my-2">
                                                <div class="image">
                                                @if ($product->image1==null)
                                                    <img src="{{asset('image/default.jpg')}}" class="w-100 shadow">
                                                @else
                                                    <img src="{{asset('storage/'.$product->image1)}}" class="w-100 shadow">
                                                @endif
                                                </div>
                                                <input type="file" name="image1" id="image1" class="@error('image1') is-invalid @enderror form-control">
                                                @error('image1')
                                                <small class=" text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="my-2">
                                                <div class="image">
                                                @if ($product->image2==null)
                                                    <img src="{{asset('image/default.jpg')}}" class="w-100 shadow">
                                                @else
                                                    <img src="{{asset('storage/'.$product->image2)}}" class="w-100 shadow">
                                                @endif
                                                </div>
                                                <input type="file" name="image2" id="image2" class="@error('image2') is-invalid @enderror form-control">
                                                @error('image2')
                                                <small class=" text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="my-2">
                                                <div class="image">
                                                @if ($product->image3==null)
                                                    <img src="{{asset('image/default.jpg')}}" class="w-100 shadow">
                                                @else
                                                    <img src="{{asset('storage/'.$product->image3)}}" class="w-100 shadow">
                                                @endif
                                                </div>
                                                <input type="file" name="image3" id="image3" class="@error('image3') is-invalid @enderror form-control">
                                                @error('image3')
                                                <small class=" text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                        </div>
                                    <div class="col-lg-6 offset-lg-1">

                                        <div class=" my-3">
                                            <label for="" class=" control-label">Name</label>
                                            <input value="{{$product->name}}" placeholder="Enter Product Name" type="text" name="name" class=" form-control @error('name') is-invalid @enderror" id="">

                                            @error('name')
                                            <small class=" text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class=" my-3">
                                            <label for="" class=" control-label">Category</label>
                                            <select name="category" id="" class=" form-control @error('category') is-invalid @enderror">
                                                <option value="">Choose Category</option>
                                                @foreach ($category as $item)
                                                <option @if ($item->id==$product->category_id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                            <small class=" text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class=" my-3">
                                            <label for="" class=" control-label">Description</label>
                                            <textarea placeholder="Enter Product Description" name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{$product->description}}</textarea>
                                            @error('description')
                                            <small class=" text-danger">{{$message}}</small>
                                            @enderror
                                        </div>


                                        <div class=" my-3">
                                            <label for="" class=" control-label">Price (MMK)</label>
                                            <input placeholder="Enter Product Price" value="{{$product->price}}" type="number" name="price" class=" form-control @error('price') is-invalid @enderror" id="">
                                            @error('price')
                                            <small class=" text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class=" offset-7">
                                                <button type="submit" class=" btn btn-dark"><i class="fa-solid fa-pen-to-square"></i>Update Product</button>
                                            </div>
                                        </div>

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
