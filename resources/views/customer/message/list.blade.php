@extends('customer.layout.index')
@section('title')
    Message list
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col table-responsive mb-5">
            <table class="table text-white table-borderless text-center mb-0">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="align-middle" id="tableData">

                    @foreach ($data as $item)
                    <tr class="@if ($item->status==0) bg-secondary @endif">
                        <td class="align-middle col">{{$item->id}}</td>
                        <td class="align-middle col">{{$item->title}}</td>
                        <td class="align-middle col">{{$item->email}}</td>
                        <td>
                            <a href="{{route('customer#viewMessage',[$item->id,$item->user_id])}}" class="me-3">
                                <button class="item btn text-white" data-toggle="tooltip" data-placement="top" title="View">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
