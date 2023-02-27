@extends('user.layout.index')
@section('title')
    Work
@endsection
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h1 class="title-1">Work List</h1>

                        </div>
                    </div>

                </div>
                <div class="my-3">
                    <form action="{{route('user#workList')}}" method="get">
                       <div class=" d-flex justify-content-between">
                        <div class="">
                            <h1>Search Key :: {{request('search_key')}}</h1>
                        </div>
                        <div>
                            <h1>Total - {{$data->total()}}</h1>
                        </div>
                        <div class=" col-4 d-flex py-2">
                            <input type="text" name="search_key" value="{{request('search_key')}}" class="form-control">
                            <input type="submit" value="search" class="btn btn-dark">
                        </div>
                       </div>
                    </form>
                </div>
                @if (session('createSucc'))
                    <div class="alert alert-success alert-dismissible fade show col-4 offset-8" role="alert">
                        {{session('createSucc')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('deleteSucc'))
                    <div class="alert alert-danger alert-dismissible fade show col-4 offset-8" role="alert">
                        {{session('deleteSucc')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('updateSucc'))
                    <div class="alert alert-warning alert-dismissible fade show col-4 offset-8" role="alert">
                        {{session('updateSucc')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col table-responsive mb-5">
                        <table class="table table-dark table-borderless table-hover text-center mb-0">
                            <thead class="thead-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Task Id</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="align-middle" id="tableData">

                                @foreach ($data as $item)
                                <tr class="tr-shadow ">
                                    <td class="text-white">{{$item->id}}</td>
                                    <td class=" @if ($item->status == 0) text-warning @elseif($item->status == 1) text-success @else text-danger @endif">{{$item->task_id}}</td>
                                    <td class="text-white">{{$item->deadline}}</td>
                                    <td>
                                         <select class="form-control" disabled>
                                             <option value="0" @if ($item->status == 0) selected @endif>Not Done</option>
                                             <option value="1" @if ($item->status == 1) selected @endif>Success</option>
                                             <option value="2" @if ($item->status == 2) selected @endif>Fail</option>
                                         </select>
                                    </td>
                                    <td>
                                     <div class="table-data-feature">

                                         <a href="{{route('user#viewWork',$item->id)}}">
                                             <button class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Detail">
                                                 <i class="fa-solid fa-eye"></i>
                                             </button>
                                         </a>

                                    </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="my-3">
            {{$data->appends(request()->query())->links()}}

                   </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
