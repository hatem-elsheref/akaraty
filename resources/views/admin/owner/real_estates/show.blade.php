@extends('layouts.backend-master')
@section('bread')
    <h1>Real Estate Details</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route((auth()->user()->role == ADMIN)?'real-estate.all':'real-estate.index')}}"><i class="fa fa-building-o"></i> Real Estates</a></li>
        <li class="active">Details</li>
    </ol>
@endsection
@section('content')
    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        @if($realEstate->type != 'land' && $realEstate->status =='available')
                            <h3 class="box-title">{{$realEstate->title}} <i class="fa fa-circle text-success"></i>  Available</h3>
                        @elseif($realEstate->status =='busy')
                            <h3 class="box-title">{{$realEstate->title}}<i class="fa fa-circle text-danger"></i>   Currently In Rent From ({{$realEstate->start_rent_date}}) To ({{$realEstate->end_rent_date}})</h3>
                        @elseif($realEstate->status == 'available')
                            <h3 class="box-title">{{$realEstate->title}} <i class="fa fa-circle text-success"></i>   Available</h3>
                            @else
                            <h3 class="box-title">{{$realEstate->title}} <i class="fa fa-circle text-danger"></i>   Not  Available</h3>
                        @endif
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-sm-12 col-md-4">

                                <div class="mailbox-read-message">
                                    <p class="text-bold"> <i class="fa fa-check text-success"></i> Description</p>
                                    <p>{!! $realEstate->description !!}</p>

                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover">
                                            <tbody>
                                            <tr><th>Key</th><th>Value</th></tr>
                                            </tbody>
                                            <tr><th>Name</th><th>{{$realEstate->title}}</th></tr>
                                            <tr><th>Price</th><th>{{$realEstate->price.' '.currency()}}</th></tr>
                                            <tr><th>Area</th><th>{{$realEstate->area}}</th></tr>
                                            <tr><th>Category</th><th>{{$realEstate->category}}</th></tr>
                                            <tr><th>Type</th><th>{{$realEstate->type}}</th></tr>
                                            <tr><th>Status</th><th>{{$realEstate->status??'available'}}</th></tr>
                                            <tr><th>Owner</th><th>{{$realEstate->owner->name}}</th></tr>
                                            <tr><th>Country</th><th>{{$realEstate->state->country->name}}</th></tr>
                                            <tr><th>State</th><th>{{$realEstate->state->name}}</th></tr>
                                            <tr><th>Address</th><th>{{$realEstate->address}}</th></tr>
                                            <tr><th>Bath Room</th><th>{{$realEstate->bath_room_number??'(--Land--)'}}</th></tr>
                                            <tr><th>Bed Room</th><th>{{$realEstate->bath_room_number??'(--Land--)'}}</th></tr>
                                            <tr><th>Living Room</th><th>{{$realEstate->living_room_number??'(--Land--)'}}</th></tr>
                                            <tr><th>Floor Numbers</th><th>{{$realEstate->floors_number??'(--Land--)'}}</th></tr>
                                            <tr><th>Flat Number</th><th>{{$realEstate->flats_number??'(--Land--)'}}</th></tr>
                                            <tr>
                                                <th>Has Pool</th>
                                                <th> @if($realEstate->has_pool) <i class="fa fa-check text-success"></i> @else <i class="fa fa-times text-danger"></i> @endif </th>
                                            </tr>
                                            <tr>
                                                <th>Has Internet</th>
                                                <th>@if($realEstate->has_internet) <i class="fa fa-check text-success"></i> @else <i class="fa fa-times text-danger"></i> @endif</th>
                                            </tr>
                                            <tr>
                                                <th>Has Kitchen</th>
                                                <th>@if($realEstate->has_kitchen) <i class="fa fa-check text-success"></i> @else <i class="fa fa-times text-danger"></i> @endif</th>
                                            </tr>
                                            <tr>
                                                <th>Has Cleaning</th>
                                                <th>@if($realEstate->has_cleaning) <i class="fa fa-check text-success"></i> @else <i class="fa fa-times text-danger"></i> @endif</th>
                                            </tr>
                                            <tr>
                                                <th>Has Parking</th>
                                                <th>@if($realEstate->has_parking) <i class="fa fa-check text-success"></i> @else <i class="fa fa-times text-danger"></i> @endif</th>
                                            </tr>
                                            <tr>
                                                <th>Has Garage</th>
                                                <th>@if($realEstate->has_garage) <i class="fa fa-check text-success"></i> @else <i class="fa fa-times text-danger"></i> @endif</th>
                                            </tr>

                                        </table>


                                        <div class="mailbox-read-message">



                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-8">
                                {{-- IMAGES  --}}
                                <p class="text-bold"> <i class="fa fa-check text-success"></i> Images</p>
                                <ul class="mailbox-attachments clearfix">
                                    @foreach($realEstate->images as $image)
                                        <li>
                                            <span class="mailbox-attachment-icon has-img"><img src="{{uploadedAssets($image->src)}}" style="height: 200px" alt="{{$realEstate->slug}}"></span>
                                            <div class="mailbox-attachment-info">
                                                <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> image ({{$loop->index}})</a>
                                                {{--                                           <span class="mailbox-attachment-size">{{round(\Illuminate\Support\Facades\Storage::disk('my_desk')->size($image->src)/1000/1000,2)}} MB</span>--}}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
{{--                                <hr>--}}
{{--                                <iframe--}}
{{--                                    width="300"--}}
{{--                                    height="170"--}}
{{--                                    frameborder="0"--}}
{{--                                    scrolling="no"--}}
{{--                                    marginheight="0"--}}
{{--                                    marginwidth="0"--}}
{{--                                    src="https://maps.google.com/maps?q='+{{$realEstate->lat}}+','+{{$realEstate->long}}+'&hl=es&z=20&amp;output=embed"--}}
{{--                                >--}}
{{--                                </iframe>--}}
{{--                                <br />--}}
{{--                                <small>--}}
{{--                                    <a--}}
{{--                                        href="https://maps.google.com/maps?q='+data.lat+','+data.lon+'&hl=es;z=14&amp;output=embed"--}}
{{--                                        style="color:#0000FF;text-align:left"--}}
{{--                                        target="_blank"--}}
{{--                                    >--}}
{{--                                        See map bigger--}}
{{--                                    </a>--}}
{{--                                </small>--}}
{{--                                <hr>--}}
    {{--                                <iframe width="420" height="315"--}}
    {{--                                        src="{{$realEstate->video }}">--}}

    {{--                                </iframe>--}}

                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                    </div>
                    <!-- /.box-footer -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <a href="{{route((auth()->user()->role == ADMIN)?'real-estate.all':'real-estate.index')}}" class="btn btn-primary"><i class="fa fa-reply"></i> Back</a>
                        </div>

                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /. box -->
            </div>
        </div>
        </div>
    </section>
@endsection
