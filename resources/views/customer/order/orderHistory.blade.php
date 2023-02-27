@extends('customer.layout.index')

@section('title','Cart')

@section('content')

        <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col table-responsive mb-5">

                    @if (session('DeleteSucc'))
                    <div class="alert alert-success alert-dismissible fade show col-4 offset-8" role="alert">
                        {{session('DeleteSucc')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <table class="table table-dark table-borderless table-hover text-center mb-0">
                        <thead class="thead">
                            <tr class="text-white">
                                <th>Order ID</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="align-middle" id="tableData">

                            @foreach ($data as $item)
                            <tr class="spacer"></tr>
                            <tr class=" ">

                                <td class="align-middle"><a class="text-decoration-none @if ($item->status == 0) text-warning @elseif ($item->status == 1) text-success @else text-danger @endif"
                                    href="{{route('customer#orderList',$item->order_id)}}">{{$item->order_id}}</a></td>
                                <td class="align-middle">{{$item->total_price}} MMK</td>
                                <td class="align-middle">
                                    <select class="form-control" disabled>
                                        <option value="0" class="text-center" @if ($item->status == 0) selected @endif>Pending</option>
                                        <option value="1" class="text-center" @if ($item->status == 1) selected @endif>Success</option>
                                        <option value="2" class="text-center" @if ($item->status == 2) selected @endif>Fail</option>
                                    </select>
                                </td>
                                <td class="align-middle">{{$item->created_at}}</td>
                                @if ($item->status != 1)
                                    <td class="align-middle"><a href="{{route('customer#orderDelete',$item->id)}}" class="btn btn-sm btn-danger remove"><i class="fa fa-times"></i></a></td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Cart End -->


@endsection

