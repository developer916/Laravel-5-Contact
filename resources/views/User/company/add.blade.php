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
                            <h4>Add Company</h4>
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

                                  <div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                 <label>Company Name</label>
                                                 <input type="text" class="form-control" name="companyName" id="companyName" placeholder="Company Name">
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
                                                          <option value="{{$typeItem->id}}">{{$typeItem->type}}</option>
                                                      @endforeach
                                                  </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" name="phone"  class="form-control" id="phone" placeholder="Phone">
                                            </div>
                                        </div>
                                  </div>
                                  <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Website</label>
                                                <input type="text" name="website" class="form-control" id="website" placeholder="Website">
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
                                                        <option value="{{$value->id}}">{{$value->firstName}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                  </div>
                                  <div class="row">
                                       <div class="col-md-12 text-right">
                                            <input type="submit" value="Save Company" class="btn-u btn-u-blue">
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