
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

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap mb-0 pb-0">

            <div class="container clearfix">

                <div class="heading-block border-0 mw-100">
                    <h2 class="mb-4">Our Story</h2>
                    <p class="lead">Rerum morbi wisi purus illum, dolor consectetuer nulla, iusto eveniet? Fuga rem inventore scelerisque, wisi, hac illo wisi iste platea natus ante anim augue convallis. Lacinia laoreet mus quisque repellat, libero fusce, ullamco molestie taciti doloremq Iste quae possimus recusandae curae repellat.</p>
                </div>

                <div class="row clearfix">
                    <div class="col-md-4 bottommargin">
                        <div class="card">
                            <img class="card-img-top" src="{{asset('theme/demos/real-estate/images/hero/3.jpg')}}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Building</h4>
                                <p class="card-text mb-4">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 bottommargin">
                        <div class="card">
                            <img class="card-img-top" src="{{asset('theme/demos/real-estate/images/about-us/2.jpg')}}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Land</h4>
                                <p class="card-text mb-4">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 bottommargin">
                        <div class="card">
                            <img class="card-img-top" src="{{asset('theme/demos/real-estate/images/items/6.jpg')}}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Apartment</h4>
                                <p class="card-text mb-4">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="section mt-5 clearfix">
                <div class="container clearfix">
                    <div class="row mw-100 clearfix">
                        <div class="col-md-5">
                            <div class="heading-block border-bottom-0">
                                <h3 class="mb-3">What We Do</h3>
                            </div>

                            <div class="accordion accordion-bg">
                                <div class="accordion-header">
                                    <div class="accordion-icon">
                                        <i class="accordion-closed icon-ok-circle"></i>
                                        <i class="accordion-open icon-remove-circle"></i>
                                    </div>
                                    <div class="accordion-title">
                                        The way we respond
                                    </div>
                                </div>
                                <div class="accordion-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, dolorum, vero ipsum molestiae minima odio quo voluptate illum excepturi quam cum voluptates doloribus quae nisi tempore necessitatibus suscipit animi at quaerat aliquid ex expedita perspiciatis? Saepe, aperiam, nam unde quas beatae vero vitae nulla.</div>

                                <div class="accordion-header">
                                    <div class="accordion-icon">
                                        <i class="accordion-closed icon-ok-circle"></i>
                                        <i class="accordion-open icon-remove-circle"></i>
                                    </div>
                                    <div class="accordion-title">
                                        Rent A House
                                    </div>
                                </div>
                                <div class="accordion-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, dolorum, vero ipsum molestiae minima odio quo voluptate illum excepturi quam cum voluptates doloribus quae nisi tempore necessitatibus dolores ducimus enim libero eaque explicabo suscipit animi at quaerat aliquid ex expedita perspiciatis? Saepe, aperiam, nam unde quas beatae vero vitae nulla.</div>

                                <div class="accordion-header">
                                    <div class="accordion-icon">
                                        <i class="accordion-closed icon-ok-circle"></i>
                                        <i class="accordion-open icon-remove-circle"></i>
                                    </div>
                                    <div class="accordion-title">
                                        Need a Office Space
                                    </div>
                                </div>
                                <div class="accordion-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, dolorum, vero ipsum molestiae minima odio quo voluptate illum excepturi quam cum voluptates doloribus quae nisi tempore necessitatibus dolores ducimus enim libero eaque explicabo suscipit animi at quaerat aliquid ex expedita perspiciatis? Saepe, aperiam, nam unde quas beatae vero vitae nulla.</div>

                                <div class="accordion-header">
                                    <div class="accordion-icon">
                                        <i class="accordion-closed icon-ok-circle"></i>
                                        <i class="accordion-open icon-remove-circle"></i>
                                    </div>
                                    <div class="accordion-title">
                                        Sell a House
                                    </div>
                                </div>
                                <div class="accordion-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, dolorum, vero ipsum molestiae minima odio quo voluptate illum excepturi quam cum voluptates doloribus quae nisi tempore necessitatibus dolores ducimus enim libero eaque explicabo suscipit animi at quaerat aliquid ex expedita perspiciatis? Saepe, aperiam, nam unde quas beatae vero vitae nulla.</div>

                                <div class="accordion-header">
                                    <div class="accordion-icon">
                                        <i class="accordion-closed icon-ok-circle"></i>
                                        <i class="accordion-open icon-remove-circle"></i>
                                    </div>
                                    <div class="accordion-title">
                                        Our Pricing
                                    </div>
                                </div>
                                <div class="accordion-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, dolorum, vero ipsum molestiae minima odio quo voluptate illum excepturi quam cum voluptates doloribus quae nisi tempore necessitatibus dolores ducimus enim libero eaque explicabo suscipit animi at quaerat aliquid ex expedita perspiciatis? Saepe, aperiam, nam unde quas beatae vero vitae nulla.</div>
                            </div>
                        </div>
                        <div class="col-md-6 ml-auto">
                            <img src="{{asset('theme/demos/real-estate/images/about-us/3.jpg')}}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="section mb-0 clearfix" style="background-color: #fef6f3">

                <div class="container clearfix">
                    <div class="heading-block border-0 mw-100">
                        <h2 class="mb-4">Our Partners</h2>
                        <p class="lead">Rerum morbi wisi purus illum, dolor consectetuer nulla, iusto eveniet? Fuga rem inventore scelerisque, wisi, hac illo wisi iste platea natus ante anim augue convallis. Lacinia laoreet mus quisque repellat.</p>
                    </div>
                    <ul class="clients-grid grid-2 grid-sm-3 grid-md-6 mb-0">
                        <li class="grid-item" style="padding: 20px;"><a href="#" class="op-09"><img src="{{asset('theme/demos/real-estate/images/builders/1.png')}}" alt="Clients"></a></li>
                        <li class="grid-item" style="padding: 20px;"><a href="#" class="op-09"><img src="{{asset('theme/demos/real-estate/images/builders/2.png')}}" alt="Clients"></a></li>
                        <li class="grid-item" style="padding: 20px;"><a href="#" class="op-09"><img src="{{asset('theme/demos/real-estate/images/builders/3.png')}}" alt="Clients"></a></li>
                        <li class="grid-item" style="padding: 20px;"><a href="#" class="op-09"><img src="{{asset('theme/demos/real-estate/images/builders/4.png')}}" alt="Clients"></a></li>
                        <li class="grid-item" style="padding: 20px;"><a href="#" class="op-09"><img src="{{asset('theme/demos/real-estate/images/builders/1.png')}}" alt="Clients"></a></li>
                        <li class="grid-item" style="padding: 20px;"><a href="#" class="op-09"><img src="{{asset('theme/demos/real-estate/images/builders/2.png')}}" alt="Clients"></a></li>
                        <li class="grid-item" style="padding: 20px;"><a href="#" class="op-09"><img src="{{asset('theme/demos/real-estate/images/builders/3.png')}}" alt="Clients"></a></li>
                        <li class="grid-item" style="padding: 20px;"><a href="#" class="op-09"><img src="{{asset('theme/demos/real-estate/images/builders/4.png')}}" alt="Clients"></a></li>
                        <li class="grid-item" style="padding: 20px;"><a href="#" class="op-09"><img src="{{asset('theme/demos/real-estate/images/builders/1.png')}}" alt="Clients"></a></li>
                        <li class="grid-item" style="padding: 20px;"><a href="#" class="op-09"><img src="{{asset('theme/demos/real-estate/images/builders/2.png')}}" alt="Clients"></a></li>
                        <li class="grid-item" style="padding: 20px;"><a href="#" class="op-09"><img src="{{asset('theme/demos/real-estate/images/builders/3.png')}}" alt="Clients"></a></li>
                        <li class="grid-item" style="padding: 20px;"><a href="#" class="op-09"><img src="{{asset('theme/demos/real-estate/images/builders/4.png')}}" alt="Clients"></a></li>
                    </ul>
                </div>
            </div>
        </div><!-- .content-wrap end -->
    </section><!-- #content end -->

@endsection

