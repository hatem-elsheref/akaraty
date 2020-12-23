@extends('layouts.frontend-master')

@section('css')
    <style>

        .slider-element .real-estate-info-wrap {
            position: absolute;
            left: auto;
            bottom: 20px;
            width: 100%;
        }

        .real-estate-price {
            position: absolute;
            top: auto;
            left: auto;
            right: 0;
            bottom: 50px;
            z-index: 1;
        }

        .real-estate-price h3 {
            display: block;
            color: #FFF;
            font-size: 44px;
            margin: 0;
            font-weight: 400;
        }

        @media (max-width: 991px) {
            .real-estate-price {
                position: relative;
                top: auto;
                bottom: auto;
                right: 0;
                margin-top: 15px;
            }

            .slider-element .heading-block >h2 {
                font-size: 24px;
            }

            .slider-element .heading-block { width: auto !important; }
        }
    </style>
@endsection


@section('content')
    <!-- Slider
    ============================================= -->
    <section id="slider" class="slider-element dark parallax include-header include-topbar" style="background-image: url('{{asset('theme/demos/real-estate/images/single-condo.jpg')}}'); background-size: cover; height: 550px;" data-bottom-top="background-position:0px 200px;" data-top-bottom="background-position:0px -200px;">

        <div class="container clearfix" style="z-index: 2;">
            <div class="real-estate-info-wrap">
                <div class="heading-block mb-0 border-bottom-0 d-md-flex d-block align-items-center justify-content-between">
                    <h2 class="mr-auto">{{$real_state->title}} / <span class="h5 text-info">{{ucfirst($real_state->type)}}</span></h2>
                    <div class="d-flex flex-shrink-1" data-lightbox="gallery">
                        @foreach($real_state->images as $image)
                            @if($loop->first)
                                <a href="{{$image->src()}}"  class="button button-color button-rounded nott m-0 font-weight-medium align-self-end" data-lightbox="gallery-item"><i class="icon-picture"></i> View Gallery</a>
                            @else
                                <a href="{{$image->src()}}" class="d-none" data-lightbox="gallery-item"></a>
                            @endif
                        @endforeach
{{--                        <a href="{{$real_state->video}}" data-lightbox="iframe" class="button button-color button-rounded nott font-weight-medium align-self-end my-0 ml-2"><i class="icon-play"></i> Play Video</a>--}}
                    </div>
                </div>
                <div class="real-estate-price mb-md-0 mb-lg-4 mb-xl-0"><h3>{{currency().' '.$real_state->price}}<span class="text-light h6">/{{$real_state->category == RENT?'Month':'Total'}}</span></h3></div>
            </div>
        </div>
{{--        <div class="video-wrap" style="position: absolute; top: 0; left: 0; height: 100%;z-index: 1">--}}
{{--            <div class="video-overlay" style="background:linear-gradient(180deg,rgba(0,0,0,.3) 0,transparent 40%,transparent 60%,rgba(0,0,0,.8));"></div>--}}
{{--        </div>--}}

    </section><!-- #slider end -->

    <!-- Content
    ============================================= -->
    <section id="content">
        <div class="content-wrap pt-0">

            <div class="section mt-0" style="padding: 30px 0">
                <div class="container clearfix">
                    <div class="row">
                        <div class="col-md-2 col-6 center">
                            <img src="{{uploadedAssets($real_state->owner->image)}}" alt="Image of owner {{$real_state->owner->name}}" class="img-circle" style="width: 60px; height: 60px;">
                            <h5 class="my-2"><a href="#">{{$real_state->owner->name}}/<span class="text-muted font-weight-normal" style="font-family: 'Roboto'">Host</span></a></h5>
                        </div>
                        <div class="col-md-2 col-6 center">
                            @if($real_state->category == RENT)
                                <i class="icon-realestate-rent i-plain i-xlarge mx-auto mb-0"></i>
                                <h5 class="my-1">Rental Only</h5>
                            @else
                                <i class="icon-realestate-buying-a-home i-plain i-xlarge mx-auto mb-0"></i>
                                <h5 class="my-1">buying Only</h5>
                            @endif

                        </div>
                        <div class="col-md-2 col-6 center">
                            <i class="icon-realestate-bed i-plain i-xlarge mx-auto mb-0"></i>
                            <h5 class="my-1">{{$real_state->bed_room_number??'--'}} Bedrooms</h5>
                        </div>
                        <div class="col-md-2 col-6 center">
                            <i class="icon-realestate-plan2 i-plain i-xlarge mx-auto mb-0"></i>
                            <h5 class="my-1">{{$real_state->area}} SqFt.</h5>
                        </div>
                        <div class="col-md-2 col-6 center">
                            <i class="icon-realestate-bathtub i-plain i-xlarge mx-auto mb-0"></i>
                            <h5 class="my-1">{{$real_state->bath_room_number??'--'}} Bathrooms</h5>
                        </div>
                        <div class="col-md-2 col-6 center">
                            @if($real_state->type == 'apartment')
                                <i class="icon-realestate-building3 i-plain i-xlarge mx-auto mb-0"></i>
                                <h5 class="my-1">Apartment</h5>
                            @elseif($real_state->type == 'building')
                                <i class="icon-realestate-building i-plain i-xlarge mx-auto mb-0"></i>
                                <h5 class="my-1">Building</h5>
                            @else
                                <i class="icon-square i-plain i-xlarge mx-auto mb-0"></i>
                                <h5 class="my-1">Land</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="container clearfix">

                <div class="row gutter-40 col-mb-80">
                    <div class="postcontent col-lg-9">
                        <p>{!! $real_state->description !!}</p>
                        <h4 class="mb-0 topmargin">Specification</h4>
                        <div class="line line-sm mt-1 mb-3"></div>
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <ul class="iconlist">
                                    <li class="mb-1"><i class="icon-line2-check"></i>Title: {{$real_state->title}}</li>
                                    <li class="mb-1"><i class="icon-line2-check"></i>Address: {{$real_state->address}}</li>
                                    <li class="mb-1"><i class="icon-line2-check"></i>Country: {{$real_state->state->country->name.'/'.$real_state->state->name}}</li>
                                    <li class="mb-1"><i class="icon-line2-check"></i>Type: {{$real_state->type}}</li>
                                    <li class="mb-1"><i class="icon-line2-check"></i>Category: {{$real_state->category??'--'}}</li>
                                    <li class="mb-1"><i class="icon-line2-check"></i>Square Areas: {{$real_state->area}}</li>
                                    <li class="mb-1"><i class="icon-line2-check"></i>Price: {{currency().' '.$real_state->price}}</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <ul class="iconlist">
                                        @if($real_state->has_parking)
                                            <li class="mb-1"><i class="icon-line2-check"></i>Parking: <span class="text-success"><i class="icon-check-sign"></i></span></li>
                                        @else
                                        <li class="mb-1"><i class="icon-line2-check"></i>Parking: <span class="text-danger"><i class="icon-minus-sign-alt"></i></span></li>
                                        @endif
                                        @if($real_state->has_garage)
                                            <li class="mb-1"><i class="icon-line2-check"></i>Garage <span class="text-success"><i class="icon-check-sign"></i></span></li>
                                        @else
                                            <li class="mb-1"><i class="icon-line2-check"></i>Garage : <span class="text-danger"><i class="icon-minus-sign-alt"></i></span></li>
                                        @endif
                                        @if($real_state->has_pool)
                                            <li class="mb-1"><i class="icon-line2-check"></i>Pool : <span class="text-success"><i class="icon-check-sign"></i></span></li>
                                        @else
                                            <li class="mb-1"><i class="icon-line2-check"></i>Pool : <span class="text-danger"><i class="icon-minus-sign-alt"></i></span></li>
                                        @endif
                                        @if($real_state->has_kitchen)
                                            <li class="mb-1"><i class="icon-line2-check"></i>Kitchen : <span class="text-success"><i class="icon-check-sign"></i></span></li>
                                        @else
                                            <li class="mb-1"><i class="icon-line2-check"></i>Kitchen : <span class="text-danger"><i class="icon-minus-sign-alt"></i></span></li>
                                        @endif
                                            @if($real_state->has_cleaning)
                                                <li class="mb-1"><i class="icon-line2-check"></i>Cleaning : <span class="text-success"><i class="icon-check-sign"></i></span></li>
                                            @else
                                                <li class="mb-1"><i class="icon-line2-check"></i>Cleaning : <span class="text-danger"><i class="icon-minus-sign-alt"></i></span></li>
                                            @endif
                                            @if($real_state->has_internet)
                                                <li class="mb-1"><i class="icon-line2-check"></i>Internet : <span class="text-success"><i class="icon-check-sign"></i></span></li>
                                            @else
                                                <li class="mb-1"><i class="icon-line2-check"></i>Internet : <span class="text-danger"><i class="icon-minus-sign-alt"></i></span></li>
                                            @endif

                                </ul>
                            </div>
                            <div class="col-md-4">
                                <ul class="iconlist">
                                    <li class="mb-1"><i class="icon-line2-check"></i>Total Flats: {{$real_state->flats_number??'--'}}</li>
                                    <li class="mb-1"><i class="icon-line2-check"></i>Total Floors: {{$real_state->floors_number??'--'}}</li>
                                    <li class="mb-1"><i class="icon-line2-check"></i>Bed rooms: {{$real_state->bed_room_number?? '--'}}</li>
                                    <li class="mb-1"><i class="icon-line2-check"></i>Living rooms: {{$real_state->living_room_number?? '--'}}</li>
                                    <li class="mb-1"><i class="icon-line2-check"></i>Bathrooms: {{$real_state->bath_room_number?? '--'}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row gutter-40 col-mb-80 align-items-stretch mx-0 topmargin-lg" style="box-shadow: 0 0 40px rgba(0,0,0,.06)">
                            <div class="col-md-12">
                                <div class="col-padding">
                                    <div class="quick-contact-widget form-widget clearfix">

                                        <h3 class="text-capitalize ls1 font-weight-normal">Contact The Owner</h3>

                                        <div class="form-result"></div>

                                        <form id="quick-contact-form" name="quick-contact-form" action="{{route('owner.send')}}" method="post" class="quick-contact-form mb-0">
                                            @csrf
                                            <input type="hidden" name="item" value="{{$real_state->slug}}">
                                            @foreach($errors->all() as $error)
                                                <div class="alert alert-danger">* {{$error}}</div>
                                            @endforeach
                                            @if(session()->has('response'))
                                                <div class="alert alert-{{session()->get('response')['type']}}">* {{session()->get('response')['message']}}</div>
                                            @endif

                                            <input type="text" class="required sm-form-control input-block-level not-dark" id="quick-contact-form-name" name="name" value="{{old('name')}}" placeholder="Full Name" />
                                            <input type="email" class="required sm-form-control email input-block-level not-dark" id="quick-contact-form-email" name="email" value="{{old('email')}}" placeholder="Email Address" />
                                            <input type="text" class="required sm-form-control input-block-level not-dark" id="quick-contact-form-phone" name="phone" value="{{old('phone')}}" placeholder="Phone Number (+1-555-2221)" />
                                            <textarea class="required sm-form-control input-block-level not-dark short-textarea" id="quick-contact-form-message" name="message" rows="5" cols="30" placeholder="What are you Looking for? (Ex: Villa on the Beach)">{{old('message')}}</textarea>
                                            <button type="submit" id="quick-contact-form-submit" name="quick-contact-form-submit" class="button button-small button-rounded m-0" value="submit">Send Email</button>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="sidebar sticky-sidebar-wrap col-lg-3">
                        <div class="sidebar-widgets-wrap">
                            <div class="sticky-sidebar">

                                <div class="widget quick-contact-widget form-widget clearfix">

                                    <div class="card bg-light">
                                        <div class="card-header">Reserve Now</div>
                                        <div class="card-body">
                                            <div class="form-result"></div>
{{--                                            <form id="quick-contact-form" name="quick-contact-form" action="include/form.php" method="post" class="quick-contact-form mb-0">--}}
{{--                                                <div class="form-process">--}}
{{--                                                    <div class="css3-spinner">--}}
{{--                                                        <div class="css3-spinner-scaler"></div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <input type="text" class="required sm-form-control input-block-level" id="quick-contact-form-name" name="quick-contact-form-name" value="" placeholder="Full Name" />--}}
{{--                                                <input type="text" class="required sm-form-control email input-block-level" id="quick-contact-form-email" name="quick-contact-form-email" value="" placeholder="Email Address" />--}}
{{--                                                <input type="number" class="required sm-form-control number input-block-level" id="quick-contact-form-number" name="quick-contact-form-number" value="" placeholder="Phone Number" />--}}
{{--                                                <textarea class="required sm-form-control input-block-level short-textarea" id="quick-contact-form-message" name="quick-contact-form-message" rows="4" cols="30" placeholder="Message"></textarea>--}}
{{--                                                <input type="text" class="d-none" id="quick-contact-form-botcheck" name="quick-contact-form-botcheck" value="" />--}}
{{--                                                <input type="hidden" name="prefix" value="quick-contact-form-">--}}
{{--                                                <button type="submit" id="quick-contact-form-submit" name="quick-contact-form-submit" class="button  button-rounded btn-block m-0" value="submit">Book Now</button>--}}
{{--                                            </form>--}}
                                            <a href="{{route('booking.checkout.view',$real_state->id)}}" id="quick-contact-form-submit"  class="button  button-rounded btn-block m-0 text-center">Book Now</a>
                                        </div>
                                    </div>

                                </div>

{{--                                <div class="widget clearfix">--}}
{{--                                    <h4>Map</h4>--}}
{{--                                    <a href="https://www.latlong.net/c/?lat={{$real_state->lat}}&long={{$real_state->long}}" target="_blank">--}}
{{--                                        See The Place In Map--}}
{{--                                        ({{$real_state->lat}}, {{$real_state->long}})--}}
{{--                                    </a>--}}
{{--                                    <iframe src="https://maps.google.com/?q=,&ll=38.6531004,-90.243462&z=3" width="600" height="450" style="border:0" allowfullscreen></iframe>--}}
{{--                                </div>--}}

{{--                                <div class="widget clearfix">--}}
{{--                                    <h4>Video</h4>--}}
{{--                                    <iframe width="560" height="315" src="{{$real_state->video}}" allow="encrypted-media" allowfullscreen></iframe>--}}
{{--                                </div>--}}


                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="clear topmargin"></div>

            <div class="container clearfix">



                <h3>Similar Properties</h3>

                <div class="row col-mb-50">
                    @foreach($related as $real_estate)
                        <div class="real-estate-item col-md-6 col-xl-4">
                            <div class="real-estate-item-image">
                                @if($real_estate->category == RENT)
                                    <div class="badge badge-success">For Rent</div>
                                @else
                                    <div class="badge badge-danger">For Sale</div>
                                @endif
                                    <a href="{{route('real_estate.details',$real_estate->slug)}}">
                                        <img src="{{$real_estate->mainImage()}}" alt="{{$real_estate->slug}}" style="height: 250px">
                                    </a>
                                    <div class="real-estate-item-price">
                                        @if($real_estate->category == RENT)
                                            {{currency().' '. $real_estate->price}}<span>{{strtoupper($real_estate->type)}}</span>
                                        @else
                                            {{currency().' '. $real_estate->price}}<span>{{strtoupper($real_estate->type)}}</span>
                                        @endif

                                    </div>
                                <div class="real-estate-item-info clearfix" data-lightbox="gallery">
                                    @foreach($real_estate->images as $image)
                                        @if($loop->first)
                                            <a href="{{$image->src()}}" data-toggle="tooltip" title="Images" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>
                                        @else
                                            <a href="{{$image->src()}}" class="d-none" data-lightbox="gallery-item"></a>
                                        @endif
                                    @endforeach
                                        <span class="text-white">{{$real_estate->owner->name}}</span>
                                </div>
                            </div>

                            <div class="real-estate-item-desc p-0">
                                <h3><a href="{{route('real_estate.details',$real_estate->slug)}}">{{$real_estate->title}}</a></h3>
                                <span>{{$real_estate->state->country->name .' '.$real_estate->state->name}}</span>

                                <a href="{{route('real_estate.details',$real_estate->slug)}}" class="real-estate-item-link"><i class="icon-info"></i></a>

                                <div class="line" style="margin-top: 15px; margin-bottom: 15px;"></div>

                                <div class="real-estate-item-features font-weight-medium font-primary clearfix">
                                    <div class="row no-gutters">
                                        <div class="col-lg-4 col-6 p-0">Beds: <span class="color">@if($real_estate->bed_room_number) {{$real_estate->bed_room_number}} @else <span class="text-danger"><i class="icon-minus-sign-alt"></i></span>  @endif</span></div>
                                        <div class="col-lg-4 col-6 p-0">Baths: <span class="color">@if($real_estate->bath_room_number) {{$real_estate->bath_room_number}} @else <span class="text-danger"><i class="icon-minus-sign-alt"></i></span> @endif</span></div>
                                        <div class="col-lg-4 col-6 p-0">Area: <span class="color">{{$real_estate->area}} sqm</span></div>
                                        @if($real_estate->has_pool)
                                            <div class="col-lg-4 col-6 p-0">Pool: <span class="text-success"><i class="icon-check-sign"></i></span></div>
                                        @else
                                            <div class="col-lg-4 col-6 p-0">Pool: <span class="text-danger"><i class="icon-minus-sign-alt"></i></span></div>
                                        @endif

                                        @if($real_estate->has_internet)
                                            <div class="col-lg-4 col-6 p-0">Pool: <span class="text-success"><i class="icon-check-sign"></i></span></div>
                                        @else
                                            <div class="col-lg-4 col-6 p-0">Pool: <span class="text-danger"><i class="icon-minus-sign-alt"></i></span></div>
                                        @endif
                                        @if($real_estate->has_cleaning)
                                            <div class="col-lg-4 col-6 p-0">Pool: <span class="text-success"><i class="icon-check-sign"></i></span></div>
                                        @else
                                            <div class="col-lg-4 col-6 p-0">Pool: <span class="text-danger"><i class="icon-minus-sign-alt"></i></span></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>

        </div><!-- .content-wrap end -->
    </section><!-- #content end -->

    @endsection
