@extends('admin.layout.index')
@section('title')
    Order
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
                            <h1 class="title-1">Order</h1>
                        </div>
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

                @if (session('DeleteSucc'))
                    <div class="alert alert-danger alert-dismissible fade show col-4 offset-8" role="alert">
                        {{session('DeleteSucc')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive table-responsive-data2" style="height: 50vh">

                           <table class="table table-dark table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Order ID</th>
                                    <th>Total Price</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($data as $item)
                               <tr class="spacer"></tr>
                               <tr class="tr-shadow">
                                   <td class="align-middle"><a class="text-decoration-none" href="{{route('admin#viewProfileCustomer',$item->user_id)}}">{{$item->user_name}}</a></td>
                                   <td class="align-middle"><a class="@if ($item->status == 0) text-warning @elseif ($item->status == 1) text-success @else text-danger @endif"
                                     href="{{route('admin#orderList',$item->order_id)}}">{{$item->order_id}}</a></td>
                                   <td class="align-middle">{{$item->total_price}} MMK</td>
                                   <td class="align-middle">{{$item->created_at}}</td>
                                   <td class="align-middle">
                                    <div class="dropdown">
                                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        @if ($item->status == 0)
                                            Pending
                                        @elseif ($item->status == 1)
                                            Success
                                        @else
                                            Fail
                                        @endif
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="{{route('admin#orderChangeStatus',[$item->id,0])}}">Pending</a></li>
                                          <li><a class="dropdown-item" href="{{route('admin#orderChangeStatus',[$item->id,1])}}">Success</a></li>
                                          <li><a class="dropdown-item" href="{{route('admin#orderChangeStatus',[$item->id,2])}}">Fail</a></li>
                                        </ul>
                                    </div>
                                   </td>
                                   <td>
                                    @if ($item->status == 2)
                                        <div>
                                            <a href="{{route('admin#orderDelete',$item->id)}}" class="me-3">
                                                <button class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </a>
                                        </div>
                                    @endif
                                   </td>
                               </tr>
                               @endforeach
                        </tbody>
                    </table>
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
