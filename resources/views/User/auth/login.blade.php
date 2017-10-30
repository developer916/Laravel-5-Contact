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
	                        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                                {!! Form::open(array('url' => URL::route('user.doLogin'), 'class' =>'reg-page')) !!}
                                 {!! Form::token() !!}
	                                <div class="reg-header">
	                                    <h3>Login to your account</h3>
	                                    <p>Don't Have Account? Click <a class="color-green" href="{{URL::route('user.register')}}">Sign Up</a>  to registrationto register for your account.</p>
	                                </div>
	                                <?php if (isset($alert)) { ?>
                                        <div class="alert alert-<?php echo $alert['type'];?> alert-dismissibl fade in">
                                            <button type="button" class="close" data-dismiss="alert">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <p>
                                                <?php echo $alert['msg'];?>
                                            </p>
                                        </div>
                                    <?php } ?>
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
	                                <div class="input-group margin-bottom-20">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" placeholder="User Name or Email" class="form-control" name="username">
                                    </div>
                                    <div class="input-group margin-bottom-20">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input type="password" placeholder="Password" class="form-control" name="userpassword">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-6 col-sm-6 col-sm-offset-6">
                                            <button class="btn-u pull-right" type="submit">Log In</button>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>Forget your Password ?</h4>
                                    <p>no worries, <a class="color-green" href="javascript:void(0)">click here</a>  to reset your password.</p>
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