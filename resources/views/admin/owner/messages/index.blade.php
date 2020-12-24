@extends('layouts.backend-master')
@section('bread')
    <h1>All Contacts</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Contacts</li>
    </ol>
@endsection
@section('content')
    <section>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Contacts <span class="badge badge-success">{{$contacts->count()}}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody><tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Message</th>
                                <th>Order</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{$contact->id}}</td>
                                    <td>{{$contact->user->name}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>
                                        @if($contact->status === 'read')
                                            <span class="badge badge-success" style="background-color: seagreen">Read</span>
                                        @else
                                            <span class="badge badge-danger" style="background-color: #d73925; ">Un Read</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-view-{{$contact->id}}"> <i class="fa fa-eye"></i> View</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-view-order-{{$contact->id}}"> <i class="fa fa-eye"></i> View</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-reply-{{$contact->id}}"> <i class="fa fa-reply"></i> Reply  </button>
                                        <a class="btn btn-sm btn-success" href="{{route('order_contact.update',$contact->id)}}"> <i class="fa fa-check"></i> Change The Status  </a>
                                        <button class="btn btn-sm btn-danger" onclick="RemoveItem('item-remove-{{$contact->id}}','Do You Sure To Remove This Message?')"> <i class="fa fa-trash"></i>   Remove </button>
                                    </td>
                                    <form action="{{route('order_contact.destroy',$contact->id)}}" id="item-remove-{{$contact->id}}" method="POST">@csrf @method('DELETE') </form>
                                    <div class="modal fade" id="modal-reply-{{$contact->id}}" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">Reply To User</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('order_contact.reply')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="email" value="{{$contact->email}}">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="subject" placeholder="Subject:">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <textarea name="message" class="form-control" placeholder="message" rows="10">{{old('message')}}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="submit" value="Send" class="btn btn-primary">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <div class="modal fade" id="modal-view-{{$contact->id}}" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">View User Message</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input class="form-control" value="{{$contact->name}}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input class="form-control" value="{{$contact->email}}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input class="form-control" value="{{$contact->phone}}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <textarea  class="form-control"  rows="10" readonly>{{$contact->message}}</textarea>
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
                                    <div class="modal fade" id="modal-view-order-{{$contact->id}}" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">View Real Estate Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item">Title    <span class="text-danger"> : </span> {{$contact->real_estate->title}}</li>
                                                                <li class="list-group-item">Country  <span class="text-danger"> : </span> {{$contact->real_estate->state->country->name}}</li>
                                                                <li class="list-group-item">State    <span class="text-danger"> : </span> {{$contact->real_estate->state->name}}</li>
                                                                <li class="list-group-item">Address  <span class="text-danger"> : </span> {{$contact->real_estate->address}}</li>
                                                                <li class="list-group-item">Price    <span class="text-danger"> : </span> {{$contact->real_estate->price.' '.currency()}}</li>
                                                                <li class="list-group-item">Type     <span class="text-danger"> : </span> {{$contact->real_estate->type}}</li>
                                                                <li class="list-group-item">Category <span class="text-danger"> : </span> {{$contact->real_estate->category}}</li>
                                                                <li class="list-group-item">Area<span class="text-danger"> : </span> {{$contact->real_estate->area}}</li>
                                                                <li class="list-group-item">Read More <span class="text-danger"> : </span>
                                                                    <a href="{{route('real-estate.show',$contact->realEstate)}}" target="_blank">MORE</a></li>
                                                                @if($contact->real_estate->type != 'land')
                                                                    <li class="list-group-item">Bed Rooms <span class="text-danger">    : </span> {{$contact->real_estate->bed_room_number}}</li>
                                                                    <li class="list-group-item">Bath Rooms <span class="text-danger">   : </span> {{$contact->real_estate->bath_room_number}}</li>
                                                                    <li class="list-group-item">Living Rooms <span class="text-danger"> : </span> {{$contact->real_estate->living_room_number}}</li>
                                                                    <li class="list-group-item">Floors Number <span class="text-danger">: </span> {{$contact->real_estate->floors_number}}</li>
                                                                    <li class="list-group-item">Flats Number <span class="text-danger"> : </span> {{$contact->real_estate->flats_number}}</li>
                                                                    <li class="list-group-item">Has Pool <span class="text-danger">     : </span> {{$contact->real_estate->has_pool?'YES':'NO'}}</li>
                                                                    <li class="list-group-item">Has Kitchen <span class="text-danger">  : </span> {{$contact->real_estate->has_kitchen?'YES':'NO'}}</li>
                                                                    <li class="list-group-item">Has Garage <span class="text-danger">   : </span> {{$contact->real_estate->has_garage?'YES':'NO'}}</li>
                                                                    <li class="list-group-item">Has Parking <span class="text-danger">  : </span> {{$contact->real_estate->has_parking?'YES':'NO'}}</li>
                                                                    <li class="list-group-item">Has Internet <span class="text-danger"> : </span> {{$contact->real_estate->has_internet?'YES':'NO'}}</li>
                                                                    <li class="list-group-item">Has Cleaning <span class="text-danger"> : </span> {{$contact->real_estate->has_cleaning?'YES':'NO'}}</li>
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
                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
{{--                            {!!  $contacts->links() !!}--}}
                        </ul>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>


    </section>
@endsection
