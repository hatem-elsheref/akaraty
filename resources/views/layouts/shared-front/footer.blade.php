
<!-- Footer
    ============================================= -->
<footer id="footer" class="dark">
    <div class="container">
        <!-- Footer Widgets
        ============================================= -->
        <div class="footer-widgets-wrap">

            <div class="row col-mb-50">
                <div class="col-lg-5 order-last order-lg-first">

                    <div class="widget clearfix">

                        <img src="{{asset('theme/demos/real-estate/images/logo@2x.png')}}" style="position: relative; opacity: 0.85; left: -10px; max-height: 80px; margin-bottom: 20px;" alt="Footer Logo">

                        <p>We believe in <strong>Simple</strong>, <strong>Creative</strong> &amp; <strong>Flexible</strong> Design Standards with a Retina &amp; Responsive Approach. Browse the amazing Features this template offers.</p>

                        <div class="line" style="margin: 30px 0;"></div>

                        <p class="ls1 font-weight-light" style="opacity: 0.6; font-size: 13px;">Copyrights &copy; 2020 Hatem Mohamed: Real Estate</p>

                    </div>

                </div>

                <div class="col-lg-7">

                    <div class="row col-mb-50">
                        <div class="col-md-6">
                            <h4 class="ls1 font-weight-normal text-uppercase">Popular Locations</h4>

                            <div class="row">
                                <div class="col-6 bottommargin-sm widget_links widget_real_estate_popular">
                                    <ul>
                                        @for($i=0;$i<7;$i++)
                                            <li><a href="{{route('state.search',$randomStates[$i]->id)}}">{{$randomStates[$i]->name}}</a></li>
                                        @endfor
                                    </ul>
                                </div>

                                <div class="col-6 bottommargin-sm widget_links widget_real_estate_popular">
                                    <ul>
                                        @for($i=7;$i<14;$i++)
                                            <li><a href="{{route('state.search',$randomStates[$i]->id)}}">{{$randomStates[$i]->name}}</a></li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h4 class="ls1 font-weight-normal text-uppercase">Connect Socially</h4>

                            <div class="bottommargin-sm clearfix">
                                <a href="#" class="social-icon si-colored si-small si-rounded si-facebook" title="Facebook">
                                    <i class="icon-facebook"></i>
                                    <i class="icon-facebook"></i>
                                </a>

                                <a href="#" class="social-icon si-colored si-small si-rounded si-twitter" title="Twitter">
                                    <i class="icon-twitter"></i>
                                    <i class="icon-twitter"></i>
                                </a>

                                <a href="#" class="social-icon si-colored si-small si-rounded si-instagram" title="Instagram">
                                    <i class="icon-instagram"></i>
                                    <i class="icon-instagram"></i>
                                </a>

                                <a href="#" class="social-icon si-colored si-small si-rounded si-apple" title="App Store">
                                    <i class="icon-apple"></i>
                                    <i class="icon-apple"></i>
                                </a>

                                <a href="#" class="social-icon si-colored si-small si-rounded si-android" title="Play Store">
                                    <i class="icon-android"></i>
                                    <i class="icon-android"></i>
                                </a>

                                <a href="#" class="social-icon si-colored si-small si-rounded si-skype" title="Skype">
                                    <i class="icon-skype"></i>
                                    <i class="icon-skype"></i>
                                </a>
                            </div>

                            <div class="widget subscribe-widgset subscribe-form clearfix" data-loader="button">
                                <form action="{{route('news_letter')}}" method="post" class="mb-0">
                                    @csrf
                                    @error('email')
                                    <p class="text-white text-bold">*{{$message}}</p>
                                    @enderror
                                    <input type="email" id="widget-subscribe-form-email" name="email" class="sm-form-control not-dark required email @error('email') is-invalid @enderror" placeholder="Enter your Email">
                                    <button class="button button-3d button-black mx-0" style="margin-top: 15px;" type="submit">Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div><!-- .footer-widgets-wrap end -->
    </div>
</footer><!-- #footer end -->

</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- JavaScripts
============================================= -->
<script src="{{asset('theme/js/jquery.js')}}"></script>
<script src="{{asset('theme/js/plugins.min.js')}}"></script>
<!-- Bootstrap Select Plugin -->
<script src="{{asset('theme/js/components/bs-select.js')}}"></script>
<!-- Bootstrap Switch Plugin -->
<script src="{{asset('theme/js/components/bs-switches.js')}}"></script>
<!-- Range Slider Plugin -->
<script src="{{asset('theme/js/components/rangeslider.min.js')}}"></script>
<!-- Footer Scripts
============================================= -->
<script src="{{asset('theme/js/functions.js')}}"></script>
<script src="{{adminAssets('js/swal.js')}}"></script>

<script>

    jQuery(document).ready(function(){

        $(".price-range-slider").ionRangeSlider({
            type: "double",
            prefix: "$",
            min: 200,
            max: 10000,
            max_postfix: "+"
        });

        $(".area-range-slider").ionRangeSlider({
            type: "double",
            min: 50,
            max: 20000,
            from: 50,
            to: 20000,
            postfix: " sqm.",
            max_postfix: "+"
        });

        jQuery(".bt-switch").bootstrapSwitch();

        jQuery('.more-search').click(function(){
            jQuery('.expand-link').slideToggle(400);
        });


    });
    function sureTheTransaction(){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, confirm it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var temporary_key='{{uniqid()}}';
                var token='{{csrf_token()}}';
                $.ajax({
                    url:'{{route('checkout.confirm')}}',
                    method:'POST',
                    dataType: 'json', // type of response data,
                    data:{'tmp_key':temporary_key,'_token':token},
                    success:function (response){
                        $('#temporary_key').val(temporary_key)
                        if(response.status){
                            $('#completeTheTransaction').submit();
                        }else{
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Try Again ..',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                });
            }
        })
    }


</script>
@yield('js')
</body>
</html>
