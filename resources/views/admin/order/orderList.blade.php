@extends('admin.layout.index')
@section('title')
    Order list
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
                            <p class="fs-3"><a href="{{route('admin#orderHistory')}}">Order</a>/Order List</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col table-responsive mb-5">
                        <table class="table table-dark table-borderless table-hover text-center mb-0">
                            <thead class="thead-white">
                                <tr>
                                    <th>Image</th>
                                    <th>Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle" id="tableData">

                                @foreach ($data as $item)
                                <tr class="tr-shadow">
                                    <td class="align-middle col-3"><img src="{{asset('storage/'.$item->product_image)}}" class=" img-thumbnail shadow-sm w-100" alt=""></td>
                                    <td class="align-middle">{{$item->product_name}}</td>
                                    <td class="align-middle">{{$item->product_price}} MMK</td>
                                    <td class="align-middle">{{$item->qty}}</td>
                                    <td class="align-middle">{{$item->total}} MMK</td>
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
