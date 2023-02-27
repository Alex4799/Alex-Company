@extends('admin.layout.index')
@section('title')
    Enrollment
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
                            <p class="fs-3"><a href="{{route('admin#enrollmentList')}}">Enrollment List</a>/Enrollment</p>
                        </div>
                    </div>
                </div>
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap row">
                            <h1 class="title-1">{{$id}}</h1>
                            <div>
                                <h1>Total - {{$data->total()}}</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col table-responsive mb-5">
                        <table class="table table-dark table-borderless table-hover text-center mb-0">
                            <thead class="thead-white">
                                <tr>
                                    <th>Id</th>
                                    <th>User Name</th>
                                    <th>Enrollment Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle" id="tableData">

                                @foreach ($data as $item)
                                <tr class="tr-shadow ">
                                    <td class="text-white text-center">{{$item->id}}</td>
                                    <td class="@if ($item->status == 0) text-danger @elseif ($item->status == 1) text-success @endif text-center">{{$item->user_name}}</td>
                                    <td class="text-white text-center">{{$item->enrollment_id}}</td>
                                    <td>
                                     <select class="form-control" disabled>
                                         <option value="0" @if ($item->status == 0) selected @endif>Fail</option>
                                         <option value="1" @if ($item->status == 1) selected @endif>Success</option>
                                     </select>
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
