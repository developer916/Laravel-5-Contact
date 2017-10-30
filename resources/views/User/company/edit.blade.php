@extends('user.layout')
    @section('body')
        <div class="container content">
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-blue margin-bottom-40">
                                <div class="panel-heading ">
                                    <h4 style="color: white">Companies</h4>
                                </div>
                                <div class="panel-body">
                                    @foreach($company as $key=>$value)
                                    <p>
                                        <a href="{{URL::route('user.company.editCompany' , $value->id)}}">{{$value->companyName}}</a>
                                    </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Edit Company</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                              @if ($errors->has())
                                    <div class="alert alert-danger alert-dismissibl fade in">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
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
                              <form action="{{URL::route('user.company.storeCompany')}}" method="post" id="addCompanyForm">
                                  {!! Form::token() !!}
                                   <input type="hidden" name="companyId" value="{{$companyItem->id}}">
                                  <div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                 <label>Company Name</label>
                                                 <input type="text" class="form-control" name="companyName" id="companyName" placeholder="Company Name" value="{{$companyItem->companyName}}">
                                            </div>
                                       </div>
                                  </div>
                                  <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company Type</label>
                                                <select name="type" class="form-control" id="type">
                                                      <option value="">Select Type</option>
                                                      @foreach($type as $key => $typeItem)
                                                        @if($typeItem->id == $companyItem->typeId)
                                                            <option value="{{$typeItem->id}}" selected>{{$typeItem->type}}</option>
                                                        @else
                                                            <option value="{{$typeItem->id}}">{{$typeItem->type}}</option>
                                                        @endif
                                                      @endforeach
                                                  </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" name="phone"  class="form-control" id="phone" placeholder="Phone" value="{{$companyItem->phone}}">
                                            </div>
                                        </div>
                                  </div>
                                  <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="{{$companyItem->email}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Website</label>
                                                <input type="text" name="website" class="form-control" id="website" placeholder="Website" value="{{$companyItem->website}}">
                                            </div>
                                        </div>
                                  </div>
                                  <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Main People</label>
                                                <select name="mainPeople" class="form-control">
                                                    <option value="">Select Main People</option>
                                                    @foreach($people as $key => $value)
                                                        @if($value->id == $companyItem->mainPeopleId)
                                                            <option value="{{$value->id}}" selected>{{$value->firstName}}</option>
                                                        @else
                                                            <option value="{{$value->id}}">{{$value->firstName}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                  </div>
                                  <div class="row">
                                       <div class="col-md-12 text-right">
                                            <input type="submit" value="Edit Company" class="btn-u btn-u-blue">
                                            <a href="{{URL::route('user.newContact')}}" class="btn-u btn-u-red">Go To Contact</a>
                                       </div>
                                  </div>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop
@stop