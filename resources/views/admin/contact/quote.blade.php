@extends('admin.layout')
    @section('body')
        <h3 class="page-title">Contact  Detail</h3>
            <!-- page layout -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="{{URL::route('admin.dashboard')}}">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <i class="fa fa-pencil"></i>
                        <a href="{{URL::route('admin.contact')}}">Contact List</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <i class="fa fa-pencil"></i>
                        <a href="{{URL::route('admin.contact.view',$people->id)}}">Contact</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="{{URL::route('admin.contact.project',array($people->id, $project->id))}}">Project</a>
                    </li>
                </ul>
            </div>
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
                        <div class="panel-heading forest-panel-heading-note" style="background: #3498db; ">
                            <div class="row">
                                  <div class="col-md-6">
                                         <h4 style="color: white">Quotes</h4>
                                      </div>
                            </div>
                         </div>
                        <div class="panel-body">
                            @foreach($quote as $key=>$value)
                                <div class="row margin-bottom-5">
                                    <div class="col-md-8">
                                        <p><a href="{{URL::route('admin.contact.quote', array($people->id, $project->id,$value->id))}}">{{$value->quoteName}}</a></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><a href="{{URL::route('admin.contact.deleteQuote',array($value->id,'editQuote'))}}" style="color:red">Delete</a></p>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
            </div>
            <div class="col-md-9">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Quote Id</label>
                            <input type="text" name="quoteName" class="form-control" id="quoteId" value="{{$quoteItem->quoteName}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                         <div class="form-group">
                            <label>Quote Description</label>
                            <textarea class="form-control" name="quoteDescription" id="quoteDescription">{{$quoteItem->quoteDesc}}</textarea>
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
                                  @if($value->id == $quoteItem->payment)
                                     <option value="{{$value->id}}" selected>{{$value->payment}}</option>
                                  @else
                                    <option value="{{$value->id}}">{{$value->payment}}</option>
                                  @endif
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
                                     @if($value->id == $quoteItem->assign)
                                          <option value="{{$value->id}}" selected>{{$value->first_name ." ". $value->last_name}}</option>
                                   @else
                                        <option value="{{$value->id}}">{{$value->first_name ." ". $value->last_name}}</option>
                                   @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop
@stop