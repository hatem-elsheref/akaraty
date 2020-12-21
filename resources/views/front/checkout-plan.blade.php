@extends('layouts.frontend-master')
@section('content')
    <!-- Page Title
    ============================================= -->
    <section id="page-title" class="page-title-parallax page-title-dark page-title-center include-header include-topbar" style="background: url('{{asset('theme/demos/real-estate/images/about-us/page-title.jpg')}}') no-repeat center center / cover; padding: 140px 0;" data-center="background-position: 0px 50%;" data-top-bottom="background-position:0px 0px;">

        <div class="container clearfix">
            <h1>Checkout</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('website')}}">Home</a></li>
                <li class="breadcrumb-item active">Select Plan</li>
            </ol>
        </div>

        <div class="video-wrap" style="position: absolute; top: 0; left: 0; height: 100%; z-index:1;">
            <div class="video-overlay" style="background: rgba(0,0,0,0.3);"></div>
        </div>

    </section><!-- #page-title end -->

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">
                <div class="row col-mb-50 gutter-50">
                    <div class="col-lg-6">
                        @if(session('message'))
                            <div class="alert alert-{{session('message')['type']}}">{{session('message')['content']}}</div>

                        @endif
                            <h3>Billing</h3>
                        <form id="completeTheTransaction" name="billing-form" class="row mb-0" action="{{route('checkout.plan',$plan->id)}}" method="post">
                            @csrf
                            <input type="hidden" name="plan_id" value="{{$plan->id}}">
                            <input type="hidden" name="tmp_key" id="temporary_key">
                            <div class="col-md-6 form-group">
                                <label for="first_name">First Name:</label>
                                <input type="text" id="first_name" name="first_name" value="{{old('first_name')}}" class="sm-form-control">
                                <span class="text-danger"> @error('first_name') {{$message}} @enderror</span>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="{{old('last_name')}}">Last Name:</label>
                                <input type="text" id="last_name" name="last_name" value="{{old('last_name')}}" class="sm-form-control">
                                <span class="text-danger"> @error('last_name') {{$message}} @enderror</span>
                            </div>

                            <div class="w-100"></div>
                            <div class="col-md-6 form-group">
                                <label for="country">Country:</label>
                                <select id="country" name="country" class="sm-form-control">
                                   @foreach($countries as $country)
                                        <option value="{{$country->name}}" {{$country->name==old('country')?'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger"> @error('country') {{$message}} @enderror</span>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="postcode">Postcode:</label>
                                <input type="number" id="postcode" name="postcode" value="{{old('postcode')}}" class="sm-form-control">
                                <span class="text-danger"> @error('postcode') {{$message}} @enderror</span>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-12 form-group">
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address" value="{{old('address')}}" class="sm-form-control">
                                <span class="text-danger"> @error('address') {{$message}} @enderror</span>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="email">Email Address:</label>
                                <input type="email" id="email" name="email" value="{{old('email')}}" class="sm-form-control">
                                <span class="text-danger"> @error('email') {{$message}} @enderror</span>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" id="phone" name="phone" value="{{old('phone')}}" class="sm-form-control">
                                <span class="text-danger"> @error('phone') {{$message}} @enderror</span>
                            </div>

                            <div class="w-100"></div>
                            <div class="col-md-6 form-group">
                                <label for="method">Payment Method:</label>
                                <select id="gateway" name="gateway" class="sm-form-control">
                                    <option disabled selected>__SELECT_METHOD__</option>
                                    <option value="cod" {{'cod'==old('gateway')?'selected':''}}>Cache On Delivery</option>
                                    <option value="gateway" {{'gateway'==old('gateway')?'selected':''}}>Gateway</option>
                                </select>
                                <span class="text-danger"> @error('gateway') {{$message}} @enderror</span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="process">Process:</label>
                                @if(is_null(auth()->user()->plan_id))
                                    <button type="submit" class="sm-form-control button button-3d float-right text-light">Process</button>
                                @else
                                    <button id="processTheTransactionBtn" onclick="sureTheTransaction();return false;" class="sm-form-control button button-3d float-right text-light">Process</button>
                                @endif

                            </div>


                        </form>
                    </div>

                    <div class="col-lg-6">
                        <h4>Plan Details</h4>

                        <div class="table-responsive">
                            <table class="table cart">
                                <tbody>
                                <tr class="cart_item">
                                    <td class="border-top-0 cart-product-name"><strong>Plan Name</strong></td>
                                    <td class="border-top-0 cart-product-name"><span>{{$plan->name}}</span></td>
                                </tr>
                                <tr class="cart_item">
                                    <td class="border-top-0 cart-product-name"><strong>Plan Period</strong></td>
                                    <td class="border-top-0 cart-product-name"><span>{{$plan->period}} Months</span></td>
                                </tr>
                                <tr class="cart_item">
                                    <td class="border-top-0 cart-product-name"><strong>Plan Price</strong></td>
                                    <td class="border-top-0 cart-product-name"><span>{{currency().' '.$plan->price}}</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="accordion clearfix">

                            <div class="accordion-content clearfix" style="display: block;">Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</div>

                            <div class="accordion-header">
                                <div class="accordion-icon">
                                    <i class="accordion-closed icon-line-minus"></i>
                                    <i class="accordion-open icon-line-check"></i>
                                </div>
                                <div class="accordion-title">
                                    Cache On Delivery
                                </div>
                            </div>
                            <div class="accordion-content clearfix" style="display: none;">Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.</div>

                            <div class="accordion-header">
                                <div class="accordion-icon">
                                    <i class="accordion-closed icon-line-minus"></i>
                                    <i class="accordion-open icon-line-check"></i>
                                </div>
                                <div class="accordion-title">
                                    Payment Gateway
                                </div>
                            </div>
                            <div class="accordion-content clearfix" style="display: none;">Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur.</div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection
