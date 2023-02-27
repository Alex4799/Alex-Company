@extends('admin.layout.index')
@section('title')
    {{$data->name}}
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <p class="fs-3"><a href="{{route('admin#productList')}}">Product</a>/View Product</p>
            <div class="col-lg-12">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="card-title">
                            <h1 class="text-center title-2">{{$data->name}}</h1>
                        </div>
                        @if (session('productUpdate'))
                            <div class="alert alert-success alert-dismissible fade show col-6 offset-6" role="alert">
                                {{session('productUpdate')}}
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
                            <div class="col-lg-5 offset-lg-1">
                                <div class="image">
                                    <div id="carouselExample" class="carousel slide">
                                        <div class="carousel-inner">
                                          <div class="carousel-item active">
                                            <img class="rounded w-100" src="{{asset('storage/'.$data->image1)}}" alt="{{Auth::user()->name}}" />
                                          </div>
                                          <div class="carousel-item">
                                            <img class="rounded w-100" src="{{asset('storage/'.$data->image2)}}" alt="{{Auth::user()->name}}" />
                                          </div>
                                          <div class="carousel-item">
                                            <img class="rounded w-100" src="{{asset('storage/'.$data->image3)}}" alt="{{Auth::user()->name}}" />
                                          </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                          <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                          <span class="visually-hidden">Next</span>
                                        </button>
                                      </div>
                                </div>
                            </div>
                            <div class="col-lg-5 offset-lg-1">
                                <div class=" m-3"><h3><i class="fa-solid fa-pizza-slice me-1"></i>{{$data->name}}</h3></div>
                                <div class=" m-3"><h3>({{$data->category_name}})</h3></div>
                                <span class=" m-3"><i class="fa-solid fa-money-bill-wave me-1"></i>{{$data->price}} MMK</span>
                                <span class=" m-3"><i class="fa-solid fa-eye me-1"></i>{{$data->view}}</span>
                                <div class=" m-3">{{$data->description}}</div>

                            </div>
                        </div>
                        <div class="row">
                            <div class=" offset-1 my-3">
                                <a href="{{route('admin#editProduct',$data->id)}}" class=" btn btn-dark"><i class="fa-solid fa-pen-to-square"></i>Edit Product</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
