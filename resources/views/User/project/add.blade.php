@extends('user.layout')
    @section('body')
        <div class="container content">
            <div class="row">
                <div class="col-md-3">
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
                    <div class="panel panel-blue  margin-bottom-40">
                        <div class="panel-heading forest-panel-heading-note">
                            <h3 class="panel-title forest-panel-title-note" style="font-size: 18px!important;">
                                Projects
                            </h3>
                         </div>
                        <div class="panel-body">
                            @foreach($project as $key=>$value)
                                <div class="row margin-bottom-5">
                                    <div class="col-md-8">
                                         <p><a href="{{URL::route('user.project', array($people->id, $value->id))}}">{{$value->projectName}}</a></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><a href="{{URL::route('user.project.deleteProject',array($value->id,'add'))}}" style="color:red">Delete</a></p>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row margin-bottom-25">
                        <div class="col-md-12">
                            <form action ="{{URL::route('user.project.addProject')}}" method="post" id="addProjectDiv">
                                {!! Form::token() !!}
                                <input type="hidden" name="peopleId" value="{{$people->id}}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Project Name</label>
                                            <input type="text" name="projectName" class="form-control" placeholder="Project Name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Project Description</label>
                                            <textarea  name="projectDescription" class="form-control" placeholder="Project Description" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row margin-bottom-20">
                                    <div class="col-md-12">
                                        <h4>Zone Managment</h4>
                                    </div>
                                </div>
                                <div class="row" id="addZoneDivs">
                                    <div class="col-md-12" id="addZoneDiv">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Select Type</label>
                                                    <select name="projectType0" class="form-control" id="projectType0">
                                                        <option value="">Select Type</option>
                                                        @foreach($projectType as $key=>$value)
                                                            <option value="{{$value->id}}">{{$value->type}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--- first line --->
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>W</label>
                                                    <input type="text" name="w0" class="form-control" id="w0">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>L</label>
                                                    <input type="text" name="l0" class="form-control" id="l0">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>H</label>
                                                    <input type="text" name="h0" class="form-control" id="h0">
                                                </div>
                                            </div>
                                             <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Unit</label>
                                                    <select  name="unit0" class="form-control" id="unit0">
                                                        <option value="">Unit</option>
                                                        @foreach($unit as $key=>$value)
                                                            <option value="{{$value->id}}">{{$value->unit}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Sq</label>
                                                    <input type="text" name="sq0" class="form-control" id="sq0">
                                                </div>
                                            </div>
                                        </div>
                                    <!--- second line --->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Fresh Air Velocity</label>
                                                    <input type="text" class="form-control" name="airVelocity0" placeholder="Fresh Air Velocity" id="airVelocity0">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Unit</label>
                                                    <select class="form-control" name="airVelocityUnit0" id="airVelocityUnit0">
                                                        <option value="">Unit</option>
                                                        @foreach($velocityUnit as $key=>$value)
                                                         <option value="{{$value->id}}">{{$value->unit}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Exhaust Air Velocity</label>
                                                    <input type="text" class="form-control" name="exhaustVelocity0" placeholder="Exhaust Air Velocity" id="exhaustVelocity0">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Unit</label>
                                                    <select class="form-control" name="exhaustVelocityUnit0" id="exhaustVelocityUnit0">
                                                        <option value="">Unit</option>
                                                        @foreach($velocityUnit as $key=>$value)
                                                         <option value="{{$value->id}}">{{$value->unit}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Third line-->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Fresh Air %</label>
                                                    <input type="text" name="freshAir0" class="form-control" placeholder="Fresh Air %" id="freshAir0">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>W</label>
                                                    <input type="text" name="ductW0" class="form-control" placeholder="Duct Width" id="ductW0">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>H</label>
                                                    <input type="text" name="ductH0" class="form-control" placeholder="Duct Height" id="ductH0">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Duct Air Velocity</label>
                                                    <input type="text" name="ductAirVelocity0" class="form-control" placeholder="Duct Height" id="ductAirVelocity0">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- third line -->
                                        <div class="row ">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Outdoor Temp</label>
                                                    <input type="text" name="outDoorTemp0" class="form-control" placeholder="Outdoor Temp" id="outDoorTemp0">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Unit</label>
                                                <select name="outTempUnit0" class="form-control" id="outTempUnit0">
                                                    <option>Unit</option>
                                                    @foreach($tempUnit as $key=>$value)
                                                       <option value="{{$value->id}}">{{$value->unit}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Target Temp</label>
                                                    <input type="text" name="targetTemp0" class="form-control" placeholder="Target Temp" id="targetTemp0">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Unit</label>
                                                <select name="targetTempUnit0" class="form-control" id="targetTempUnit0">
                                                    <option>Unit</option>
                                                    @foreach($tempUnit as $key=>$value)
                                                       <option value="{{$value->id}}">{{$value->unit}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- fourth line --->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Custom Field</label>
                                                    <input type="text" class="form-control" name="custom0" placeholder="Custom Field" id="custom0">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- fifth line --->
                                        <div class="row margin-bottom-20">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label >Notes</label>
                                                    <textarea class="form-control" name="notes0" id="notes0" placeholder="Notes" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                </div>
                                <!-- add zone -->
                                <div class="row margin-bottom-20">
                                    <div class="col-md-12 text-right">
                                         <input type="button" class="btn-u btn-u-blue" onclick="onAddZone()" value="Add Zone">
                                         <input type="button" class="btn-u" value="Save Project" onclick="onSaveProject()">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <!-- search list start--->
                    <div class="row margin-bottom-20" id="listMainDiv">
                    </div>
                <!-- search list end--->
                </div>
                <div class="col-md-3">
                     <div class="row" id="noteContentList">
                         <?php echo $list;?>
                    </div>
                </div>
            </div>
        </div>
 <!-- Clone div-->
        <div class="col-md-12" id="addZoneCloneDiv" style="display: none">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Select Type</label>
                        <select name="projectType" class="form-control" id="projectType">
                            <option value="">Select Type</option>
                            @foreach($projectType as $key=>$value)
                                <option value="{{$value->id}}">{{$value->type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!--- first line --->
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>W</label>
                        <input type="text" name="w" class="form-control" id="w">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>L</label>
                        <input type="text" name="l" class="form-control" id="l">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>H</label>
                        <input type="text" name="h" class="form-control" id="h">
                    </div>
                </div>
                 <div class="col-md-3">
                    <div class="form-group">
                        <label>Unit</label>
                        <select  name="unit" class="form-control" id="unit">
                            <option value="">Unit</option>
                            @foreach($unit as $key=>$value)
                                <option value="{{$value->id}}">{{$value->unit}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Sq</label>
                        <input type="text" name="sq" class="form-control" id="sq">
                    </div>
                </div>
            </div>
        <!--- second line --->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Fresh Air Velocity</label>
                        <input type="text" class="form-control" name="airVelocity" placeholder="Fresh Air Velocity" id="airVelocity">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Unit</label>
                        <select class="form-control" name="airVelocityUnit" id="airVelocityUnit">
                            <option value="">Unit</option>
                            @foreach($velocityUnit as $key=>$value)
                             <option value="{{$value->id}}">{{$value->unit}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Exhaust Air Velocity</label>
                        <input type="text" class="form-control" name="exhaustVelocity" placeholder="Exhaust Air Velocity" id="exhaustVelocity">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Unit</label>
                        <select class="form-control" name="exhaustVelocityUnit" id="exhaustVelocityUnit">
                            <option value="">Unit</option>
                            @foreach($velocityUnit as $key=>$value)
                             <option value="{{$value->id}}">{{$value->unit}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- Third line-->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Fresh Air %</label>
                        <input type="text" name="freshAir" class="form-control" placeholder="Fresh Air %" id="freshAir">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>W</label>
                        <input type="text" name="ductW" class="form-control" placeholder="Duct Width" id="ductW">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>H</label>
                        <input type="text" name="ductH" class="form-control" placeholder="Duct Height" id="ductH">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Duct Air Velocity</label>
                        <input type="text" name="ductAirVelocity" class="form-control" placeholder="Duct Height" id="ductAirVelocity">
                    </div>
                </div>
            </div>
            <!-- third line -->
            <div class="row ">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Outdoor Temp</label>
                        <input type="text" name="outDoorTemp" class="form-control" placeholder="Outdoor Temp" id="outDoorTemp">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Unit</label>
                    <select name="outTempUnit" class="form-control" id="outTempUnit">
                        <option>Unit</option>
                        @foreach($tempUnit as $key=>$value)
                           <option value="{{$value->id}}">{{$value->unit}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Target Temp</label>
                        <input type="text" name="targetTemp" class="form-control" placeholder="Target Temp" id="targetTemp">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Unit</label>
                    <select name="targetTempUnit" class="form-control" id="targetTempUnit">
                        <option>Unit</option>
                        @foreach($tempUnit as $key=>$value)
                           <option value="{{$value->id}}">{{$value->unit}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Custom Field</label>
                        <input type="text" class="form-control" name="custom" placeholder="Custom Field" id="custom">
                    </div>
                </div>
            </div>
            <!-- fourth line --->
            <div class="row margin-bottom-20">
                <div class="col-md-12">
                    <div class="form-group">
                        <label >Notes</label>
                        <textarea class="form-control" name="notes" placeholder="Notes" rows="5" id="notes"></textarea>
                    </div>
                </div>
            </div>
        </div>
<!-- Edit  Note Modal-->
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
                                                          <input name="noteTypeDetails" class="form-control" id="noteTypeDetails" placeholder="Type Detail">
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
          <!-- Edit  search  Modal-->
        <div class="modal fade" id="sendNoteSearchModel" tabindex="-1" role="dialog"  aria-labelledby="basicModal" aria-hidden="true">
              <div class="modal-dialog">
                   <div class="modal-content modalChangeContent">
                       <div class="modal-header modalChangeHeader">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                           <h4 class="modal-title modalChangeTitle" id="myModalLabel">Search Result</h4>
                       </div>
                       <div class="modal-body" id="sendSearchModalContent">
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
            });

            function onSaveProject(){
                var countResultText = $("#addZoneDivs").find("div#addZoneDiv").size();
                $("#addProjectDiv").append('<input type="hidden" name="countResultDiv" id="countResultDiv" value="'+countResultText+'">');
                $("#addProjectDiv").ajaxForm({
                    success:function(data){
                        if(data.result == "success"){
                            $("#countResultDiv").remove();
                            bootbox.alert(data.message);
                            window.location.href = data.url;
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
                           $("#countResultDiv").remove();
                             bootbox.alert(errorList);
                        }
                    }
                }).submit();
            }
            function onAddZone(){
                var countResultText = $("#addZoneDivs").find("div#addZoneDiv").size();
                var obj = $("#addZoneCloneDiv").clone();
                 obj.find("select#projectType").attr('name','projectType'+countResultText);
                 obj.find("select#projectType").attr('id','projectType'+countResultText);
                 obj.find("input#w").attr('name','w'+countResultText);
                 obj.find("input#w").attr('id','w'+countResultText);
                 obj.find("input#l").attr('name','l'+countResultText);
                 obj.find("input#l").attr('id','l'+countResultText);
                 obj.find("input#h").attr('name','h'+countResultText);
                 obj.find("input#h").attr('id','h'+countResultText);
                 obj.find("select#unit").attr('name','unit'+countResultText);
                 obj.find("select#unit").attr('id','unit'+countResultText);
                 obj.find("input#sq").attr('name','sq'+countResultText);
                 obj.find("input#sq").attr('id','sq'+countResultText);
                 obj.find("input#airVelocity").attr('name','airVelocity'+countResultText);
                 obj.find("input#airVelocity").attr('id','airVelocity'+countResultText);
                 obj.find("select#airVelocityUnit").attr('name','airVelocityUnit'+countResultText);
                 obj.find("select#airVelocityUnit").attr('id','airVelocityUnit'+countResultText);

                 obj.find("input#exhaustVelocity").attr('name','exhaustVelocity'+countResultText);
                 obj.find("input#exhaustVelocity").attr('id','exhaustVelocity'+countResultText);
                 obj.find("select#exhaustVelocityUnit").attr('name','exhaustVelocityUnit'+countResultText);
                 obj.find("select#exhaustVelocityUnit").attr('id','exhaustVelocityUnit'+countResultText);


                 obj.find("input#freshAir").attr('name','freshAir'+countResultText);
                 obj.find("input#freshAir").attr('id','freshAir'+countResultText);
                 obj.find("input#ductW").attr('name','ductW'+countResultText);
                 obj.find("input#ductW").attr('id','ductW'+countResultText);
                 obj.find("input#ductH").attr('name','ductH'+countResultText);
                 obj.find("input#ductH").attr('id','ductH'+countResultText);
                 obj.find("input#ductAirVelocity").attr('name','ductAirVelocity'+countResultText);
                 obj.find("input#ductAirVelocity").attr('id','ductAirVelocity'+countResultText);

                 obj.find("input#outDoorTemp").attr('name','outDoorTemp'+countResultText);
                 obj.find("input#outDoorTemp").attr('id','outDoorTemp'+countResultText);
                 obj.find("select#outTempUnit").attr('name','outTempUnit'+countResultText);
                 obj.find("select#outTempUnit").attr('id','outTempUnit'+countResultText);

                 obj.find("input#targetTemp").attr('name','targetTemp'+countResultText);
                 obj.find("input#targetTemp").attr('id','targetTemp'+countResultText);
                 obj.find("select#targetTempUnit").attr('name','targetTempUnit'+countResultText);
                 obj.find("select#targetTempUnit").attr('id','targetTempUnit'+countResultText);
                 obj.find("input#custom").attr('name','custom'+countResultText);
                 obj.find("input#custom").attr('id','custom'+countResultText);

                 obj.find("textarea#notes").attr('name','notes'+countResultText);
                 obj.find("textarea#notes").attr('id','notes'+countResultText);

                 obj.attr("id","addZoneDiv");
                 obj.show();
                 $("#addZoneDivs").find("div#addZoneDiv:last").after(obj);
            }
            function onSearchNote(){
                $("#searchMainForm").ajaxForm({
                    success:function(data){
                        if(data.result == "success"){
                             $("#listMainDiv").html(data.list);
                             //$("#sendNoteSearchModel").modal('show');
                        }else if(data.result == "empty"){
                                bootbox.alert(data.message);
                        }else if(data.result =="error"){
                            bootbox.alert(data.message);
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
             function onEditNoteChangeModal(id){
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
                            $("#sendNoteSearchModel").modal('hide');
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
                       $("#noteContentList").html(data.list);
                  }
                   $("#payNowQuoteDiv").modal('hide');
                   $("#listMainDiv").html('');
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