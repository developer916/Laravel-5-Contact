@extends('admin.layout')
	@section('body')
		<h3 class="page-title">Edit Note Status Management</h3>
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
						<a href="{{URL::route('admin.noteStatus')}}">Note Status</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="{{URL::route('admin.noteStatus.edit', $noteStatus->id)}}">Edit Note Status</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								Edit Note Status
							</div>
						</div>
							<div class="portlet-body form">
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
							<form  class="form-horizontal" id="addCategoryFiledForm" method="POST" action="{{URL::route('admin.noteStatus.store')}}" enctype="multipart/form-data">
							    {!! Form::token()!!}
							    <input type="hidden" name="noteStatus_id" value="{{$noteStatus->id}}">
							    <div class="form-body">
                                    <div class="form-group" id="countryname">
                                         <label class="col-md-3 col-sm-3 col-xs-12 control-label">Note Status</label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                             <input type="text" name="notesStatus" class="form-control" placeholder="Note Status" value="{{$noteStatus->notesStatus}}">
                                         </div>
                                    </div>
							    </div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-7 col-md-5">
											<button   class="btn  blue" type="submit" ><i class="fa fa-check-circle-o" style="margin-right:4px"></i>Edit</button>
											<a class="btn  green" href="{{URL::route('admin.noteStatus')}}"><i class="fa fa-repeat" style="margin-right:4px"></i>Cancel</a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	@stop
	@section('custom-scripts')
	@stop
@stop
