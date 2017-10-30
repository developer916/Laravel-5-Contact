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
        	    <div class="header-v5 header-static">
        	        <div class="topbar-v3">
                        <div class="search-open">
                            <div class="container">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="search-close"><i class="icon-close"></i></div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- Topbar Navigation -->
                                    <ul class="left-topbar">
                                        <li>
                                           <a href="javascript:void(0)" style="text-transform: none;"><?php echo ucwords(('Hello'). " ". $member->username); ?></a>
                                        </li>
                                    </ul><!--/end left-topbar-->
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-inline right-topbar pull-right">
                                        <li><a href="{{URL::route('user.doLogout')}}">Log out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- menu -->
                    <div class="navbar navbar-default mega-menu" role="navigation">
                        <div class="container">
                             <?php if(isset($pageNo)){
                                    if($pageNo == 4 || $pageNo== 5 || $pageNo ==6 || $pageNo == 7){
                              ?>
                                <div class="col-md-3" style="margin-top: 15px">
                              <?php } }else{ ?>
                              <div class="col-md-3">
                              <?php } ?>
                                <a href="{{URL::route('user.newContact')}}" class="display-inlineblock tooltips"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Contact New">
                                    <img src="/images/add contact.png" class="layout-image">
                                </a>
                               <a href="{{URL::route('user.contact.searchContact')}}" class="display-inlineblock tooltips"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Contact Search">
                                    <img src="/images/search.png" class="layout-image">
                                </a>
                                <a href="{{URL::route('user.contact.noteContact')}}" class="display-inlineblock tooltips"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Note Search">
                                    <img src="/images/task-notes-icon.png" class="layout-image">
                                </a>
                                <a href="{{URL::route('user.company.addCompany')}}" class="display-inlineblock tooltips"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Company New">
                                    <img src="/images/list_ingredients.png" class="layout-image">
                                </a>
                            </div>
                            <?php if(isset($pageNo)){
                                    if($pageNo == 4 || $pageNo == 7){
                                ?>
                                    <div class="col-md-9" style="margin-top: 10px">
                                        <div class="row">
                                            <div class="col-md-12">
                                                    <form action="{{URL::route('user.contact.searchMainNote')}}" method="post" id="searchMainForm">
                                                         {!! Form::token() !!}
                                                        <div class="row">
                                                               <div class="col-md-3">
                                                                    <div class="form-group">
                                                                       <label>Search Note</label>
                                                                        <input type="text" class="form-control" name="searchNoteName" id="searchNoteName">
                                                                   </div>
                                                               </div>
                                                               <div class="col-md-3">
                                                                    <div class="form-group">
                                                                       <label>Type</label>
                                                                       <select name="searchType" class="form-control" id="searchType">
                                                                             <option value ="">Select Type</option>
                                                                            @foreach($noteType as $key=>$value)
                                                                               <option value="{{$value->id}}">{{$value->notesType}}</option>
                                                                            @endforeach
                                                                       </select>
                                                                   </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                   <div class="form-group">
                                                                      <label>Comm Type</label>
                                                                      <select name="searchCommType" class="form-control" id="searchCommType">
                                                                            <option value ="">Select Comm Type</option>
                                                                             @foreach($noteCommType as $key=>$value)
                                                                                <option value="{{$value->id}}">{{$value->noteCommType}}</option>
                                                                             @endforeach
                                                                      </select>
                                                                  </div>
                                                              </div>
                                                              <div class="col-md-2">
                                                                    <div class="form-group" >
                                                                        <input name="peopleId" value="{{$people->id}}" type="hidden">
                                                                        <a href="javascript:void(0)" class="btn-u btn-u-blue" value="" onclick="onSearchNote()" style="margin-top: 25px;">Search</a>
                                                                    </div>
                                                              </div>
                                                           </div>
                                                    </form>

                                            </div>
                                        </div>
                                    </div>
                            <?php }else if($pageNo == 5) { ?>
                                    <div class="col-md-9" style="margin-top: 10px">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <form action ="{{URL::route('user.contact.getContact')}}" method="post" id="searchContactForm">
                                                           {!! Form::token() !!}
                                                           <div class="col-md-4">
                                                                <div class="form-group">
                                                                   <label>Search Contact</label>
                                                                    <input type="text" class="form-control" name="searchContactName" id="searchContactName">
                                                               </div>
                                                           </div>
                                                           <div class="col-md-2">
                                                                 <div class="form-group" style="margin-top: 25px;">
                                                                    <a href="javascript:void(0)" class="btn-u btn-u-blue" onclick="onSearchContact()">Search</a>
                                                                </div>
                                                           </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php }else if($pageNo == 6) {?>
                                    <div class="col-md-9" style="margin-top: 10px">
                                        <div class="row">
                                            <div class="col-md-12">
                                               <form action="" method="post" id="noteSearchDiv">
                                                   {!! Form::token() !!}
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                             <div class="form-group">
                                                                <label>Search Note</label>
                                                                <input type="text" class="form-control" name="onSearchNoteName">
                                                             </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Type</label>
                                                           <select name="onSearchType" class="form-control" id="searchType">
                                                                 <option value ="">Select Type</option>
                                                                @foreach($noteType as $key=>$value)
                                                                   <option value="{{$value->id}}">{{$value->notesType}}</option>
                                                                @endforeach
                                                           </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                           <div class="form-group">
                                                              <label>Comm Type</label>
                                                              <select name="onSearchCommType" class="form-control" id="searchCommType">
                                                                    <option value ="">Select Comm Type</option>
                                                                     @foreach($noteCommType as $key=>$value)
                                                                        <option value="{{$value->id}}">{{$value->noteCommType}}</option>
                                                                     @endforeach
                                                              </select>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-3">
                                                             <div class="form-group">
                                                                <label>Note Status</label>
                                                                <select name="onNoteStatus" class="form-control" id="searchCommType">
                                                                      <option value ="">Select Note Status</option>
                                                                       @foreach($noteStatus as $key=>$value)
                                                                          <option value="{{$value->id}}">{{$value->notesStatus}}</option>
                                                                       @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group" >
                                                                <label>Date Range From</label>
                                                                <input type="text" name="dateRangeFrom" class="form-control" id="dateRangeFrom">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group" >
                                                                <label>Date Range To</label>
                                                                <input type="text" name="dateRangeTo" class="form-control" id="dateRangeTo">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <input type="button" class=" btn-u btn-u-blue" onclick="onMainSearchNote()" value="Search" style="margin-top: 25px">
                                                            </div>
                                                        </div>
                                                        <div class='input-group date' id='datetimepicker1'>
                                                            <input type='text' class="form-control" />
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                              </form>
                                           </div>
                                        </div>
                                    </div>
                           <?php } } ?>
                        </div>
                    </div>
        	    </div>
        	    @yield('body')
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
        <script src="/assets/shop-ui/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js"></script>
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