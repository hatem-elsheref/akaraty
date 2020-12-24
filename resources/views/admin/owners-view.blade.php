@extends('layouts.backend-master')
@section('bread')
    <h1>All Owners</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Owners</li>
    </ol>
@endsection
@section('content')
    <section>
        <div class="row">

            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Owners <span class="badge badge-success">{{$owners->count()}}</span></h3>
                        <div class="box-tools">
                            <form action="{{route('owner.index')}}" method="get">
                                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                                    <input type="text" name="search" value="{{request()->query('search')}}" class="form-control pull-right" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody><tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Owner Name</th>
                                <th>Owner Email</th>
                                <th>Owner Plan</th>
                                <th>Plan End At</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($owners as $owner)
                                <tr>
                                    <td>{{$owner->id}}</td>
                                    <td><img class="img-circle" src="{{uploadedAssets($owner->image)}}" alt="{{$owner->name}}" width="45px" height="45px"></td>
                                    <td>{{$owner->name}}</td>
                                    <td>{{$owner->email}}</td>
                                    <td>{{$owner->plan->name}}</td>
                                    <td>{{$owner->plan_starting_date}}</td>
                                    <td>
                                        @if($owner->status === 'unblocked')
                                            <span class="badge badge-success" style="background-color: seagreen">Active</span>
                                        @else
                                            <span class="badge badge-danger" style="background-color: #d73925; ">Blocked</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="RemoveItem('item-block-{{$owner->id}}','Do You Sure To (un) Block This Owner?')"> <i class="fa fa-ban"></i>   @if($owner->status === 'unblocked') Block @else Un Block @endif  </button>
                                        <a href="{{route('owner.real_estates',$owner->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i>  View Real Estates </a>
                                    </td>
                                    <form action="{{route('owner.update.status',$owner->id)}}" id="item-block-{{$owner->id}}" method="POST">@csrf @method('PUT')
                                        <input type="hidden" name="id" value="{{$owner->id}}"></form>
                                </tr>
                            @endforeach
                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $owners->appends(request()->query())->links() }}
                        </ul>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection
