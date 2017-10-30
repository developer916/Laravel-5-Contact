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
                                    if($pageNo == 4 || $pageNo== 5 || $pageNo ==6){
                              ?>
                                <div class="col-md-3" style="margin-top: 55px">
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
                                    if($pageNo == 4){
                                ?>
                                    <div class="col-md-9" style="margin-top: 10px">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <form action="{{URL::route('user.contact.searchMainNote')}}" method="post" id="searchMainForm">
                                                        {!! Form::token() !!}
                                                       <input name="peopleId" value="{{$people->id}}" type="hidden">
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
                                                            <div class="form-group" style="margin-top: 25px;">
                                                                <input type="button" class="btn-u btn-u-blue" value="Search" onclick="onSearchNote()">
                                                            </div>
                                                      </div>
                                                    </form>
                                                </div>
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
                                                                    <input type="button" class="btn-u btn-u-blue" value="Search" onclick="onSearchContact()">
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
                                               <form action="{{URL::route('user.contact.getNoteContact')}}" method="post" id="noteSearchDiv">
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
                                                            <div class="form-group">
                                                                <label>Note Assign</label>
                                                                <select name="onNoteAssign" class="form-control" id="searchAssign">
                                                                    <option value="">Select Note Assign</option>
                                                                    @foreach($members as $key =>$value)
                                                                        <option value="{{$value->id}}">{{$value->first_name .' '. $value->last_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
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
                                                    </div>
                                              </form>
                                           </div>
                                        </div>
                                    </div>
                           <?php } } ?>
                        </div>
                    </div>
        	    </div>
        	     <div class="container content">
                    <div class="row margin-bottom-40" id="mainDiv">

                    </div>
                </div>
        	</div>
        </div>
        <div class="modal fade" id="payNowQuoteDiv" tabindex="-1" role="dialog"  aria-labelledby="basicModal" aria-hidden="true">
             <div class="modal-dialog">
                  <div class="modal-content modalChangeContent">
                      <div class="modal-header modalChangeHeader">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                          <h4 class="modal-title modalChangeTitle" id="myModalLabel">Edit Note</h4>
                      </div>
                      <div class="modal-body" id="myModaltext">
                          <div class="row">
                              <div class="col-md-12">
                                   <form action="{{URL::route('user.contact.addNote')}}" method="post" id="addNoteDiv">
                                      <input type="hidden" name="peopleId" id="peopleId">
                                      <input type="hidden" name="noteId" id="noteId">
                                      {!! Form::token() !!}
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label>Enter Notes</label>
                                                  <textarea class="form-control" name="note" rows="5" placeholder="Enter Notes" id="note"></textarea>
                                                  <input type="hidden" name="noteContent"  id="nameContent">
                                              </div>
                                          </div>
                                     </div>
                                     <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-horizontal">
                                              <!--note type -->
                                                  <div class="form-group">
                                                          <label for="inputEmail1" class="col-md-3 control-label">Type</label>
                                                          <div class="col-md-9">
                                                              <select name="noteType" class="form-control" id="noteType">
                                                                   <option value ="">Select Type</option>
                                                                   @foreach($noteType as $key=>$value)
                                                                      <option value="{{$value->id}}">{{$value->notesType}}</option>
                                                                   @endforeach
                                                              </select>
                                                          </div>
                                                   </div>
                                              <!-- note comm type -->
                                                   <div class="form-group">
                                                       <label for="inputEmail1" class="col-md-3 control-label">Comm Type</label>
                                                       <div class="col-md-9">
                                                           <select name="noteCommType" class="form-control" id="noteCommType">
                                                                <option value ="">Select Comm Type</option>
                                                                @foreach($noteCommType as $key=>$value)
                                                                   <option value="{{$value->id}}">{{$value->noteCommType}}</option>
                                                                @endforeach
                                                           </select>
                                                       </div>
                                                  </div>
                                              <!-- note Assign-->
                                                   <div class="form-group">
                                                       <label for="inputEmail1" class="col-md-3 control-label">Assigned to</label>
                                                       <div class="col-md-9">
                                                           <select name="noteAssign" class="form-control" id="noteAssign">
                                                                <option value ="">Select Assign</option>
                                                                @foreach($members as $key=>$value)
                                                                   <option value="{{$value->id}}">{{$value->first_name." ". $value->last_name}}</option>
                                                                @endforeach
                                                           </select>
                                                       </div>
                                                  </div>
                                               <!--note  status-->
                                                   <div class="form-group">
                                                        <label for="inputEmail1" class="col-md-3 control-label">Note Status</label>
                                                        <div class="col-md-9">
                                                            <select name="noteStatus" class="form-control" id="noteStatus">
                                                                 <option value ="">Select Status</option>
                                                                 @foreach($noteStatus as $key=>$value)
                                                                    <option value="{{$value->id}}">{{$value->notesStatus}}</option>
                                                                 @endforeach
                                                            </select>
                                                        </div>
                                                   </div>
                                               <!--- Note TypeDetail-->
                                                  <div class="form-group margin-bottom-20">
                                                     <label for="inputEmail1" class="col-md-3 control-label">Type Detail</label>
                                                     <div class="col-md-9">
                                                         <input  name="noteTypeDetails" class="form-control" id="noteTypeDetails" placeholder="Type Detail">
                                                     </div>
                                                  </div>
                                              </div>
                                          </div>
                                     </div>
                                     <div class="row margin-bottom-40">
                                          <div class="col-md-12 text-right">
                                              <input type="button" class="btn-u btn-u-blue" value="Edit Note" onclick="onAddNote()" id="addNoteButton">
                                              <button type="button" class="btn-u btn-u-red"  data-dismiss="modal">Cancel</button>
                                          </div>
                                     </div>
                                  </form>
                              </div>
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
        <script src="/assets/shop-ui/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="/assets/js/tinymce/js/tinymce/tinymce.min.js" ></script>
                <script>
                    jQuery(document).ready(function() {
                        App.init();
                        App.initScrollBar();
                        App.initParallaxBg();
                        OwlCarousel.initOwlCarousel();
                        RevolutionSlider.initRSfullWidth();
                        jQuery(document).ready(function() {
                           tinymce.init({
                                 selector: "textarea#note",
                                   theme: "modern",
                                   plugins: [
                                       "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                                       "searchreplace wordcount visualblocks visualchars code fullscreen",
                                       "insertdatetime media nonbreaking save table contextmenu directionality",
                                       "emoticons template paste textcolor colorpicker textpattern"
                                   ],
                                   toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                                   toolbar2: "print preview media | forecolor backcolor emoticons",
                                   image_advtab: true,
                                   height:350,
                                   templates: [
                                       {title: 'Test template 1', content: 'Test 1'},
                                       {title: 'Test template 2', content: 'Test 2'}
                                   ]
                               });
                        });
                    });
                </script>
                <script type="text/javascript">
                    $(function () {
                        $('#dateRangeFrom').datepicker({format: 'yyyy-mm-dd'});
                        $('#dateRangeTo').datepicker({format: 'yyyy-mm-dd'});
                    });
                    function onMainSearchNote(){
                        $("#noteSearchDiv").ajaxForm({
                            success:function(data){
                                if(data.result == "success"){
                                    $("#mainDiv").html(data.list);
                                }else if(data.result == "empty"){
                                    $("#mainDiv").html(data.message);
                                }
                            }
                        }).submit();
                    }
                    function onEditNoteChange(id){
                            var base_url = window.location.origin;
                            $.ajax ({
                               url: base_url + '/searchNoteContent',
                               type: 'POST',
                               data: {id: id, _token: $("input[name='_token']").val()},
                               cache: false,
                               dataType : "json",
                               success: function (data) {
                                   if(data.result == "success"){
                                         tinyMCE.activeEditor.setContent(data.note['notes']);
                                        $("#noteType").val(data.note['notesTypeId']);
                                        $("#noteCommType").val(data.note['notesCommTypeId']);
                                        $("#noteAssign").val(data.note['notesAssignId']);
                                        $("#noteStatus").val(data.note['notesStatusId']);
                                        $("#noteTypeDetails").val(data.note['noteTypeDetailId']);
                                        $("#peopleId").val(data.note['peopleId']);
                                        $("#noteId").val(data.note['id']);
                                        $("#payNowQuoteDiv").modal('show');
                                   }
                               }
                          });
                    }
                    function onAddNote(){
                        var content = tinymce.get('note').getContent();
                             if(content  == "" || content == "<p></p>"){
                                    bootbox.alert("Please insert note");
                                    return;
                                }
                            $("#nameContent").val(content);
                    $("#addNoteDiv").ajaxForm({
                         success: function(data){
                            if(data.result == "success"){
                               bootbox.alert(data.message);
                               tinyMCE.activeEditor.setContent('');
                               $("#noteType").val('');
                               $("#noteCommType").val('');
                               $("#noteAssign").val('');
                               $("#noteStatus").val('');
                               $("#noteTypeDetails").val('');
                               $("#noteId").val('');
                                if(data.countList>0) {
                                   $("#mainDiv").html(data.list);
                              }
                               $("#payNowQuoteDiv").modal('hide');

                            }else if(data.result == "failed"){
                                    $("#payNowQuoteDiv").modal('hide');
                                    var arr = data.error;
                                    var errorList = '';
                                   $.each(arr, function(index, value)
                                   {
                                       if (value.length != 0)
                                       {
                                           errorList = errorList + value;
                                       }
                                   });
                                    bootbox.alert(errorList);
                            }

                         }
                    }).submit();
                    }
                </script>
        @stop
@stop