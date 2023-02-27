@extends('customer.layout.index')
@section('title')
    {{$data->name}}
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card bg-black">
                    <div class="card-body">
                        <div class="card-title">


                            <h3 class="text-center title-2 text-white">{{$data->name}}</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-5 offset-1">
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
                            <div class="col-5 offset-1 text-white">
                                <div class=" m-3"><h3><i class="fa-solid fa-pizza-slice me-1"></i>{{$data->name}}</h3></div>
                                <div class=" m-3"><h3>({{$data->category_name}})</h3></div>
                                <span class=" m-3"><i class="fa-solid fa-money-bill-wave me-1"></i>{{$data->price}} MMK</span>
                                <span class=" m-3"><i class="fa-solid fa-eye me-1"></i>{{$data->view}}</span>
                                <div class=" m-3">{{$data->description}}</div>
                                <div class="col-5 offset-7"><a href="{{route('customer#addCart',$data->id)}}" class="btn btn-success text-dark"><i class="fa-solid fa-cart-shopping me-3"></i>Add Cart</a></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
