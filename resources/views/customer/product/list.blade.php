@extends('customer.layout.index')
@section('title')
    Home
@endsection

@section('content')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex flex-column justify-content-center align-items-center" data-aos="fade" data-aos-delay="1500">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <h2>I'm <span>Alex Lucifer</span> a Laravel Web Developer from Yangon</h2>
          <p>Blanditiis praesentium aliquam illum tempore incidunt debitis dolorem magni est deserunt sed qui libero. Qui voluptas amet.</p>
          <a href="{{route('customer#messageSendPage')}}" class="btn-get-started">Available for hire</a>
        </div>
      </div>
    </div>
  </section><!-- End Hero Section -->


<div class="container my-2 p-2">
    <div class=" d-flex justify-content-between px-1">
        <h1 class="text-white">Avilable Product ({{$data->total()}})</h1>

        <div class="">
            <form action="#" method="get">
                <div class=" d-flex">
                    <input type="text" name="search_key" value="{{request('search_key')}}" class="form-control">
                    <input type="submit" value="search" class="btn btn-success">
                </div>
            </form>
        </div>

        <div class="">
            <div class="">
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @foreach ($category as $item)
                        @if (request('category_id')==$item->id)
                            {{$item->name}}
                        @endif
                    @endforeach
                    @if (empty(request('category_id')))
                        All
                    @endif
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{route('customer#home')}}">All</a></li>
                      @foreach ($category as $item)
                      <li><a class="dropdown-item" href="{{route('customer#home',['category_id'=> $item->id])}}">{{$item->name}}</a></li>
                      @endforeach
                    </ul>
            </div>
        </div>
        </div>
    </div>
<hr>
<!-- ======= Product Section ======= -->
<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">
        @if (session('createSucc'))
        <div class="alert alert-success alert-dismissible fade show col-4 offset-8" role="alert">
            {{session('createSucc')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session('sendSucc'))
        <div class="alert alert-success alert-dismissible fade show col-4 offset-8" role="alert">
            {{session('sendSucc')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
      <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">

        @foreach ($data as $item)
            <div class="col-lg-4 col-md-6 portfolio-item filter-app my-2">
                <div class="portfolio-img my-2">
                    @if ($item->image1==null)
                        <img src="{{asset('image/default.jpg')}}" class="img-fluid shadow">
                    @else
                        <img src="{{asset('storage/'.$item->image1)}}" class="img-fluid shadow rounded">
                    @endif
                </div>
                <div class="portfolio-info row">
                  <div class="col-6">
                    <h4>{{$item->name}}</h4>
                    <p>{{$item->price}} MMK</p>
                  </div>
                  <div class="col-6">
                    <a href="{{route('customer#viewProduct',$item->id)}}"class="btn fs-3 text-success" title="More Details"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{route('customer#addCart',$item->id)}}" class="btn fs-3 text-success" title="Add To Cart"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
                </div>
            </div>
        @endforeach
      </div>
      <div class="my-3">
        {{$data->appends(request()->query())->links()}}
    </div>
    </div>
  </section>
  <!-- End Product Section -->

</div>
@endsection
