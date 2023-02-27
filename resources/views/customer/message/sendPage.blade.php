@extends('customer.layout.index')
@section('title')
Send Message
@endsection
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">

        <h1 class="text-center mb-5 text-muted">Contact Us</h1>

        <div class="row gy-4 justify-content-center">

            <div class="col-lg-3">
              <div class="info-item d-flex">
                <i class="bi bi-geo-alt text-success fs-3 m-1"></i>
                <div>
                  <h4 class="text-muted">Location:</h4>
                  <p>NO.(107), Rose Street, 3/A, Mingalardon, Yangon</p>
                </div>
              </div>
            </div><!-- End Info Item -->

            <div class="col-lg-3">
              <div class="info-item d-flex">
                <i class="bi bi-envelope text-success fs-3 m-1"></i>
                <div>
                  <h4 class="text-muted">Email:</h4>
                  <p>mr.alex4799@gmail.com</p>
                </div>
              </div>
            </div><!-- End Info Item -->

            <div class="col-lg-3">
              <div class="info-item d-flex">
                <i class="bi bi-phone text-success fs-3 m-1"></i>
                <div>
                  <h4 class="text-muted">Call:</h4>
                  <p>+959 980 730 638</p>
                </div>
              </div>
            </div><!-- End Info Item -->

          </div>

        <div class="container-fluid">

            <div class="col">
                <div class="card bg-black">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2 text-muted">Send Message</h3>
                        </div>
                        <hr>
                            <form action='{{route('customer#messageSend')}}' method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-8 offset-2">

                                    <input type="hidden" value="{{Auth::user()->email}}" name="email">
                                    <input type="hidden" name="user_id" value="{{$user->id}}" >

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Title</label>
                                        <input placeholder="Enter Message Title" type="text" name="title" class=" form-control @error('title') is-invalid @enderror" id="">

                                        @error('title')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Message</label>
                                        <textarea placeholder="Enter Message" name="message" class="form-control @error('message') is-invalid @enderror" cols="30" rows="10"></textarea>
                                        @error('message')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class=''>

                                            <button type="submit" class=" btn btn-success"><i class="fa-solid fa-paper-plane"></i>  Send</button>
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
@endsection
