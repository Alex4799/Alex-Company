@extends('admin.layout.index')
@section('title')
    User list
@endsection

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-12">
                <!-- DATA TABLE -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="overview-wrap">
                            <h1 class="title-1">User List</h1>

                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-3">
                        <a href="{{route('admin#addUserPage')}}">
                            <button class="btn btn-dark">
                                <i class="fa-solid fa-user-plus me-2"></i>Add User
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
                                    <th>IMAGE</th>
                                    <th>NAME</th>
                                    <th>POSITION</th>
                                    <th>NRC</th>
                                    <th>GENDER</th>
                                    <th>EMAIL</th>
                                    <th>PHONE</th>
                                    <th>ADDRESS</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="align-middle" id="tableData">

                                @foreach ($data as $item)
                                <tr class="tr-shadow">
                                    <td  class="align-middle col-2">
                                         @if ($item->image==null)
                                             @if ($item->gender=='male')
                                                 <img src="{{asset('image/default-male-image.png')}}" class="w-100 shadow">
                                             @else
                                                 <img src="{{asset('image/default-female-image.webp')}}" class="w-100 shadow">
                                             @endif
                                         @else
                                             <img src="{{asset('storage/'.$item->image)}}" class="w-100 shadow">
                                         @endif
                                    </td>
                                    <input type="hidden" id="adminId" value="{{$item->id}}">
                                    <td class="align-middle col">{{$item->name}}</td>
                                    <td class="align-middle col">{{$item->position}}</td>
                                    <td class="align-middle col">{{$item->NRC}}</td>
                                    <td class="align-middle col">{{$item->gender}}</td>
                                    <td class="align-middle col">{{$item->email}}</td>
                                    <td class="align-middle col">{{$item->phone}}</td>
                                    <td class="align-middle col">{{$item->address}}</td>
                                    <td class="align-middle col">
                                        <div class="table-data-feature">

                                         <a href="{{route('admin#messageSendPage',['reply_message'=>$item->email])}}" class="me-3">
                                             <button class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Message">
                                                 <i class="fa-solid fa-message"></i>
                                             </button>
                                         </a>

                                         <a href="{{route('admin#editUser',$item->id)}}" class="me-3">
                                             <button class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Edit">
                                                 <i class="fa-solid fa-user-pen"></i>
                                             </button>
                                         </a>

                                         <a href="{{route('admin#deleteUser',$item->id)}}" class="me-3">
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
