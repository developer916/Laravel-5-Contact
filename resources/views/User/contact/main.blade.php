@extends('user.layout')
    @section('custom-styles')
        <link media="all" type="text/css" rel="stylesheet" href="/assets/css/forestChange.css">
    @stop
    @section('body')
        <div class="container content">
            <div class="row">
                <div class="col-md-3">
                    <div class="row margin-bottom-20">

                          <div class="col-md-12">
                             <?php if (isset($alert)) {
                                      if($alert['list'] == "quote"){
                                    ?>
                                    <div class="alert alert-<?php echo $alert['type'];?> alert-dismissibl fade in">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        <p>
                                            <?php echo $alert['msg'];?>
                                        </p>
                                    </div>
                                <?php } }?>
                                <div class="panel panel-blue margin-bottom-40">
                                    <div class="panel-heading ">
                                        <h4 style="color: white">Quotes</h4>
                                    </div>
                                    <div class="panel-body">
                                        @foreach ($listQuote as $key => $value)
                                            <div class="row margin-bottom-5">
                                                <div class="col-md-8">
                                                   <p><a href = "{{URL::route('user.project.quote', array($people->id, $value->projectId, $value->id))}}">{{$value->quoteName}}</a></p>
                                                </div>
                                                <div class="col-md-4">
                                                 <p><a href="{{URL::route('user.project.deleteQuote',array($value->id,'main'))}}" style="color:red">Delete</a></p>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                          </div>
                      </div>
                    <div class="row margin-bottom">
                        <div class="col-md-12">
                            <?php if (isset($alert)) {
                                  if($alert['list'] == "project"){
                                ?>
                                <div class="alert alert-<?php echo $alert['type'];?> alert-dismissibl fade in">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <p>
                                        <?php echo $alert['msg'];?>
                                    </p>
                                </div>
                            <?php } }?>
                            <div class="panel panel-blue margin-bottom-40">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-6">
                                           <h4 style="color: white">Projects</h4>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a href = "{{URL::route('user.project.add', $people->id)}}"class="btn-u btn-brd forest-btn-change-project" type="button" style="color: white">Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                       @foreach($project as $key=>$value)
                                        <div class="row margin-bottom-5">
                                            <div class="col-md-8">
                                                <p><a href = "{{URL::route('user.project', array($people->id, $value->id))}}">{{$value->projectName}}</a></p></p>
                                            </div>
                                            <div class="col-md-4">
                                                <p><a href="{{URL::route('user.project.deleteProject',array($value->id,'main'))}}" style="color:red">Delete</a></p>
                                            </div>
                                        </div>
                                       @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="row">
                         <div class="col-md-12">
                            <form class="margin-bottom-40" method="post" action="{{URL::route('user.contact.addPeople')}}" id="addPeopleDiv">
                                {!! Form::token() !!}
                                 <!-- contact Related Company -->
                                 <input type="hidden" name="peopleID" value="{{$people->id}}">
                                 <div class="row">
                                     <div class="col-md-4">
                                         <div class="form-group">
                                             <label>Relate to Company</label>
                                             <select name="company" class="form-control">
                                                 <option>Select Company</option>
                                                 @foreach($company as $key=>$value)
                                                   @if($value->id == $people->companyId)
                                                        <option value="{{$value->id}}" selected>{{$value->companyName}}</option>
                                                   @else
                                                        <option value="{{$value->id}}">{{$value->companyName}}</option>
                                                   @endif
                                                 @endforeach
                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 <!--  contact first line start-->
                                 <div class="row">
                                      <div class="col-md-12">
                                         <div class="form-group">
                                             <label for="exampleInputEmail1">Sir</label>
                                             <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Sir" name="sir" value="{{$people->titleName}}">
                                         </div>
                                      </div>
                                 </div>
                                 <div class="row">
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">First Name</label>
                                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="First Name" name="first_name" value="{{$people->firstName}}">
                                          </div>
                                       </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Middle</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Middle" name="middle_name" value="{{$people->middleName}}">
                                        </div>
                                     </div>
                                     <div class="col-md-4">
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Last Name</label>
                                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Last Name" name="last_name" value="{{$people->lastName}}">
                                          </div>
                                      </div>
                                  </div>
                                  <!--  contact second line start-->
                                  <div class="row">
                                       @foreach (['company_name' => 'Company Name',
                                                  'email' =>'Email',
                                                  'contact_type' =>"Contact Type"
                                                  ] as $key=>$value)
                                             @if($key === 'contact_type')
                                                  <div class="col-md-4">
                                                      <div class="form-group">
                                                          <label for="exampleInputEmail1">{{$value}}</label>
                                                          <select name="type" class="form-control" id="type">
                                                              <option value="">Select Contact Type</option>
                                                              @foreach($type as $key => $typeItem)
                                                                   @if($typeItem->id == $people->typeId)
                                                                        <option value="{{$typeItem->id}}" selected>{{$typeItem->type}}</option>
                                                                   @else
                                                                        <option value="{{$typeItem->id}}">{{$typeItem->type}}</option>
                                                                   @endif
                                                              @endforeach
                                                          </select>
                                                      </div>
                                                  </div>
                                             @elseif($key === 'email')
                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{{$value}}</label>
                                                        <input type="email" name="{{$key}}" class="form-control" placeholder="{{$value}}" value="{{$people->email}}">
                                                    </div>
                                                </div>
                                             @else
                                                  <div class="col-md-4">
                                                     <div class="form-group">
                                                         <label for="exampleInputEmail1">{{$value}}</label>
                                                         <input type="text" name="{{$key}}" class="form-control" placeholder="{{$value}}" value ="{{$people->companyName}}">
                                                     </div>
                                                 </div>
                                             @endif
                                       @endforeach
                                  </div>
                                  <!--  contact third line start-->
                                  <div class="row">
                                      @foreach([
                                              'category' =>"Category",
                                              'industry' => 'Industry',
                                               'phone' => 'Phone',
                                               ] as $key=>$value)
                                          @if($key === 'category')
                                              <div class="col-md-4">
                                                  <div class="form-group">
                                                      <label for="exampleInputEmail1">Category</label>
                                                      <select name="category" class="form-control" id="category">
                                                          <option value="">Select Category</option>
                                                          @foreach($category as $key => $categoryItem)
                                                              @if($categoryItem->id == $people->categoryId)
                                                                   <option value="{{$categoryItem->id}}" selected>{{$categoryItem->category}}</option>
                                                              @else
                                                                    <option value="{{$categoryItem->id}}">{{$categoryItem->category}}</option>
                                                              @endif
                                                          @endforeach
                                                      </select>
                                                  </div>
                                              </div>
                                         @elseif($key === 'industry')
                                              <div class="col-md-4">
                                                 <div class="form-group">
                                                     <label for="exampleInputEmail1">{{$value}}</label>
                                                     <select name="industry" class="form-control" id="industry" >
                                                         <option value="">Select Industry</option>
                                                         @foreach($industry as $key => $industryItem)
                                                            @if($industryItem->id == $people->industryId)
                                                                 <option value="{{$industryItem->id}}" selected>{{$industryItem->industry}}</option>
                                                            @else
                                                                <option value="{{$industryItem->id}}">{{$industryItem->industry}}</option>
                                                            @endif
                                                         @endforeach
                                                     </select>
                                                 </div>
                                             </div>
                                         @else
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">{{$value}}</label>
                                                  <input type="text" name="{{$key}}" class="form-control" placeholder="{{$value}}" value="{{$people->phone}}">
                                              </div>
                                          </div>
                                          @endif
                                     @endforeach
                                  </div>

                                  <!--  contact fifth line start-->
                                  <div class="row">
                                      @foreach([
                                              'mobile' =>'Mobile',
                                              'fax' =>"Fax"] as $key=>$value)

                                              <div class="col-md-4">
                                                  <div class="form-group">
                                                      <label for="exampleInputEmail1">{{$value}}</label>
                                                      @if($key === 'mobile')
                                                        <input type="text" name="{{$key}}" class="form-control" placeholder="{{$value}}" value="{{$people->mobile}}">
                                                     @else
                                                        <input type="text" name="{{$key}}" class="form-control" placeholder="{{$value}}" value="{{$people->fax}}">
                                                     @endif
                                                  </div>
                                              </div>
                                     @endforeach
                                  </div>
                                  <div class="row margin-bottom-20" id="selectTagsDivs">
                                    @if(count($selectTags)>0)
                                        <?php for($i=0; $i<count($selectTags); $i++){ ?>
                                         <div class="col-md-4" id="selectTagItem">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Select Tag</label>
                                                  <select name="tags<?php echo $i;?>" id="tags<?php echo $i;?>" class="form-control">
                                                     <option value="">Select Tag</option>
                                                     @foreach($tags as $key=>$value)
                                                        @if($value->id == $selectTags[$i]->tagId)
                                                            <option value = "{{$value->id}}" selected>{{$value->tags}}</option>
                                                        @else
                                                            <option value = "{{$value->id}}">{{$value->tags}}</option>
                                                        @endif
                                                     @endforeach
                                                  </select>
                                              </div>
                                       </div>
                                        <?php } ?>
                                    @else
                                     <div class="col-md-4" id="selectTagItem">
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Select Tag</label>
                                              <select name="tags0" id="tags0" class="form-control">
                                                 <option value="">Select Tag</option>
                                                 @foreach($tags as $key=>$value)
                                                     <option value = "{{$value->id}}">{{$value->tags}}</option>
                                                 @endforeach
                                              </select>
                                          </div>
                                       </div>
                                       @endif
                                       <div class="col-md-2">
                                          <input type="button" class="btn-u btn-u-blue" onclick="onAddTagDiv()" value ="add" style="margin-top: 25px">
                                       </div>
                                  </div>
                                  <div class="row margin-bottom-20">
                                          <div class="col-md-12">
                                              <input type="button" class="btn-u btn-u-blue" value="Save" onclick="onSendPeople();">
                                          </div>
                                  </div>
                            </form>
                         </div>
                    </div>

                        <div class="row margin-bottom-40">
                            <div class="col-md-12">
                                <form action="{{URL::route('user.contact.addNote')}}" method="post" id="addNoteDiv">
                                    {!! Form::token() !!}
                                    <input type="hidden" name="peopleId" value="{{$people->id}}">
                                    <input type="hidden" name="noteId" id="noteId">
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
                                                <div class="form-group">
                                                   <label for="inputEmail1" class="col-md-3 control-label">Type Detail</label>
                                                   <div class="col-md-9">
                                                       <input  name="noteTypeDetails" class="form-control" id="noteTypeDetails">
                                                   </div>
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-md-12 text-right">
                                            <input type="button" class="btn-u btn-u-blue" value="Add Note" onclick="onAddNote()" id="addNoteButton">
                                        </div>
                                   </div>
                                </form>
                            </div>
                    </div>
                     <div class="row margin-bottom-20">
                    <!--- tags section start-->
                        <div class="col-md-6">
                            <h4 class="margin-bottom-20">Add Tags Section</h4>
                            <form action="{{URL::route('user.contact.addTag')}}" method="post" id="addTagDiv">
                            {!! Form::token() !!}
                                <div class="row margin-bottom-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Add Tags</label>
                                           <input type="text" value="" class="form-control" name="add_tags" id="add_tags" placeholder="Add Tags">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="button" value="Save Tag" class="btn-u btn-u-blue" onclick="onSaveTag()">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--- Category section start-->
                        <div class="col-md-6">
                            <h4 class="margin-bottom-20">Add Category Section</h4>
                            <form action="{{URL::route('user.contact.addCategory')}}" method="post" id="addCategoryDiv">
                                {!! Form::token() !!}
                                <div class="row margin-bottom-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Add Category</label>
                                            <input type="text" value="" class="form-control" name="add_category" placeholder="Add Category" id="add_category">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="button" value="Save Category" class="btn-u btn-u-blue" onclick="onSaveCategory()">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--- industry section start-->
                        <div class="col-md-6">
                            <h4 class="margin-bottom-20">Add Industry Section</h4>
                            <form action="{{URL::route('user.contact.addIndustry')}}" method="post" id="addIndustryDiv">
                                 {!! Form::token() !!}
                                <div class="row margin-bottom-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Add Industry</label>
                                            <input type="text" value="" class="form-control" name="add_industry" id="add_industry" placeholder="Add Industry">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="button" value="Save Industry" class="btn-u btn-u-blue" onclick="onSaveIndustry()">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--- type section start-->
                        <div class="col-md-6">
                            <h4 class="margin-bottom-20">Add Type Section</h4>
                            <form action="{{URL::route('user.contact.addType')}}" method="post" id="addTypeDiv">
                                {!! Form::token() !!}
                                <div class="row margin-bottom-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Add Type</label>
                                            <input type="text" value="" class="form-control" name="add_type" id="add_type" placeholder="Add Type">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="button" value="Save Type" class="btn-u btn-u-blue" onclick="onSaveType()">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                 </div>
                 <div class="col-md-3">

                      <div class="row" id="noteContentList">
                            <?php echo $list;?>
                       </div>
                 </div>
            </div>
        </div>


        <div class="col-md-4" id="selectTagItemClone" style="display: none">
            <div class="form-group">
                <label for="exampleInputEmail1">Select Tag</label>
                <select name="tags" id="tagsClone" class="form-control">
                   <option value="">Select Tag</option>
                   @foreach($tags as $key=>$value)
                       <option value = "{{$value->id}}">{{$value->tags}}</option>
                   @endforeach
                </select>
            </div>
         </div>
         <div class="modal fade" id="sendNoteSearchModel" tabindex="-1" role="dialog"  aria-labelledby="basicModal" aria-hidden="true">
              <div class="modal-dialog">
                   <div class="modal-content modalChangeContent">
                       <div class="modal-header modalChangeHeader">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                           <h4 class="modal-title modalChangeTitle" id="myModalLabel">Search Result</h4>
                       </div>
                       <div class="modal-body" id="myModaltext">
                       </div>
                       <div class="modal-footer">
                            <button type="button" class="btn-u btn-u-red" data-dismiss="modal">Cancel</button>
                       </div>
                   </div>
              </div>
         </div>
    @stop
    @section('custom-scripts')
        <script type="text/javascript" src="/assets/js/tinymce/js/tinymce/tinymce.min.js" ></script>
        <script type="text/javascript">
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
                   $("#searchNoteName").keypress(function (e) {
                      if (e.which == 13) {
                        return false;
                      }
                    });
            });
        /*******search Note*********/
            function onSearchNote(){
                $("#searchMainForm").attr('action','{{URL::route('user.contact.searchMainNote')}}');
                $("#searchMainForm").ajaxForm({
                    success:function(data){
                        if(data.result == "success"){
                             $("#myModaltext").html(data.list);
                             $("#sendNoteSearchModel").modal('show');
                        }else if(data.result == "empty"){
                                bootbox.alert(data.message);
                        }else if(data.result =="error"){
                            bootbox.alert(data.message);
                        }
                    }
                }).submit();
            }
            function onEditNoteChangeModal(id){
                $("#sendNoteSearchModel").modal('hide');
                $("#noteId").val(id);
                    var base_url = window.location.origin;
                   $.ajax ({
                        url: base_url + '/getNote',
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
                                $("#addNoteButton").val("Edit Note");
                            }

                        }
                   });
            }
            function onEditNoteChange(id){
                $("#noteId").val(id);
                var base_url = window.location.origin;
               $.ajax ({
                    url: base_url + '/getNote',
                    type: 'POST',
                    data: {id: id, _token: $("input[name='_token']").val()},
                    cache: false,
                    dataType : "json",
                    success: function (data) {
                        if(data.result == "success"){
                            //$("#note").val(data.note['notes']);
                            tinyMCE.activeEditor.setContent(data.note['notes']);
                            $("#noteType").val(data.note['notesTypeId']);
                            $("#noteCommType").val(data.note['notesCommTypeId']);
                            $("#noteAssign").val(data.note['notesAssignId']);
                            $("#noteStatus").val(data.note['notesStatusId']);
                            $("#noteTypeDetails").val(data.note['noteTypeDetailId']);
                            $("#addNoteButton").val("Edit Note");
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
                               $("#addNoteButton").val('Add Note');
                               if(data.countList>0) {
                                    $("#noteContentList").html(data.list);
                               }

                            }else if(data.result == "failed"){
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
            function onSendPeople(){
                var countResult = $("#selectTagsDivs").find("div#selectTagItem").size();
                var obj ="<input type='hidden' name='countTags' id='countTags' value='"+countResult+"'>";
                $("#addPeopleDiv").append(obj);
                $("#addPeopleDiv").ajaxForm({
                    success: function(data){
                        if(data.result == "success"){
                            bootbox.alert(data.message);
                            window.location.href = data.url;
                        }else if(data.result =="failed"){
                            $("#addPeopleDiv").find("input#countTags").remove();
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
            /**** Add Tags List*****/
             function onAddTagDiv(){
                var countResultText = $("#selectTagsDivs").find("div#selectTagItem").size();
                var obj = $("#selectTagItemClone").clone();
                obj.find("select").attr('name','tags'+countResultText);
                obj.find("select").attr('id',   'tags'+countResultText);
                obj.attr("id","selectTagItem");
                obj.show();
                $("#selectTagsDivs").find("div#selectTagItem:last").after(obj);
             }
            /******Add Tags Start*****/
            function onSaveTag(){
                $("#addTagDiv").ajaxForm({
                    success: function(data){
                        if(data.result == "success"){
                            bootbox.alert(data.message);
                            $("#add_tags").val('');
                            if(data.countList>0){
                                var countResult =  $("#selectTagsDivs").find("div#selectTagItem").size();
                                for(ik=0; ik<countResult; ik++){
                                    var tagValue = $("#tags"+ik).val();
                                        $("#tags"+ik).find("option").remove();
                                        $("#tags"+ik).append('<option value=""> Select Tags </option>');
                                        if(data.list.length>0){
                                            for(var i=0; i<data.list.length; i++){
                                                $("#tags"+ik).append('<option value="'+data.list[i]['id']+'">'+data.list[i]['tags']+'</option>');
                                            }

                                        }else{
                                            $("#tags"+ik).find("option").remove();
                                            $("#tags"+ik).append('<option value=""> Select Tags </option>');
                                        }
                                        $("#tags"+ik).val(tagValue);
                                }

                            }
                        }else if(data.result == "failed"){
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
                        }else if(data.result == "exit"){
                             bootbox.alert(data.message);
                             $("#add_tags").val('');
                        }
                    }
                }).submit();
            }

            /******Add Tags End*****/
            /******Add Category Start******/
            function onSaveCategory(){
                $("#addCategoryDiv").ajaxForm({
                    success: function(data){
                        if(data.result == "success"){
                            bootbox.alert(data.message);
                            $("#add_category").val('');
                            var categoryValue = $("#category").val();
                            if(data.countList>0){
                                $("#category").find("option").remove();
                                $("#category").append('<option value=""> Select Category </option>');
                                if(data.list.length>0){
                                    for(var i=0; i<data.list.length; i++){
                                        $("#category").append('<option value="'+data.list[i]['id']+'">'+data.list[i]['category']+'</option>');
                                    }
                                    $("#category").val(categoryValue);
                                }else{
                                    $("#category").find("option").remove();
                                    $("#category").append('<option value=""> Select Category </option>');
                                }
                            }
                        }else if(data.result == "failed"){
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
                        }else if(data.result == "exit"){
                             bootbox.alert(data.message);
                             $("#add_category").val('');
                        }
                    }
                }).submit();
            }
             /******Add Industry Start******/
             function onSaveIndustry(){
                $("#addIndustryDiv").ajaxForm({
                     success: function(data){
                         if(data.result == "success"){
                             bootbox.alert(data.message);
                             $("#add_industry").val('');
                             if(data.countList>0){
                                var industryValue = $("#industry").val();
                                 $("#industry").find("option").remove();
                                 $("#industry").append('<option value=""> Select Industry </option>');
                                 if(data.list.length>0){
                                     for(var i=0; i<data.list.length; i++){
                                         $("#industry").append('<option value="'+data.list[i]['id']+'">'+data.list[i]['industry']+'</option>');
                                     }
                                     $("#industry").val(industryValue);
                                 }else{
                                     $("#industry").find("option").remove();
                                     $("#industry").append('<option value=""> Select Industry </option>');
                                 }
                             }
                         }else if(data.result == "failed"){
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
                         }else if(data.result == "exit"){
                              bootbox.alert(data.message);
                              $("#add_industry").val('');
                         }
                     }
                 }).submit();
             }
            /******Add Industry End******/
            /********Add Type Start*******/
            function onSaveType(){
                $("#addTypeDiv").ajaxForm({
                     success: function(data){
                         if(data.result == "success"){
                             bootbox.alert(data.message);
                             $("#add_type").val('');
                             var typeValue = $("#type").val();
                             if(data.countList>0){
                                 $("#type").find("option").remove();
                                 $("#type").append('<option value=""> Select Contact Type </option>');
                                 if(data.list.length>0){
                                     for(var i=0; i<data.list.length; i++){
                                         $("#type").append('<option value="'+data.list[i]['id']+'">'+data.list[i]['type']+'</option>');
                                     }
                                 }else{
                                     $("#type").find("option").remove();
                                     $("#type").append('<option value=""> Select Contact Type </option>');
                                 }
                                 $("#type").val(typeValue);
                             }
                         }else if(data.result == "failed"){
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
                         }else if(data.result == "exit"){
                              bootbox.alert(data.message);
                              $("#add_type").val('');
                         }
                     }
                 }).submit();
             }
        </script>
    @stop
@stop