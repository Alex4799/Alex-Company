@extends('customer.layout.index')

@section('title')
    Message detail
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->

                    <div class="col-10 offset-1 card bg-black">
                        {{-- <div class="card-title">
                            <div class=" text-decoration-none text-dark" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i></div>
                        </div> --}}
                        <div class=" text-center card-body">
                            <h2>{{$data->title}}</h2>
                        </div>
                        <div class=" card-body">
                            <div class="row mb-3">
                                <div class="col-2">From</div>
                                <div class="col">{{$data->email}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2">To</div>
                                <div class="col">{{$data->user_email}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2">Message</div>
                                <div class="col-10 text-justify">{{$data->message}}</div>
                            </div>
                            <div class="row">
                                @if ($data->status==0)
                                <div class="col-3 offset-9">Delivered</div>
                                @else
                                <div class="col-3 offset-9 text-success">Seen</div>
                                @endif
                            </div>

                        </div>
                    </div>


                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
