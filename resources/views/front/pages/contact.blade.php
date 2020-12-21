@extends('layouts.frontend-master')
@section('css')
    <style>
        .contact-section {
            position: absolute;
            display: block;
            top: 0;
            right: 0;
            width: 50%;
            padding: 60px 60px 60px 180px;
            z-index: 0;
        }
        .contact-image {
            position: relative;
            width: 60%;
            margin-top: 30px;
            z-index: 2;
            box-shadow: 0 0 40px rgba(0,0,0,.3);
        }
        @media (max-width: 991px) {
            .contact-section {
                position: relative;
                display: block;
                width: 100%;
                padding: 20px;
            }
            .contact-image {
                width: 100%;
                margin-top: 0;
            }
        }
    </style>

    @endsection
@section('content')

    <!-- Page Title
    ============================================= -->
    <section id="page-title" class="page-title-parallax page-title-dark page-title-center include-header include-topbar" style="background: url('{{asset('theme/demos/real-estate/images/contact/page-title.jpg')}}') no-repeat center center / cover; padding: 160px 0;" data-center="background-position: 0px 50%;" data-top-bottom="background-position:0px 0%;">

        <div class="container clearfix">
            <h1>Contact</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('website')}}">Home</a></li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>
        </div>

        <div class="video-wrap" style="position: absolute; top: 0; left: 0; height: 100%; z-index:1;">
            <div class="video-overlay" style="background: rgba(0,0,0,0.6);"></div>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">

                <div style="position: relative;">
                    <img src="{{asset('theme/demos/real-estate/images/contact/1.jpg')}}" alt="Image" class="contact-image">
                    <div class="contact-section dark bg-color">
                        <div class="p-5 p-lg-0" style="font-size: 15px; line-height: 1.7;">
                            <address style="line-height: 1.7;">
                                <span class="font-weight-light">Address:</span><br>
                                <span class="h6 text-white ls1 font-weight-normal">
									North America<br>
									795 Folsom Ave, Suite 600<br>
									San Francisco, CA 94107.
								</span>
                            </address>
                            <span class="font-weight-light">Phone Number:</span><br>
                            <a href="tel:(1)(8547)632521" class="h6 text-white ls1 font-weight-normal">(1) 8547 632521</a><br><br>

                            <span class="font-weight-light">Email:</span><br>
                            <a href="mailto:no-reply@semicolonweb.com?Subject=Hello%20again" class="h6 text-white ls1 font-weight-normal">no-reply@semicolonweb.com</a>
                        </div>
                    </div>
                </div>
                <div class="clear topmargin"></div>

                <div class="row align-items-stretch mx-0 topmargin-lg" style="box-shadow: 0 0 40px rgba(0,0,0,.06)">
                    <div class="col-md-12">
                        <div class="col-padding">
                            <div class="quick-contact-widget form-widget clearfix">

                                <h3 class="text-capitalize ls1 font-weight-normal">Contact Us</h3>

                                <div class="form-result"></div>

                                <form id="quick-contact-form" name="quick-contact-form" action="{{route('contact.send')}}" method="post" class="quick-contact-form mb-0">
                                    @csrf
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
        </div><!-- .content-wrap end -->
    </section><!-- #content end -->

@endsection

