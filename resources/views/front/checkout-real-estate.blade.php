@extends('layouts.frontend-master')

@section('js')
    <script>
        $(document).ready(function (){
           let price=$('#real-estate-price').val();
           if (Number.isInteger(Math.abs(Math.ceil(price)))){
               $('#months').on('keyup',function (){
                   let months=$(this).val();
                   let total=months*price;
                   $('#put-price-here').text(total);
               });
           }else{
               alert('Enter A Valid Value For Months')
           }

        });
    </script>
@endsection
@section('content')
    <!-- Page Title
    ============================================= -->
    <section id="page-title" class="page-title-parallax page-title-dark page-title-center include-header include-topbar" style="background: url('{{asset('theme/demos/real-estate/images/about-us/page-title.jpg')}}') no-repeat center center / cover; padding: 140px 0;" data-center="background-position: 0px 50%;" data-top-bottom="background-position:0px 0px;">

        <div class="container clearfix">
            <h1>Checkout</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('website')}}">Home</a></li>
                <li class="breadcrumb-item active">Booking-Buying</li>
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
                        @if(session('response'))
                            <div class="alert alert-{{session('response')['type']}}">{{session('response')['message']}}</div>

                        @endif
                        <h3>Billing</h3>
                        <form   class="row mb-0" action="{{route('booking.checkout.process')}}" method="post">
                            @csrf
                            <input type="hidden" name="real_estate_id" value="{{$realEstate->id}}">
                            <input type="hidden" name="price" id="real-estate-price" value="{{$realEstate->price}}">
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

                            @if($realEstate->type == 'land')
                                <div class="col-md-6 form-group">
                                    <label for="category">Category:</label>
                                    <select id="category" name="category" class="sm-form-control" disabled>
                                        <option value="buy" selected disabled>Buy</option>
                                    </select>
                                    <span class="text-danger"> @error('category') {{$message}} @enderror</span>
                                </div>
                                @elseif($realEstate->category == 'rent')
                                <div class="col-md-6 form-group">
                                    <label for="category">Category:</label>
                                    <select id="category" name="category" class="sm-form-control" disabled>
                                        <option value="rent" disabled selected>Rent</option>
                                    </select>
                                    <span class="text-danger"> @error('category') {{$message}} @enderror</span>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="months">Months:</label>
                                    <input type="number" min="1" step="1" id="months" name="months" value="{{old('months')}}" class="sm-form-control">
                                    <span class="text-danger"> @error('months') {{$message}} @enderror</span>
                                </div>
                            @else
                                <div class="col-md-6 form-group">
                                    <label for="category">Category:</label>
                                    <select id="category" name="category" class="sm-form-control" disabled>
                                        <option value="buy" disabled selected>Buy</option>
                                    </select>
                                    <span class="text-danger"> @error('category') {{$message}} @enderror</span>
                                </div>
                            @endif
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
                                <button type="submit" class="sm-form-control button button-3d float-right text-light">Process</button>
                            </div>


                        </form>
                    </div>

                    <div class="col-lg-6">
                        <h4>Real Estate Details</h4>

                        <div class="table-responsive">
                            <table class="table cart">
                                <tbody>
                                <tr class="cart_item">
                                    <td class="border-top-0 cart-product-name"><strong>Real Estate Name</strong></td>
                                    <td class="border-top-0 cart-product-name"><span>{{$realEstate->title}}</span></td>
                                </tr>


                                <tr class="cart_item">
                                    <td class="border-top-0 cart-product-name"><strong>Real Estate Owner</strong></td>
                                    <td class="border-top-0 cart-product-name"><span>{{$realEstate->owner->name}}</span></td>
                                </tr>
                                @if($realEstate->category == 'rent')
                                    <tr class="cart_item">
                                        <td class="border-top-0 cart-product-name"><strong>Real Estate Price/Month</strong></td>
                                        <td class="border-top-0 cart-product-name"><span>{{$realEstate->price}} </span>{{ currency()}}</td>
                                    </tr>
                                @else
                                    <tr class="cart_item">
                                        <td class="border-top-0 cart-product-name"><strong>Real Estate Buying Price</strong></td>
                                        <td class="border-top-0 cart-product-name"><span>{{$realEstate->price}} </span>{{ currency()}}</td>
                                    </tr>
                                @endif
                                <tr class="cart_item">
                                    <td class="border-top-0 cart-product-name"><strong>Real Estate Total Price</strong></td>
                                    <td class="border-top-0 cart-product-name"><span id="put-price-here">0</span> {{currency()}}</td>
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
