@extends('admin.layout.index')
@section('title')
 View Work
@endsection
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <p class="fs-3"><a href="{{route('admin#workList')}}">Work List</a>/View Work</p>
            <div class="col-lg-10 offset-lg-1">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="card-title">
                            <h1 class="text-center title-2">View Work</h1>
                        </div>
                        <hr>

                        @if (session('updateSucc'))
                            <div class="alert alert-success alert-dismissible fade show col-6 offset-6" role="alert">
                                {{session('updateSucc')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif


                            <form action='#' method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-6 offset-lg-3">

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Task ID(d/m/randon Number)</label>
                                        <input type="text" value="{{$work->task_id}}" disabled name="task_id" class=" form-control">
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Employee</label>
                                        <input type="text" value="{{$work->user_name}}" disabled name="" class=" form-control">
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Work</label>
                                        <textarea disabled name="work" class="form-control "cols="30" rows="5">{{$work->work}}</textarea>
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Deadline</label>
                                        <input type="date" value="{{$work->deadline}}" disabled name="deadline" class="form-control" placeholder="dd-mm-yyyy">
                                    </div>

                                    <div class="my-3">
                                        <label for="" class=" control-label">Status</label>
                                        <select class="form-control" disabled name="status">
                                            <option value="0" @if ($work->status == 0) selected @endif>Not Done</option>
                                            <option value="1" @if ($work->status == 1) selected @endif>Success</option>
                                            <option value="2" @if ($work->status == 2) selected @endif>Fail</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class=" offset-9 my-3">

                                            <a href="{{route('admin#workEditPage',$id)}}" class=" btn btn-dark"><i class="fa-solid fa-paper-plane"></i> Edit</a>
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
