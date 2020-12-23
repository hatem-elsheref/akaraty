@extends('layouts.frontend-master')
@section('css')
    <style>
            .slider-element { padding: 250px 0 150px; }

            .device-md .slider-element,
            .device-sm .slider-element,
            .device-xs .slider-element { padding: 60px 0; }

            .expand-link { display: none; }
            .more-search {
                display: block;
                margin-top: 10px;
                float: right;
                text-align: right;
                color: #FFF;
                cursor: pointer;
            }

            label {font-family: 'Lora', sans-serif !important;}

            .bootstrap-select.btn-group > .dropdown-toggle {
                background-color: #dae0e5;
                border-color: #d3d9df;
            }
        </style>
@endsection
@section('content')
    <!-- Slider
    ============================================= -->
    <section id="slider" class="slider-element include-header include-topbar" style="background: url('{{asset('theme/demos/real-estate/images/items/page-title.jpg')}}') center center no-repeat; background-size: cover; overflow: visible;">

        <div class="container" style="z-index: 2">
            <div class="tabs advanced-real-estate-tabs">

                <div class="tab-container">

                    <div class="tab-content clearfix" id="tab-properties">
                        <form action="{{route('real_estate.search')}}" method="get" class="mb-0">
                            <div class="row clearfix">
                                <div class="col-md-2 col-sm-12">
                                    <label  class="d-block">Type</label>
                                    <input class="bt-switch" name="category"  type="checkbox" checked data-on-text="Buy" data-off-text="Rent" data-on-color="themecolor" data-off-color="themecolor">
                                </div>
                                <div class="col-md-4 col-sm-6 col-12">
                                    <label for="">Locations</label>
                                    <select class="selectpicker form-control" multiple data-live-search="true" name="states[]" data-size="6" style="width:100%;">
                                        @foreach($countries as $country)
                                            <optgroup label="{{$country->name}}">
                                                @foreach($country->states as $state)
                                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-6 col-12">
                                    <label for="">Property Type</label>
                                    <select class="selectpicker form-control" name="building_type" data-size="6" style="width:100%; line-height: 30px;">
                                        <option value="Any">Any</option>
                                        <optgroup label="Real Estate">
                                            @foreach(buildingTypes() as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-6 col-6">
                                    <button class="button button-3d button-rounded btn-block m-0" style="margin-top: 29px !important;">Search</button>
                                </div>
                            </div>
                            <div class="clear"></div>

                            <div class="expand-link">
                                <div class="row justify-content-between mt-3">
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <label for="" style="margin-bottom: 20px !important;">Price Range</label>
                                        <input class="price-range-slider" name="price" />
                                    </div>
                                    <div class="clear d-xl-none d-lg-none d-md-none d-sm-none bottommargin-sm"></div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <label for="" style="margin-bottom: 20px !important;">Property Area</label>
                                        <input class="area-range-slider" name="area" />
                                    </div>
                                    <div class="col-md-2 col-sm-6 bottommargin-sm">
                                        <label for="">Beds</label>
                                        <select class="selectpicker form-control" name="bed" multiple data-size="6" data-placeholder="Any" style="width:100%; line-height: 30px;">
                                            @foreach(beds_bathrooms() as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-6 bottommargin-sm">
                                        <label for="">Baths</label>
                                        <select class="selectpicker form-control" name="bath" multiple data-size="6" data-placeholder="Any" style="width:100%; line-height: 30px;">
                                            @foreach(beds_bathrooms() as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <span class="more-search"><i class="icon-line-plus"></i> Advanced Search</span>
            </div>
        </div>
        <div class="video-wrap" style="position: absolute; top: 0; left: 0; height: 100%; z-index:1;">
            <div class="video-overlay" style="background: rgba(0,0,0,0.3); z-index: 1;"></div>
        </div>

    </section><!-- #slider end -->

    <!-- Content
    ============================================= -->
    <section id="content">
        <div class="content-wrap pt-0">

            <div class="section bg-transparent m-0 clearfix">
                <div class="container clearfix">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <a href="#" class="btn text-white bg-color px-4"><i class="icon-line2-list"></i> List</a>
                        </div>
                        <div class="col-8 text-right">

                            <div class="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Listing</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <a class="dropdown-item" href="{{route('type.search','any')}}">Any</a>
                                    @foreach(realState() as $itemName => $itemValue)
                                            <a class="dropdown-item" href="{{route('type.search',$itemValue)}}">{{ucfirst($itemName)}}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="dropdown ml-2">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Popular Listed</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        @foreach(category() as $category)
                                            <a class="dropdown-item" href="{{route('category.search',$category)}}">{{ucfirst($category)}}</a>
                                        @endforeach
                                            <a class="dropdown-item" href="{{route('price.search','low-high')}}">Price: Low To High</a>
                                            <a class="dropdown-item" href="{{route('price.search','high-low')}}">Price: High To Low </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="real-estate mt-5 grid-container row portfolio gutter-20 col-mb-50" data-layout="fitRows">
                        @foreach($real_states as $real_estate)
                            <div class="real-estate-item portfolio-item col-12 col-md-6 col-lg-4">
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
            </div>

            <div class="container clearfix ">
                    {!! $real_states->render() !!}
            </div>
        </div><!-- .content-wrap end -->
    </section><!-- #content end -->

@endsection
