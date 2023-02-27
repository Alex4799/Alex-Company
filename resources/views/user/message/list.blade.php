@extends('user.layout.index')
@section('title')
    Message list
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
                            <h1 class="title-1">Message List</h1>

                        </div>
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (empty(request('sent_message')))
                            Inbox
                        @else
                            Sent
                        @endif
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{route('user#messageList')}}">Inbox</a></li>
                          <li><a class="dropdown-item" href="{{route('user#messageList',['sent_message'=>Auth::user()->email])}}" @if (request('sent_message')) selected @endif>Sent</a></li>
                        </ul>
                </div>

                    <div class="table-data__tool-right">
                        <a href="{{route('user#messageSendPage')}}">
                            <button class="btn btn-dark">
                                <i class="fa-solid fa-user-plus me-2"></i>New Message
                            </button>
                        </a>
                    </div>

                </div>
                <div>
                    <h1 class="text-center p-2">Total - {{$data->total()}}</h1>
                </div>
                @if (session('sendSucc'))
                    <div class="alert alert-success alert-dismissible fade show col-4 offset-8" role="alert">
                        {{session('sendSucc')}}
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
                        <table class="table table-borderless table-hover text-center mb-0">

                            <tbody class="align-middle" id="tableData">

                                @foreach ($data as $item)
                                <tr class="tr-shadow @if ($item->status==0) bg-white @endif">
                                    <td class="text-dark text-center">{{$item->id}}</td>
                                    <td class="text-dark text-center">{{$item->title}}</td>
                                    <td class="text-dark text-center">{{$item->email}}</td>
                                    <td>
                                        <div class="table-data-feature">

                                        <a href="{{route('user#viewMessage',[$item->id,$item->user_id])}}" class="me-3">
                                            <button class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </a>

                                        @if ($item->email==Auth::user()->email)
                                        <a href="{{route('user#deleteMessage',$item->id)}}" class="me-3">
                                            <button class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </a>
                                        @endif

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
