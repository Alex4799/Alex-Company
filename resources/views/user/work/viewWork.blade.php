@extends('user.layout.index')
@section('title')
 View Work
@endsection
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <p class="fs-3"><a href="{{route('user#workList')}}">Work</a>/View Work</p>
            <div class="col-lg-10 offset-1">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">View Work</h3>
                        </div>
                        <hr>

                            <form action='#' method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-6 offset-lg-3">

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Task ID(d/m/randon Number)</label>
                                        <input type="text" value="{{$work->task_id}}" disabled name="task_id" class=" form-control">
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Work</label>
                                        <textarea disabled name="work" class="form-control "cols="30" rows="7">{{$work->work}}</textarea>
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

                                    @if ($work->status == 0)
                                    <div class="row">
                                        <div class=" offset-9 my-3">
                                            <a href="{{route('user#doneWork',$id)}}" class=" btn btn-dark"><i class="fa-solid fa-paper-plane"></i> Done</a>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
