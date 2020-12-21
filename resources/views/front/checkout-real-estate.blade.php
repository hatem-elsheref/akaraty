@extends('layouts.frontend-master')
@section('content')
    <!-- Page Title
    ============================================= -->
    <section id="page-title" class="page-title-parallax page-title-dark page-title-center include-header include-topbar" style="background: url('{{asset('theme/demos/real-estate/images/about-us/page-title.jpg')}}') no-repeat center center / cover; padding: 140px 0;" data-center="background-position: 0px 50%;" data-top-bottom="background-position:0px 0px;">

        <div class="container clearfix">
            <h1>About Us</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('website')}}">Home</a></li>
                <li class="breadcrumb-item active">About Us</li>
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
                        <h3>Billing</h3>
                        <form id="billing-form" name="billing-form" class="row mb-0" action="#" method="post">
                            <div class="col-md-6 form-group">
                                <label for="first_name">First Name:</label>
                                <input type="text" id="first_name" name="first_name" value="{{old('first_name')}}" class="sm-form-control">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="{{old('last_name')}}">Last Name:</label>
                                <input type="text" id="last_name" name="last_name" value="{{old('last_name')}}" class="sm-form-control">
                            </div>

                            <div class="w-100"></div>
                            <div class="col-md-6 form-group">
                                <label for="country">Country:</label>
                                <select id="country" name="country" class="sm-form-control">
                                    @foreach($countries as $country)
                                        <option value="{{$country->name}}" {{$country->name==old('country')?'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="postcode">Postcode:</label>
                                <input type="number" id="postcode" name="postcode" value="{{old('postcode')}}" class="sm-form-control">
                            </div>
                            <div class="w-100"></div>
                            <div class="col-12 form-group">
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address" value="{{old('address')}}" class="sm-form-control">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="email">Email Address:</label>
                                <input type="email" id="email" name="email" value="{{old('email')}}" class="sm-form-control">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" id="phone" name="phone" value="{{old('phone')}}" class="sm-form-control">
                            </div>

                            <div class="w-100"></div>
                            <div class="col-md-6 form-group">
                                <label for="method">Payment Method:</label>
                                <select id="method" name="method" class="sm-form-control">
                                    <option value="cod" {{'cod'==old('method')?'selected':''}}>Cache On Delivery</option>
                                    <option value="gateway" {{'gateway'==old('method')?'selected':''}}>Gateway</option>
                                </select>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-6">
                        <h3>Shipping Address</h3>

                        <form id="shipping-form" name="shipping-form" class="row mb-0" action="#" method="post">

                            <div class="col-md-6 form-group">
                                <label for="shipping-form-name">Name:</label>
                                <input type="text" id="shipping-form-name" name="shipping-form-name" value="" class="sm-form-control">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="shipping-form-lname">Last Name:</label>
                                <input type="text" id="shipping-form-lname" name="shipping-form-lname" value="" class="sm-form-control">
                            </div>

                            <div class="w-100"></div>

                            <div class="col-12 form-group">
                                <label for="shipping-form-companyname">Company Name:</label>
                                <input type="text" id="shipping-form-companyname" name="shipping-form-companyname" value="" class="sm-form-control">
                            </div>

                            <div class="col-12 form-group">
                                <label for="shipping-form-address">Address:</label>
                                <input type="text" id="shipping-form-address" name="shipping-form-address" value="" class="sm-form-control">
                            </div>

                            <div class="col-12 form-group">
                                <input type="text" id="shipping-form-address2" name="shipping-form-adress" value="" class="sm-form-control">
                            </div>

                            <div class="col-12 form-group">
                                <label for="shipping-form-city">City / Town</label>
                                <input type="text" id="shipping-form-city" name="shipping-form-city" value="" class="sm-form-control">
                            </div>

                            <div class="col-12 form-group">
                                <label for="shipping-form-message">Notes <small>*</small></label>
                                <textarea class="sm-form-control" id="shipping-form-message" name="shipping-form-message" rows="6" cols="30"></textarea>
                            </div>

                        </form>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-lg-6">
                        <h4>Your Orders</h4>

                        <div class="table-responsive">
                            <table class="table cart">
                                <thead>
                                <tr>
                                    <th class="cart-product-thumbnail">&nbsp;</th>
                                    <th class="cart-product-name">Product</th>
                                    <th class="cart-product-quantity">Quantity</th>
                                    <th class="cart-product-subtotal">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="cart_item">
                                    <td class="cart-product-thumbnail">
                                        <a href="#"><img src="images/shop/thumbs/small/dress-3.jpg" alt="Pink Printed Dress" width="64" height="64"></a>
                                    </td>

                                    <td class="cart-product-name">
                                        <a href="#">Pink Printed Dress</a>
                                    </td>

                                    <td class="cart-product-quantity">
                                        <div class="quantity clearfix">
                                            1x2
                                        </div>
                                    </td>

                                    <td class="cart-product-subtotal">
                                        <span class="amount">$39.98</span>
                                    </td>
                                </tr>
                                <tr class="cart_item">
                                    <td class="cart-product-thumbnail">
                                        <a href="#"><img src="images/shop/thumbs/small/shoes-2.jpg" alt="Checked Canvas Shoes" width="64" height="64"></a>
                                    </td>

                                    <td class="cart-product-name">
                                        <a href="#">Checked Canvas Shoes</a>
                                    </td>

                                    <td class="cart-product-quantity">
                                        <div class="quantity clearfix">
                                            1x1
                                        </div>
                                    </td>

                                    <td class="cart-product-subtotal">
                                        <span class="amount">$24.99</span>
                                    </td>
                                </tr>
                                <tr class="cart_item">
                                    <td class="cart-product-thumbnail">
                                        <a href="#"><img src="images/shop/thumbs/small/tshirt-2.jpg" alt="Pink Printed Dress" width="64" height="64"></a>
                                    </td>

                                    <td class="cart-product-name">
                                        <a href="#">Blue Men Tshirt</a>
                                    </td>

                                    <td class="cart-product-quantity">
                                        <div class="quantity clearfix">
                                            1x3
                                        </div>
                                    </td>

                                    <td class="cart-product-subtotal">
                                        <span class="amount">$41.97</span>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <h4>Cart Totals</h4>

                        <div class="table-responsive">
                            <table class="table cart">
                                <tbody>
                                <tr class="cart_item">
                                    <td class="border-top-0 cart-product-name">
                                        <strong>Cart Subtotal</strong>
                                    </td>

                                    <td class="border-top-0 cart-product-name">
                                        <span class="amount">$106.94</span>
                                    </td>
                                </tr>
                                <tr class="cart_item">
                                    <td class="cart-product-name">
                                        <strong>Shipping</strong>
                                    </td>

                                    <td class="cart-product-name">
                                        <span class="amount">Free Delivery</span>
                                    </td>
                                </tr>
                                <tr class="cart_item">
                                    <td class="cart-product-name">
                                        <strong>Total</strong>
                                    </td>

                                    <td class="cart-product-name">
                                        <span class="amount color lead"><strong>$106.94</strong></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="accordion clearfix">
                            <div class="accordion-header accordion-active">
                                <div class="accordion-icon">
                                    <i class="accordion-closed icon-line-minus"></i>
                                    <i class="accordion-open icon-line-check"></i>
                                </div>
                                <div class="accordion-title">
                                    Direct Bank Transfer
                                </div>
                            </div>
                            <div class="accordion-content clearfix" style="display: block;">Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</div>

                            <div class="accordion-header">
                                <div class="accordion-icon">
                                    <i class="accordion-closed icon-line-minus"></i>
                                    <i class="accordion-open icon-line-check"></i>
                                </div>
                                <div class="accordion-title">
                                    Cheque Payment
                                </div>
                            </div>
                            <div class="accordion-content clearfix" style="display: none;">Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.</div>

                            <div class="accordion-header">
                                <div class="accordion-icon">
                                    <i class="accordion-closed icon-line-minus"></i>
                                    <i class="accordion-open icon-line-check"></i>
                                </div>
                                <div class="accordion-title">
                                    Paypal
                                </div>
                            </div>
                            <div class="accordion-content clearfix" style="display: none;">Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur.</div>
                        </div>
                        <a href="#" class="button button-3d float-right">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
