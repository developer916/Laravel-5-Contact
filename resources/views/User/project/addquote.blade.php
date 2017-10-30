@extends('user.layout')
    @section('body')
        <div class="container content">
            <div class="row">
                <div class="col-md-3">
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
                     <div class="panel panel-blue  margin-bottom-40">
                            <div class="panel-heading forest-panel-heading-note">
                                <h3 class="panel-title forest-panel-title-note" style="font-size: 18px!important;">
                                    Quotes
                                </h3>
                             </div>
                            <div class="panel-body" id="panelBodyDiv">
                                @foreach($quote as $key=>$value)
                                    <div class="row margin-bottom-5">
                                        <div class="col-md-8">
                                            <p><a href="{{URL::route('user.project.quote', array($people->id,$project->id ,$value->id))}}">{{$value->quoteName}}</a></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><a href="{{URL::route('user.project.deleteQuote',array($value->id,'addQuote'))}}" style="color:red">Delete</a></p>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{URL::Route('user.project.storeQuote')}}" method="post" id="quoteDiv">
                                {!!  Form::token()!!}
                                <input type="hidden" name="projectId" value="{{$project->id}}">
                                <input type="hidden" name="quoteListId">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quote Id</label>
                                            <input type="text" name="quoteName" class="form-control" id="quoteId">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="form-group">
                                            <label>Quote Description</label>
                                            <textarea class="form-control" name="quoteDescription" id="quoteDescription"></textarea>
                                          </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Payment Term</label>
                                           <select name="payment" class="form-control" id="payment">
                                                <option value="">Select Payment Term</option>
                                                @foreach($payment as $key=>$value)
                                                  <option value="{{$value->id}}">{{$value->payment}}</option>
                                                @endforeach
                                           </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Assosiate quote to project</label>
                                            <select name="assosiate" class="form-control" id="assosiate">
                                                <option>Select</option>
                                                @foreach($members as $key =>$value)
                                                   <option value="{{$value->id}}">{{$value->first_name ." ". $value->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <input type="button" class="btn-u btn-u-blue" value="Save Quote" onclick="onSaveQuote()">
                                        <a href="{{URL::route('user.project',array($people->id, $project->id))}}" class="btn-u btn-u-red">Go To Project</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop
    @section('custom-scripts')
        <script type="text/javascript">
            function onSaveQuote(){
               $("#quoteDiv").ajaxForm({
                    success:function(data){
                        if(data.result == "success"){
                            bootbox.alert(data.message);
                            $("#panelBodyDiv").html(data.list);
                            $("#quoteId").val('');
                            $("#quoteDescription").val('');
                            $("#payment").val('');
                            $("#assosiate").val('');
                            window.location.reload();
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
        </script>

    @stop
@stop