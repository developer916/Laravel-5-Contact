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
				</ul>
			</div>
			<div class="row">
			    <div class="col-md-12">
			        <h4>Contact Detail</h4>
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
                                            <div class="panel-heading" style="background: #3498db; ">
                                                <h4 style="color:white">Quotes</h4>
                                            </div>
                                            <div class="panel-body">
                                                @foreach ($listQuote as $key => $value)
                                                    <div class="row margin-bottom-5">
                                                        <div class="col-md-8">
                                                           <p><a href = "{{URL::route('admin.contact.quote', array($people->id, $value->projectId, $value->id))}}">{{$value->quoteName}}</a></p>
                                                        </div>
                                                        <div class="col-md-4">
                                                         <p><a href="{{URL::route('admin.contact.deleteQuote',array($value->id,'main'))}}" style="color:red">Delete</a></p>
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
                                          <div class="panel-heading" style="background: #3498db; ">
                                              <div class="row">
                                                  <div class="col-md-6">
                                                     <h4 style="color: white">Projects</h4>
                                                  </div>
                                                  <div class="col-md-6 text-right">
                                                    <!--  <a href = ""class="btn red" type="button" style="color: white">Add</a>-->
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="panel-body">
                                                 @foreach($project as $key=>$value)
                                                  <div class="row margin-bottom-5">
                                                      <div class="col-md-8">
                                                          <p><a href = "{{URL::route('admin.contact.project', array($people->id, $value->id))}}">{{$value->projectName}}</a></p></p>
                                                      </div>
                                                      <div class="col-md-4">
                                                          <p><a href="{{URL::route('admin.contact.deleteProject',array($value->id,'main'))}}" style="color:red">Delete</a></p>
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
                                   </div>
                          </div>
                          <div class="col-md-3">
                           <div class="row" id="noteContentList">
                                 <?php echo $list;?>
                            </div>
                          </div>
                      </div>
			    </div>
			</div>
	@stop
@stop