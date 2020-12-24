@extends('layouts.backend-master')
@section('bread')
    <h1>All Real Estates</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Real Estates</li>
    </ol>
@endsection
@section('content')
    <section>
        <div class="row">
            <div class="col-xs-12">
                <a href="{{route('real-estate.create_building')}}" class="btn  btn-primary d-block" style="margin-bottom: 5px"><span class="fa fa-plus"></span> Add New Real Estate </a>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Real Estates <span class="badge badge-success">{{$realEstates->total()}}</span></h3>
                        <div class="box-tools">
                            <form action="{{route('real-estate.index')}}" method="get">
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
                        <table class="table ">
                            <tbody><tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Owner</th>
                                <th>Category</th>
                                <th>Type</th>
                                <th>Address</th>
                                <th>Price</th>
                                <th>Area</th>
                                <th>Status</th>
                                <th>view</th>
                            </tr>
                            @forelse($realEstates as $item)
                                @if($item->category == 'rent' && $item->status == 'busy' && \Carbon\Carbon::now()->greaterThan($item->end_rent_date))
                                    <tr class="bg-success">
                                        @elseif($item->category =='buy' && $item->status == 'sold')
                                    <tr class="bg-danger">
                                        @else
                                    <tr>
                                @endif
                                <td>{{$item->id}}</td>
                                    <td><img class="img-circle" src="{{$item->mainImage()}}" alt="{{$item->slug}}" width="45px" height="45px"></td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->owner->name}}</td>
                                    <td>{{$item->category}}</td>
                                    <td>{{$item->type}}</td>
                                    <td>{{$item->state->country->name.' / '.$item->state->name}}</td>
                                    <td>{{currency().' '.$item->price}}</td>
                                    <td>{{$item->area}}</td>
                                    <td>{{$item->status??'available'}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="RemoveItem('item-{{$item->id}}')"> <i class="fa fa-trash"></i>   Remove </button>
                                        <a href="{{route('real-estate.edit',$item->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i>  Edit </a>
                                        <a href="{{route('real-estate.show',$item->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i>  View </a>
                                        @if($item->category == 'rent' && $item->status == 'busy' && \Carbon\Carbon::now()->greaterThan($item->end_rent_date))
                                            <button class="btn btn-sm btn-primary" onclick="RemoveItem('restore-item-{{$item->id}}','Restore The Item And Make It Available')"> <i class="fa fa-check"></i> Available </button>
                                        @endif
{{--                                        @if($item->category =='buy' && $item->status == 'sold')--}}
{{--                                            <button class="btn btn-sm btn-danger" disabled> <i class="fa fa-trash"></i>   Remove </button>--}}
{{--                                            <button class="btn btn-sm btn-success" disabled> <i class="fa fa-edit"></i>   Edit </button>--}}
{{--                                            <a href="{{route('real-estate.show',$item->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i>  View </a>--}}
{{--                                        @else--}}
{{--                                           --}}
{{--                                        @endif--}}
                                    </td>
                                        <form action="{{route('real-estate.destroy',$item->id)}}" id="item-{{$item->id}}" method="POST"> @csrf @method('DELETE') </form>

                                        @if($item->category == 'rent' && $item->status == 'busy' && \Carbon\Carbon::now()->greaterThan($item->end_rent_date))
                                            <form action="{{route('real-estate.available',$item->id)}}" id="restore-item-{{$item->id}}" method="POST"> @csrf </form>
                                        @endif
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="9"> <h5 class="text-bold">No Items Founded...</h5></td>
                                </tr>
                            @endforelse
                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $realEstates->appends(request()->query())->links() }}
                        </ul>

                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection
