@extends('layouts.frontend-master')
@section('content')
    <!-- Page Title
    ============================================= -->
    <section id="page-title" class="page-title-parallax page-title-dark page-title-center include-header include-topbar" style="background: url('{{asset('theme/demos/real-estate/images/contact/page-title.jpg')}}') no-repeat center center / cover; padding: 160px 0;" data-center="background-position: 0px 50%;" data-top-bottom="background-position:0px 0%;">

        <div class="container clearfix">
            <h1>My Account</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">My Account</li>
            </ol>
        </div>

        <div class="video-wrap" style="position: absolute; top: 0; left: 0; height: 100%; z-index:1;">
            <div class="video-overlay" style="background: rgba(0,0,0,0.6);"></div>
        </div>

    </section><!-- #page-title end -->

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">

                <div class="row clearfix">

                    <div class="col-md-12">

                        <img src="{{uploadedAssets(auth()->user()->image)}}" class="alignleft img-circle img-thumbnail my-0" alt="Avatar" style="max-width: 80px;max-height:80px;width: 80px;height: 80px">

                        <div class="heading-block border-0">
                            <h3>{{auth()->user()->name}}</h3>
                            <span>Role : {{auth()->user()->role}}  @if(auth()->user()->role == OWNER)  / Plan : {{auth()->user()->plan->name}}@endif</span>


                        </div>

                        <div class="clear"></div>

                        <div class="row clearfix">

                            <div class="col-lg-12">

                                <div class="tabs tabs-alt clearfix ui-tabs ui-corner-all ui-widget ui-widget-content" id="tabs-profile">

                                    <ul class="tab-nav clearfix ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header" role="tablist">
{{--                                        <li role="tab" tabindex="0" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active" aria-controls="tab-feeds" aria-labelledby="ui-id-1" aria-selected="true" aria-expanded="true"><a href="#tab-feeds" role="presentation" tabindex="-1" class="ui-tabs-anchor" id="ui-id-1"><i class="icon-rss2"></i> MY Orders</a></li>--}}
                                        <li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab" aria-controls="tab-posts" aria-labelledby="ui-id-2" aria-selected="false" aria-expanded="false"><a href="#tab-posts" role="presentation" tabindex="-1" class="ui-tabs-anchor" id="ui-id-2"><i class="icon-pencil2"></i> Information</a></li>
                                        <li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab" aria-controls="tab-replies" aria-labelledby="ui-id-3" aria-selected="false" aria-expanded="false"><a href="#tab-replies" role="presentation" tabindex="-1" class="ui-tabs-anchor" id="ui-id-3"><i class="icon-user-secret"></i> Security</a></li>
                                    </ul>

                                    <div class="tab-container">

{{--                                        <div class="tab-content clearfix ui-tabs-panel ui-corner-bottom ui-widget-content" id="tab-feeds" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="false" style="">--}}

{{--                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium harum ea quo! Nulla fugiat earum, sed corporis amet iste non, id facilis dolorum, suscipit, deleniti ea. Nobis, temporibus magnam doloribus. Reprehenderit necessitatibus esse dolor tempora ea unde, itaque odit. Quos.</p>--}}

{{--                                            <table class="table table-bordered table-striped">--}}
{{--                                                <thead>--}}
{{--                                                <tr>--}}
{{--                                                    <th>Time</th>--}}
{{--                                                    <th>Activity</th>--}}
{{--                                                </tr>--}}
{{--                                                </thead>--}}
{{--                                                <tbody>--}}
{{--                                                <tr>--}}
{{--                                                    <td>--}}
{{--                                                        <code>5/23/2021</code>--}}
{{--                                                    </td>--}}
{{--                                                    <td>Payment for VPS2 completed</td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <td>--}}
{{--                                                        <code>5/23/2021</code>--}}
{{--                                                    </td>--}}
{{--                                                    <td>Logged in to the Account at 16:33:01</td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <td>--}}
{{--                                                        <code>5/22/2021</code>--}}
{{--                                                    </td>--}}
{{--                                                    <td>Logged in to the Account at 09:41:58</td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <td>--}}
{{--                                                        <code>5/21/2021</code>--}}
{{--                                                    </td>--}}
{{--                                                    <td>Logged in to the Account at 17:16:32</td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <td>--}}
{{--                                                        <code>5/18/2021</code>--}}
{{--                                                    </td>--}}
{{--                                                    <td>Logged in to the Account at 22:53:41</td>--}}
{{--                                                </tr>--}}
{{--                                                </tbody>--}}
{{--                                            </table>--}}

{{--                                        </div>--}}
                                        <div class="tab-content clearfix ui-tabs-panel ui-corner-bottom ui-widget-content" id="tab-posts" aria-labelledby="ui-id-2" role="tabpanel" style="display: none;" aria-hidden="true">
                                            <div class="row gutter-40 posts-md mt-4">

                                                <div class="col-lg-12">

                                                    <div class="fancy-title title-border">
                                                        <h3>General Information</h3>
                                                    </div>

                                                    <div class="form-widget">

                                                        <div class="form-result"></div>
                                                            <form method="POST" class="mb-0" action="{{ route('account.information') }}" enctype="multipart/form-data" novalidate="novalidate">
                                                                @csrf
                                                                @method('put')
                                                                <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label for="name">Name <small>*</small></label>
                                                                    <input type="text" id="name" name="name" value="{{auth()->user()->name}}" class="sm-form-control required" required autocomplete="name" autofocus>
                                                                    @error('name')
                                                                    <span class="text-danger" style="font-size: small" role="alert">
                                                                         <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label for="email">Email <small>*</small></label>
                                                                    <input type="email" id="email" name="email" value="{{auth()->user()->email}}" class="required email sm-form-control">
                                                                    @error('email')
                                                                    <span class="text-danger" style="font-size: small" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                   </span>
                                                                    @enderror
                                                                </div>

                                                                    <div class="col-md-6 form-group">
                                                                        <label for="phone">Phone <small>*</small></label>
                                                                        <input type="text" id="phone" name="phone" value="{{auth()->user()->phone}}" class="required  sm-form-control">
                                                                        @error('email')
                                                                        <span class="text-danger" style="font-size: small" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                   </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-6 form-group">
                                                                        <label for="image">Image <span>*</span></label>
                                                                        <input id="image" class="form-control" type="file" name="image">
                                                                        @error('image')
                                                                        <span class="text-danger" style="font-size: small" role="alert">
                                                                             <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                        <img id="tmp_image" src="{{uploadedAssets(auth()->user()->image)}}" width="45px" height="45px" onclick="document.getElementById('image').click()">
                                                                    </div>
                                                                <div class="w-100"></div>

                                                                <div class="col-12 form-group">
                                                                    <button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="button button-3d m-0">Save</button>
                                                                </div>
                                                            </div>


                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-content clearfix ui-tabs-panel ui-corner-bottom ui-widget-content" id="tab-replies" aria-labelledby="ui-id-3" role="tabpanel" style="display: none;" aria-hidden="true">
                                            <div class="row gutter-40 posts-md mt-4">

                                                <div class="col-lg-12">

                                                    <div class="fancy-title title-border">
                                                        <h3>Security Information</h3>
                                                    </div>

                                                    <div class="form-widget">

                                                        <div class="form-result"></div>
                                                        <form method="POST" class="mb-0" action="{{ route('account.password') }}"  novalidate="novalidate">
                                                            @csrf
                                                            @method('put')
                                                            <div class="row">
                                                                <div class="col-md-12 form-group">
                                                                    <label for="old_password">Old Password <small>*</small></label>
                                                                    <input type="password" id="old_password" name="old_password" class="sm-form-control required" required autocomplete="old_password" autofocus>
                                                                    @error('old_password')
                                                                    <span class="text-danger" style="font-size: small" role="alert">
                                                                         <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <label for="password">Password <small>*</small></label>
                                                                    <input type="password" id="password" name="password" class="sm-form-control required" required autocomplete="password" >
                                                                    @error('password')
                                                                    <span class="text-danger" style="font-size: small" role="alert">
                                                                         <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-md-12 form-group">
                                                                    <label for="password-confirm">Confirm Password <small>*</small></label>
                                                                    <input type="password" id="password-confirm" name="password_confirmation" class="sm-form-control required" required autocomplete="new-password" >
                                                                </div>
                                                                <div class="w-100"></div>
                                                                <div class="col-12 form-group">
                                                                    <button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="button button-3d m-0">Reset</button>
                                                                </div>
                                                            </div>


                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>




                </div>

            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#tmp_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#image").change(function() {
            readURL(this);
        });
    </script>
@endsection
