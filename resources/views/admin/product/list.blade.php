@extends('admin.layout.index')
@section('title')
    Product list
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
                            <h1 class="title-1">Product List</h1>

                        </div>
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                          <li><a class="dropdown-item" href="{{route('admin#productList')}}">All</a></li>
                          @foreach ($category as $item)
                          <li><a class="dropdown-item" href="{{route('admin#productList',['category_id'=> $item->id])}}">{{$item->name}}</a></li>
                          @endforeach
                        </ul>
                    </div>

                    <div class="table-data__tool-right">
                        <a href="{{route('admin#productCreatePage')}}">
                            <button class="btn btn-dark">
                                <i class="fa-solid fa-plus me-1"></i>add Product
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
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>View</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="align-middle" id="tableData">

                                @foreach ($data as $item)
                                <tr class="tr-shadow">
                                    <td class="col-3">
                                         @if ($item->image1==null)
                                             <img src="{{asset('image/default.jpg')}}" class="w-100 shadow">
                                         @else
                                             <img src="{{asset('storage/'.$item->image1)}}" class="w-100 shadow">
                                         @endif
                                    </td>
                                    <input type="hidden" id="adminId" value="{{$item->id}}">
                                    <td class="col">{{$item->name}}</td>
                                    <td class="col">{{$item->category_name}}</td>
                                    <td class="col">{{$item->price}} MMK</td>
                                    <td class="col">{{$item->view}}</td>
                                    <td class="col">
                                        <div class="table-data-feature">

                                         <a href="{{route('admin#viewProduct',$item->id)}}" class="me-3">
                                             <button class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="View">
                                                 <i class="fa-solid fa-eye"></i>
                                             </button>
                                         </a>

                                         <a href="{{route('admin#deleteProduct',$item->id)}}" class="me-3">
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
