@extends('admin.layout.index')
@section('title')
Edit Work
@endsection
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <p class="fs-3"><a href="{{route('admin#workList')}}">Work List</a>/Edit Work</p>
            <div class="col-lg-10 offset-lg-1">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="card-title">
                            <h1 class="text-center title-2">Edit Work</h1>
                        </div>
                        <hr>
                            <form action='{{route('admin#workUpdate',$work->id)}}' method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-6 offset-lg-3">

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Task ID(d/m/randon Number)</label>
                                        <input type="text" value="{{$work->task_id}}" name="task_id" class=" form-control @error('task_id') is-invalid @enderror" id="">

                                        @error('task_id')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Employee</label>
                                        <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                            <option value="">Choose Employee</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}" @if ($user->id == $work->user_id) selected @endif>{{$user->name}}</option>
                                        @endforeach
                                        </select>
                                        @error('user_id')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Work</label>
                                        <textarea name="work" class="form-control @error('work') is-invalid @enderror" cols="30" rows="5">{{$work->work}}</textarea>
                                        @error('work')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Deadline</label>
                                        <input type="date" value="{{$work->deadline}}" name="deadline" class="form-control @error('deadline') is-invalid @enderror" placeholder="dd-mm-yyyy">
                                        @error('deadline')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="my-3">
                                        <label for="" class=" control-label">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="0" @if ($work->status == 0) selected @endif>Not Done</option>
                                            <option value="1" @if ($work->status == 1) selected @endif>Success</option>
                                            <option value="2" @if ($work->status == 2) selected @endif>Fail</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class=" offset-9 my-3">

                                            <button type="submit" class=" btn btn-dark"><i class="fa-solid fa-paper-plane"></i> Update</button>
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
