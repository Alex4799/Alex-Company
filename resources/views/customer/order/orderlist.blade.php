@extends('customer.layout.index')

@section('title','Cart')

@section('content')

        <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col table-responsive mb-5">
                    <table class="table table-dark table-borderless table-hover text-center mb-0">
                        <thead class="thead-white">
                            <tr>
                                <th>Image</th>
                                <th>Products Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle" id="tableData">

                            @foreach ($data as $order)
                            <tr class="my-2">
                                <td class="align-middle col-3"><img src="{{asset('storage/'.$order->product_image)}}" class=" img-thumbnail shadow-sm w-100" alt=""></td>
                                <td class="align-middle"><a class="text-white" href="{{route('customer#viewProduct',$order->product_id)}}">{{$order->product_name}}</a></td>
                                <td class="align-middle col">{{$order->product_price}} MMK</td>
                                <td class="align-middle col">{{$order->qty}}</td>
                                <td class="align-middle col">{{$order->total}} MMK</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Cart End -->


@endsection

