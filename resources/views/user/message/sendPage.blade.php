@extends('user.layout.index')
@section('title')
Send Message
@endsection
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <p class="fs-3"><a href="{{route('user#messageList')}}">Message</a>/Send Message</p>
            <div class="col-lg-10 offset-lg-1">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="card-title">
                            <h1 class="text-center title-2">Send Message</h1>
                        </div>
                        <hr>
                            <form action='{{route('user#messageSend')}}' method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-8 offset-lg-2">

                                    <input type="hidden" value="{{Auth::user()->email}}" name="email">

                                    <div class=" my-3">
                                        <label for="" class=" control-label">To</label>
                                        <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                            <option value="">Choose Person</option>
                                        @foreach ($users as $user)
                                            @if ($user->id !=Auth::user()->id)
                                                <option @if (request('reply_message')) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                        @error('user_id')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

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
                                        <div class=" offset-9 my-3">

                                            <button type="submit" class=" btn btn-dark"><i class="fa-solid fa-paper-plane"></i>  Send</button>
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
