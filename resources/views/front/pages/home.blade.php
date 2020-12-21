

@extends('layouts.frontend-master')

@section('content')
    <section id="slider" class="slider-element min-vh-60 min-vh-md-100 include-header include-topbar" style="background: url({{asset('theme/demos/real-estate/images/hero/1.jpg')}}) center center no-repeat; background-size: cover;">

    <!-- Slider
    ============================================= -->
        <div class="slider-inner">

            <div class="vertical-middle">
                <div class="container pt-5 pb-5 pb-lg-0">
                    <div class="tabs advanced-real-estate-tabs">

                        <ul class="tab-nav">
                            <li><a href="#tab-properties">Search Properties</a></li>
                        </ul>

                        <div class="tab-container">

                            <div class="tab-content" id="tab-properties">
                                <form action="{{route('real_estate.search')}}" method="get" class="mb-0">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-12 bottommargin-sm">
                                            <label style="display:block;">Type</label>
                                            <input class="bt-switch" name="category" type="checkbox" checked data-on-text="Buy" data-off-text="Rent" data-on-color="themecolor" data-off-color="themecolor">
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-12 bottommargin-sm">
                                            <label for="">Choose Locations</label>
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
                                        <div class="col-lg-3 col-md-6 col-12 bottommargin-sm">
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
                                        <div class="col-lg-2 col-md-6 col-6 bottommargin-sm">
                                            <label for="">Beds</label>
                                            <select class="selectpicker form-control" name="bed" multiple data-size="6" data-placeholder="Any" style="width:100%; line-height: 30px;">
                                                @foreach(beds_bathrooms() as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-6 bottommargin-sm">
                                            <label for="">Baths</label>
                                            <select class="selectpicker form-control" name="bath" multiple data-size="6" data-placeholder="Any" style="width:100%; line-height: 30px;">
                                                @foreach(beds_bathrooms() as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="col-lg-4 col-md-6 col-12">
                                            <label for="" style="margin-bottom: 20px !important;">Price Range</label>
                                            <input class="price-range-slider" name="price" />
                                        </div>
                                        <div class="w-100 d-block d-md-none bottommargin-sm"></div>
                                        <div class="col-lg-4 offset-lg-1 col-md-6 col-12">
                                            <label for="" style="margin-bottom: 20px !important;">Property Area</label>
                                            <input class="area-range-slider" name="area" />
                                        </div>
                                        <div class="offset-lg-1 col-lg-2 col-md-12">
                                            <button class="button button-3d button-rounded btn-block m-0" style="margin-top: 35px !important;">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="video-wrap">
                <div class="video-overlay" style="background-color: rgba(0,0,0,0.15);"></div>
            </div>

        </div>
    </section><!-- #slider end -->

    <!-- Content
    ============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container">

                <div class="row col-mb-50">
                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-plain">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-realestate-my-house"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3 class="font-weight-normal">Hassle Free</h3>
                                <p>Canvas provides support for Native HTML5 Videos that can be added to a Full Width Background.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-plain">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-realestate-hammer"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3 class="font-weight-normal">Well Constructed</h3>
                                <p>Display your Content attractively using Parallax Sections that have unlimited customizable areas.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-plain">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-realestate-garage"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3 class="font-weight-normal">Free Utilites</h3>
                                <p>You have complete easy control on each &amp; every element that provides endless customization possibilities.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-plain">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-realestate-rent"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3 class="font-weight-normal">Flexible Rentals</h3>
                                <p>Canvas provides support for Native HTML5 Videos that can be added to a Full Width Background.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-plain">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-realestate-credit"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3 class="font-weight-normal">Easy Financing</h3>
                                <p>Display your Content attractively using Parallax Sections that have unlimited customizable areas.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-plain">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-realestate-doc"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3 class="font-weight-normal">Solid Paperwork</h3>
                                <p>You have complete easy control on each &amp; every element that provides endless customization possibilities.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="line"></div>

                <div style="position: relative;">
                    <div class="heading-block border-bottom-0">
                        <h3>Featured Properties</h3>
                    </div>

                    <a href="#" class="button button-small button-rounded button-border button-border-thin font-weight-medium m-0" style="position: absolute; top: 7px; right: 0;">Check All</a>

                    <div class="real-estate owl-carousel image-carousel carousel-widget bottommargin-lg" data-margin="10" data-nav="true" data-loop="true" data-pagi="false" data-items-xs="1" data-items-sm="1" data-items-md="2" data-items-lg="3" data-items-xl="3">
                        {{--                        <div class="badge badge-danger bg-color2">For Sale</div>    $1.2m<span>Leasehold</span>--}}
                        {{--                        <div class="badge badge-success">Hot Deal</div>   $200,000<span>bi-annually</span>--}}
                        {{--                        <div class="badge badge-danger">Long Term Rental</div>   $1600<span>per month</span>--}}
                        @forelse($real_states as $real_estate)
                            <div class="oc-item">
                                <div class="real-estate-item">
                                    <div class="real-estate-item-image">
                                        @if($real_estate->category == RENT)
                                            <div class="badge badge-success">For Rent</div>
                                        @else
                                            <div class="badge badge-danger">For Sale</div>
                                        @endif

                                        <a href="{{route('real_estate.details',$real_estate->slug)}}">
                                            <img src="{{$real_estate->mainImage()}}" alt="{{$real_estate->slug}}">
                                        </a>
                                        <div class="real-estate-item-price">
                                            @if($real_estate->category == RENT)
                                                {{currency().' '. $real_estate->price}}<span>{{strtoupper($real_estate->type)}}</span>
                                            @else
                                                {{currency().' '. $real_estate->price}}<span>{{strtoupper($real_estate->type)}}</span>
                                            @endif

                                        </div>
                                        <div class="real-estate-item-info clearfix">
                                            <span class="text-white">{{$real_estate->owner->name}}</span>
                                        </div>
                                    </div>

                                    <div class="real-estate-item-desc">
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
                            </div>
                        @empty
                            NO ELEMENTS FOUNDED !!
                        @endforelse

                    </div>
                </div>

                <div class="promo promo-dark bg-color bottommargin-lg p-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg">
                            <h3 class="font-weight-normal ls1">Special Offers on More Category </h3>
                        </div>
                        <div class="col-12 col-lg-auto mt-4 mt-lg-0">
                            <a href="{{route('realestate')}}" class="button button-dark button-large button-rounded m-0">Browse All Now</a>
                        </div>
                    </div>
                </div>

                <div class="row real-estate-properties clearfix">

                    @foreach($randomPlaces as $item)
                        <div class="col-lg-4">
                            <a href="#" style="background: url('theme/demos/real-estate/images/cities/{{randomCityImage()}}') no-repeat center center; background-size: cover;">
                                <div class="vertical-middle dark center">
                                    <div class="heading-block m-0 border-0">
                                        <h3 class="text-capitalize font-weight-medium">{{ucfirst($item->name)}}</h3>
                                        <span style="margin-top: 5px; font-size: 17px;">{{$item->realEstates->count()}} Items</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach


                </div>

            </div>

            {{--           <div class="container">--}}
            {{--               <div class="row mb-5">--}}
            {{--                   <div class="col-lg-6" style="background-color: #E5E5E5;">--}}
            {{--                       <div style="padding: 40px;">--}}
            {{--                           <h4 class="font-body font-weight-semibold ls1">Our Headquarters</h4>--}}

            {{--                           <div style="font-size: 15px; line-height: 1.7;">--}}
            {{--                               <address style="line-height: 1.7;">--}}
            {{--                                   <strong>North America:</strong><br>--}}
            {{--                                   795 Folsom Ave, Suite 600<br>--}}
            {{--                                   San Francisco, CA 94107.<br><br>--}}
            {{--                                   <abbr title="Phone Number"><strong>Phone:</strong></abbr> (1) 8547 632521<br>--}}
            {{--                                   <abbr title="Email Address"><strong>Email:</strong></abbr> real-estate@canvas.com--}}
            {{--                               </address>--}}

            {{--                               <div class="clear topmargin-sm"></div>--}}

            {{--                               <h4 class="font-body font-weight-medium" style="font-size: 17px; margin-bottom: 10px;">Working Hours:</h4>--}}

            {{--                               <abbr title="Mondays to Fridays"><strong>Mon-Fri:</strong></abbr> 10AM to 6PM<br>--}}
            {{--                               <abbr title="Saturday"><strong>Saturday:</strong></abbr> 11AM to 3PM<br>--}}
            {{--                               <abbr title="Sunday"><strong>Sunday:</strong></abbr> Closed--}}
            {{--                           </div>--}}
            {{--                       </div>--}}
            {{--                   </div>--}}
            {{--                   <div class="col-lg-6 bg-color">--}}
            {{--                       <div class="col-padding">--}}
            {{--                           <div class="quick-contact-widget form-widget dark clearfix">--}}

            {{--                               <h3 class="text-capitalize ls1 font-weight-normal">Get a Quick Quote</h3>--}}

            {{--                               <div class="form-result"></div>--}}

            {{--                               <form id="quick-contact-form" name="quick-contact-form" action="include/form.php" method="post" class="quick-contact-form mb-0">--}}

            {{--                                   <div class="form-process">--}}
            {{--                                       <div class="css3-spinner">--}}
            {{--                                           <div class="css3-spinner-scaler"></div>--}}
            {{--                                       </div>--}}
            {{--                                   </div>--}}

            {{--                                   <input type="text" class="required sm-form-control input-block-level not-dark" id="quick-contact-form-name" name="quick-contact-form-name" value="" placeholder="Full Name" />--}}

            {{--                                   <input type="email" class="required sm-form-control email input-block-level not-dark" id="quick-contact-form-email" name="quick-contact-form-email" value="" placeholder="Email Address" />--}}

            {{--                                   <input type="text" class="required sm-form-control input-block-level not-dark" id="quick-contact-form-phone" name="quick-contact-form-phone" value="" placeholder="Phone Number (+1-555-2221)" />--}}

            {{--                                   <textarea class="required sm-form-control input-block-level not-dark short-textarea" id="quick-contact-form-message" name="quick-contact-form-message" rows="5" cols="30" placeholder="What are you Looking for? (Ex: Villa on the Beach)"></textarea>--}}

            {{--                                   <input type="text" class="d-none" id="quick-contact-form-botcheck" name="quick-contact-form-botcheck" value="" />--}}
            {{--                                   <input type="hidden" name="prefix" value="quick-contact-form-">--}}

            {{--                                   <button type="submit" id="quick-contact-form-submit" name="quick-contact-form-submit" class="button button-small button-rounded button-light button-white m-0" value="submit">Send Email</button>--}}

            {{--                               </form>--}}

            {{--                           </div>--}}
            {{--                       </div>--}}
            {{--                   </div>--}}
            {{--               </div>--}}
            {{--           </div>--}}

            <div class="container">
                <div class="promo promo-dark bg-color bottommargin-lg p-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg">
                            <h3 class="font-weight-normal ls1">Start Sell !!Select A Plan </h3>
                        </div>
                    </div>
                </div>
                <div class="row pricing col-mb-30 mb-4">
                    @foreach($plans as $plan)
                        <div class="col-md-6 col-lg-4">

                            <div class="pricing-box pricing-simple px-5 py-4 bg-light text-center text-md-left">
                                <div class="pricing-title">
                                    @if($loop->first)
                                        <span class="text-primary">{{$plan->title}}</span>
                                    @elseif($loop->last)
                                        <span class="text-danger">{{$plan->title}}</span>
                                    @else
                                        <span class="text-success">{{$plan->title}}</span>
                                    @endif

                                    <h3>{{$plan->name}}</h3>
                                </div>
                                <div class="pricing-price">
                                    <span class="price-unit">{{currency()}}</span>{{$plan->price}}<span class="price-tenure">({{$plan->period  }}) monthly</span>
                                </div>
                                <div class="pricing-action">
                                    @if($loop->first)
                                        <a href="{{route('checkout.plan.show',$plan->id)}}" class="btn btn-primary btn-lg">Get Started</a>
                                    @elseif($loop->last)
                                        <a href="{{route('checkout.plan.show',$plan->id)}}" class="btn btn-danger btn-lg">Get Started</a>
                                    @else
                                        <a href="{{route('checkout.plan.show',$plan->id)}}" class="btn btn-success btn-lg">Get Started</a>
                                    @endif

                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="row col-mb-50">
                    <div class="col-md-8">

                        <div class="tabs tabs-justify tabs-tb tabs-alt mb-0 clearfix" id="realestate-tabs" data-active="2">

                            <ul class="tab-nav clearfix">
                                <li><a href="#realestate-tab-1">Why Us?</a></li>
                                <li><a href="#realestate-tab-2">Properties</a></li>
                                <li><a href="#realestate-tab-3">Legal</a></li>
                            </ul>

                            <div class="tab-container">

                                <div class="tab-content clearfix" id="realestate-tab-1">
                                    <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
                                    <div class="row col-mb-30">
                                        <div class="col-sm-6 col-lg-3 text-center">
                                            <div class="counter ls1 font-weight-semibold" style="color: #D2D2D2;"><span data-from="0" data-to="{{$total_real_states}}" data-refresh-interval="50" data-speed="2000"></span></div>
                                            <h5>Real Estates</h5>
                                        </div>

                                        <div class="col-sm-6 col-lg-3 text-center">
                                            <div class="counter ls1 font-weight-semibold" style="color: #D2D2D2;"><span data-from="0" data-to="{{$admins}}" data-refresh-interval="50" data-speed="2500"></span></div>
                                            <h5>Employees</h5>
                                        </div>

                                        <div class="col-sm-6 col-lg-3 text-center">
                                            <div class="counter ls1 font-weight-semibold" style="color: #D2D2D2;"><span data-from="0" data-to="{{$users}}" data-refresh-interval="50" data-speed="3500"></span></div>
                                            <h5>Clients Served</h5>
                                        </div>

                                        <div class="col-sm-6 col-lg-3 text-center">
                                            <div class="counter ls1 font-weight-semibold" style="color: #D2D2D2;"><span data-from="0" data-to="{{$total_states}}" data-refresh-interval="15" data-speed="2700"></span></div>
                                            <h5>Cities Served</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content clearfix" id="realestate-tab-2">
                                    <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
                                    <div class="row col-mb-30">
                                        <div class="col-sm-6 col-lg-4">
                                            <ul class="iconlist mb-0">
                                                <li><i class="icon-ok"></i> 100% Assurance</li>
                                                <li><i class="icon-ok"></i> Hard Working</li>
                                                <li><i class="icon-ok"></i> Trustworthy</li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <ul class="iconlist mb-0">
                                                <li><i class="icon-ok"></i> Intelligent</li>
                                                <li><i class="icon-ok"></i> Always Curious</li>
                                                <li><i class="icon-ok"></i> Perfectionists</li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <ul class="iconlist mb-0">
                                                <li><i class="icon-ok"></i> Friendly &amp; Helpful</li>
                                                <li><i class="icon-ok"></i> Accomodating Nature</li>
                                                <li><i class="icon-ok"></i> Available 24x7</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content clearfix" id="realestate-tab-3">

                                    <div class="row col-mb-30">
                                        <div class="col-md-7">
                                            <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor.</p>
                                            <div class="row col-mb-30">
                                                <div class="col-md-6">
                                                    <address>
                                                        <strong>Headquarters:</strong><br>
                                                        795 Folsom Ave, Suite 600<br>
                                                        San Francisco, CA 94107<br>
                                                    </address>
                                                </div>
                                                <div class="col-md-6">
                                                    <abbr title="Phone Number"><strong>Phone:</strong></abbr> (1) 8547 632521<br>
                                                    <abbr title="Fax"><strong>Fax:</strong></abbr> (1) 11 4752 1433<br>
                                                    <abbr title="Email Address"><strong>Email:</strong></abbr> info@canvas.com
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            {{--                                            <img src="https://maps.googleapis.com/maps/api/staticmap?center=-37.814107,144.963280&zoom=12&markers=-37.814107,144.963280&size=300x180" alt="Google Map" class="img-thumbnail">--}}
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <h4 class="center">Top Builders</h4>

                        <ul class="clients-grid grid-2 mb-0">
                            <li class="grid-item" style="padding: 20px;"><a href="#" class="op-09"><img src="theme/demos/real-estate/images/builders/1.png" alt="Clients"></a></li>
                            <li class="grid-item" style="padding: 20px;"><a href="#" class="op-09"><img src="theme/demos/real-estate/images/builders/2.png" alt="Clients"></a></li>
                            <li class="grid-item" style="padding: 20px;"><a href="#" class="op-09"><img src="theme/demos/real-estate/images/builders/3.png" alt="Clients"></a></li>
                            <li class="grid-item" style="padding: 20px;"><a href="#" class="op-09"><img src="theme/demos/real-estate/images/builders/4.png" alt="Clients"></a></li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </section><!-- #content end -->

@endsection
