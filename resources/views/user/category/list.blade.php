@extends('user.layout.index')
@section('title')
    Category list
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class=" d-flex justify-content-between">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h1 class="title-1">Category List</h1>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('user#addCategoryPage')}}">
                            <button class="btn btn-dark">
                                <i class="fa-solid fa-plus me-1"></i>add Category
                            </button>
                        </a>

                    </div>
                </div>
                <div class="my-3">
                    <form action="#" method="get">
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
                @if (session('updateSucc'))
                    <div class="alert alert-success alert-dismissible fade show col-4 offset-8" role="alert">
                        {{session('updateSucc')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

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

                <div class="row">
                    <div class="col table-responsive mb-5">
                        <table class="table table-dark table-borderless table-hover text-center mb-0">
                            <thead class="thead-white">
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="align-middle" id="tableData">

                                @foreach ($data as $item)
                                <tr class="tr-shadow">
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <div class="table-data-feature">

                                         <a href="{{route('user#editCategory',$item->id)}}" class="me-3">
                                             <button class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Edit">
                                                 <i class="fa-solid fa-user-pen"></i>
                                             </button>
                                         </a>

                                         <a href="{{route('user#deleteCategory',$item->id)}}" class="me-3">
                                             <button class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Delete">
                                                 <i class="fa-solid fa-trash"></i>
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
