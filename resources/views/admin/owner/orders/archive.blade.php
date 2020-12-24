@extends('layouts.backend-master')
@section('bread')
    <h1>All {{$type}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">{{$type }} Orders</li>
    </ol>
@endsection
@section('content')
    <section>
        <div class="row">

            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Orders <span class="badge badge-success">{{$orders->count()}}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table">
                            <tbody><tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Payment Method</th>
                                <th>Billing Details</th>
                                <th>RealEstate Details</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($orders as $order)
                                <tr class="@if($order->status == 'buying') bg-success @elseif($order->status == 'renting') bg-warning @else bg-danger @endif">
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->user->name}}</td>
                                    <td>{{$order->user->email}}</td>
                                    <td>{{$order->created_at->format('Y-m-d h:i')}}</td>
                                    <td>{{$order->total.' '.currency()}}</td>
                                    <td>{{ucfirst($order->status)}}</td>
                                    <td>{{$order->method}}</td>
                                    <td><button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-billing-{{$order->id}}"> <i class="fa fa-info"></i> View Billing Details </button></td>
                                    <td><button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-view-{{$order->id}}"> <i class="fa fa-eye"></i> View Unit Details </button></td>
                                    <td><button class="btn btn-sm btn-danger" onclick="RemoveItem('item-{{$order->id}}','Remove This Order ??')"> <i class="fa fa-trash"></i>  Remove</button></td>
                                    <form  action="{{route('orders.destroy',$order->id)}}" id="item-{{$order->id}}" method="POST"> @csrf @method('DELETE') </form>
                                    <div class="modal fade" id="modal-billing-{{$order->id}}" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">Billing Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input class="form-control" disabled value="{{$order->first_name .' '.$order->last_name}}" >
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>Country</label>
                                                            <div class="form-group">
                                                                <input class="form-control" disabled value="{{$order->country}}" >
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>Address</label>
                                                            <div class="form-group">
                                                                <input class="form-control" disabled value="{{$order->address}}" >
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>Postcode</label>
                                                            <div class="form-group">
                                                                <input class="form-control" disabled value="{{$order->postcode}}" >
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>Phone</label>
                                                            <div class="form-group">
                                                                <input class="form-control" disabled value="{{$order->phone}}" >
                                                            </div>
                                                        </div>

                                                        @if($order->category != 'rent')
                                                            <div class="col-sm-6">
                                                                <label>Rent The Unit For Months</label>
                                                                <div class="form-group">
                                                                    <input class="form-control" disabled value="{{$order->months}} Months" >
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <div class="col-sm-6">
                                                            <label>Payment</label>
                                                            <div class="form-group">
                                                                <input class="form-control" disabled value="{{$order->method}}" >
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <div class="modal fade" id="modal-view-{{$order->id}}" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">RealEstate Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item">Title    <span class="text-danger"> : </span> {{$order->realEstate->title}}</li>
                                                                <li class="list-group-item">Country  <span class="text-danger"> : </span> {{$order->realEstate->state->country->name}}</li>
                                                                <li class="list-group-item">State    <span class="text-danger"> : </span> {{$order->realEstate->state->name}}</li>
                                                                <li class="list-group-item">Address  <span class="text-danger"> : </span> {{$order->realEstate->address}}</li>
                                                                <li class="list-group-item">Price    <span class="text-danger"> : </span> {{$order->realEstate->price.' '.currency()}}</li>
                                                                <li class="list-group-item">Type     <span class="text-danger"> : </span> {{$order->realEstate->type}}</li>
                                                                <li class="list-group-item">Category <span class="text-danger"> : </span> {{$order->realEstate->category}}</li>
                                                                <li class="list-group-item">Area<span class="text-danger"> : </span> {{$order->realEstate->area}}</li>
                                                                <li class="list-group-item">Read More <span class="text-danger"> : </span>
                                                                    <a href="{{route('real-estate.show',$order->real_estate_id)}}" target="_blank">MORE</a></li>
                                                                @if($order->type != 'land')
                                                                    <li class="list-group-item">Bed Rooms <span class="text-danger"> : </span> {{$order->realEstate->bed_room_number}}</li>
                                                                    <li class="list-group-item">Bath Rooms <span class="text-danger"> : </span> {{$order->realEstate->bath_room_number}}</li>
                                                                    <li class="list-group-item">Living Rooms <span class="text-danger"> : </span> {{$order->realEstate->living_room_number}}</li>
                                                                    <li class="list-group-item">Floors Number <span class="text-danger"> : </span> {{$order->realEstate->floors_number}}</li>
                                                                    <li class="list-group-item">Flats Number <span class="text-danger"> : </span> {{$order->realEstate->flats_number}}</li>
                                                                    <li class="list-group-item">Has Pool <span class="text-danger"> : </span> {{$order->realEstate->has_pool?'YES':'NO'}}</li>
                                                                    <li class="list-group-item">Has Kitchen <span class="text-danger"> : </span> {{$order->realEstate->has_kitchen?'YES':'NO'}}</li>
                                                                    <li class="list-group-item">Has Garage <span class="text-danger"> : </span> {{$order->realEstate->has_garage?'YES':'NO'}}</li>
                                                                    <li class="list-group-item">Has Parking <span class="text-danger"> : </span> {{$order->realEstate->has_parking?'YES':'NO'}}</li>
                                                                    <li class="list-group-item">Has Internet <span class="text-danger"> : </span> {{$order->realEstate->has_internet?'YES':'NO'}}</li>
                                                                    <li class="list-group-item">Has Cleaning <span class="text-danger"> : </span> {{$order->realEstate->has_cleaning?'YES':'NO'}}</li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {!! $orders->links() !!}
                        </ul>
                    </div>
                </div>
                <!-- /.box -->

            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        @if($type == 'Pending')
        function getTheTimeToShipTheOrder(form){
            let days=Number.parseInt(prompt('Enter The Number Of Days To Ship The Order ?'));
            if (Number.isInteger(days)){
                $('#time_to_shipping').val(days);
                $('#'+form).submit();
            }else{
                alert('Enter A Correct Value To Days !!')
            }
        }
        @endif
    </script>
@endsection
