@extends('main')
	@section('title')
		Contact Management System
	@stop
	@section('styles')
	    <link media="all" type="text/css" rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&subset=cyrillic,latin">
	    <link media="all" type="text/css" rel="stylesheet" href="/assets/shop-ui/plugins/bootstrap/css/bootstrap.min.css">
	    <link media="all" type="text/css" rel="stylesheet" href="/assets/shop-ui/css/shop.style.css">
	    <link media="all" type="text/css" rel="stylesheet" href="/assets/shop-ui/css/headers/header-v5.css">
	    <link media="all" type="text/css" rel="stylesheet" href="/assets/shop-ui/css/footers/footer-v4.css">
	    <link media="all" type="text/css" rel="stylesheet" href="/assets/shop-ui/plugins/animate.css">
	    <link media="all" type="text/css" rel="stylesheet" href="/assets/shop-ui/plugins/line-icons/line-icons.css">
	    <link media="all" type="text/css" rel="stylesheet" href="/assets/shop-ui/plugins/font-awesome/css/font-awesome.min.css">
	    <link media="all" type="text/css" rel="stylesheet" href="/assets/shop-ui/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
	    <link media="all" type="text/css" rel="stylesheet" href="/assets/shop-ui/plugins/owl-carousel/owl-carousel/owl.carousel.css">
	    <link media="all" type="text/css" rel="stylesheet" href="/assets/shop-ui/plugins/revolution-slider/rs-plugin/css/settings.css">
	    <link media="all" type="text/css" rel="stylesheet" href="/assets/shop-ui/css/custom.css">
	    <link media="all" type="text/css" rel="stylesheet" href="/assets/css/pages/page_log_reg_v1.css">
	    <link media="all" type="text/css" rel="stylesheet" href="/assets/css/forestChange.css">
	@stop
	@section('content')
	    <body class="header-fixed">
	        <div class="wrapper">
	            <div class="registerBackground">
	                <div class="container content">
	                    <div class="row">
	                        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
	                           {!! Form::open(array('url' => URL::route('user.store'), 'class' =>'reg-page')) !!}
	                           @if ($errors->has())
                                   <div class="alert alert-danger alert-dismissibl fade in">
                                       <button type="button" class="close" data-dismiss="alert">
                                           <span aria-hidden="true">&times;</span>
                                           <span class="sr-only">Close</span>
                                       </button>
                                       @foreach ($errors->all() as $error)
                                           {!! $error !!}
                                       @endforeach
                                   </div>
                                   @endif
	                               {!! Form::token() !!}
	                                <div class="reg-header">
	                                     <h2>Register a new account</h2>
                                          <p>Already Signed Up? Click <a href="{{URL::route('user.login')}}" class="color-green">Sign In</a> to login your account.</p>
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-6 col-sm-6">
	                                        <label>First Name</label>
	                                        <input type="text" class="form-control margin-bottom-20" placeholder="First Name" name="firstname">
	                                    </div>
	                                    <div class="col-md-6 col-sm-6">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control margin-bottom-20" placeholder="Last Name" name="lastname">
                                        </div>
	                                </div>
	                                <label>Email</label>
	                                <input type="email" class="form-control margin-bottom-20" placeholder="Email" name="email">
	                                <label>User Name</label>
	                                <input type="text" class="form-control margin-bottom-20" placeholder="User Name" name="username">
	                                <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <label>Password</label>
                                            <input type="password" class="form-control margin-bottom-20" placeholder="Password" name="password">
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control margin-bottom-20" placeholder="Confirm Password" name="password_confirmation">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <input type="submit" class="btn-u" value="Sign Up">
                                        </div>
                                    </div>
	                            {!! Form::close() !!}
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </body>
	@stop
	@section ('scripts')
             <script src="/assets/shop-ui/plugins/jquery/jquery.min.js"></script>
             <script src="/assets/shop-ui/plugins/jquery/jquery-migrate.min.js"></script>
             <script src="/assets/shop-ui/plugins/bootstrap/js/bootstrap.min.js"></script>
             <script src="/assets/shop-ui/plugins/back-to-top.js"></script>
             <script src="/assets/shop-ui/plugins/smoothScroll.js"></script>
             <script src="/assets/shop-ui/plugins/jquery.parallax.js"></script>
             <script src="/assets/shop-ui/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
             <script src="/assets/shop-ui/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
             <script src="/assets/shop-ui/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
             <script src="/assets/shop-ui/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
             <script src="/assets/shop-ui/js/custom.js"></script>
             <script src="/assets/shop-ui/js/shop.app.js"></script>
             <script src="/assets/shop-ui/js/plugins/owl-carousel.js"></script>
             <script src="/assets/shop-ui/js/plugins/revolution-slider.js"></script>
             <script src="/assets/js/bootbox.js"></script>
            <script>
                jQuery(document).ready(function() {
                    App.init();
                    App.initScrollBar();
                    App.initParallaxBg();
                    OwlCarousel.initOwlCarousel();
                    RevolutionSlider.initRSfullWidth();
                });
            </script>
    @stop
@stop