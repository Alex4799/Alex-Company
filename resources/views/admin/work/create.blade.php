@extends('admin.layout.index')
@section('title')
Send Work
@endsection
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <p class="fs-3"><a href="{{route('admin#workList')}}">Work List</a>/Create Work</p>
            <div class="col-lg-10 offset-lg-1">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="card-title">
                            <h1 class="text-center title-2">Send Work</h1>
                        </div>
                        <hr>
                            <form action='{{route('admin#createWork')}}' method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-6 offset-lg-3">

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Employee</label>
                                        <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                            <option value="">Choose Employee</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                        </select>
                                        @error('user_id')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Work</label>
                                        <textarea name="work" class="form-control @error('work') is-invalid @enderror" cols="30" rows="5"></textarea>
                                        @error('work')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Deadline</label>
                                        <input type="date" name="deadline" class="form-control @error('deadline') is-invalid @enderror" placeholder="dd-mm-yyyy">
                                        @error('deadline')
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
