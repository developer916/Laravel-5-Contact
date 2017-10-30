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
                        <a href="{{URL::route('admin.contact.view',$people->id)}}">Contact</a>
                    </li>
				</ul>
			</div>
		<div class="row">
		    <div class="col-md-12">
		        <div class="col-md-3">
                    <?php if (isset($alert)) {
                          if(isset($alert['list']) && $alert['list'] == "quote"){
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
                                    <p><a href="{{URL::route('admin.contact.deleteQuote',array($value->id,'project'))}}" style="color:red">Delete</a></p>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
		        </div>
		        <div class="col-md-6">
                    <div class="row margin-bottom-20">
                        <div class="col-md-12">
                            <h3>Project Management</h3>
                        </div>
                        <div class="col-md-12">
                             <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" name="projectName" value="{{$project->projectName}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Project Name</label>
                                <textarea type="text" name="projectDescription" class="form-control" rows="5">{{$project->projectDesc}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h3>Zone List</h3>
                            <?php if (isset($alert)) {
                             if(isset($alert['list']) && $alert['list'] == "zone"){?>
                                <div class="alert alert-<?php echo $alert['type'];?> alert-dismissibl fade in">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <p>
                                        <?php echo $alert['msg'];?>
                                    </p>
                                </div>
                            <?php }} ?>
                        </div>
                        <div class="col-md-12">
                                <?php
                                    $listProject ='';
                                    for($i=0; $i<count($projectZone); $i++){
                                    $list .='<p>';
                                    if(strtoupper($projectZone[$i]->ProjectType->type) == "DIRECT SPACE"){
                                        $listProject .='Zone '.($i+1).': ';
                                        $listProject .='<span>'.$projectZone[$i]->ProjectType->type.'</span> ';
                                        $listProject .='<span>'.$projectZone[$i]->areaWidth.'W *</span> ';
                                        $listProject .='<span>'.$projectZone[$i]->areaLength.'L *</span> ';
                                        $listProject .='<span>'.$projectZone[$i]->areaHeight.'H</span> ';
                                        if($projectZone[$i]->AreaUnitId != ""){
                                            $listProject .='<span>('.$projectZone[$i]->areaSquareFoot.$projectZone[$i]->Square->unit.')</span> ';
                                        }
                                         $listProject .= "   ".'<a href="'.URL::route('admin.contact.deleteZone', $projectZone[$i]->id).'" style="color:red">Delete</a>';
                                    }else if(strtoupper($projectZone[$i]->ProjectType->type) == "In-Duct Duct Size"){
                                        $listProject .='Zone '.($i+1).': ';
                                        $listProject .='<span>'.$projectZone[$i]->ProjectType->type.'</span> ';
                                        $listProject .='<span>'.$projectZone[$i]->ductWidth.'W *</span> ';
                                        $listProject .='<span>'.$projectZone[$i]->ductHeight.'H</span> ';
                                         if($projectZone[$i]->AreaUnitId != ""){
                                            $listProject .='<span>('.$projectZone[$i]->areaSquareFoot.$projectZone[$i]->Square->unit.')</span> ';
                                        }
                                        $listProject .='<span>OA:'.$projectZone[$i]->freshAir.'%</span> ';
                                        $listProject .= "   ".'<a href="'.URL::route('admin.contact.deleteZone', $projectZone[$i]->id).'" style="color:red">Delete</a>';
                                    }else{
                                        $listProject .='Zone '.($i+1).': ';
                                        $listProject .='<span>'.$projectZone[$i]->ProjectType->type.'</span> ';
                                        $listProject .='<span>'.$projectZone[$i]->areaWidth.'W *</span> ';
                                        $listProject .='<span>'.$projectZone[$i]->areaLength.'L *</span> ';
                                        $listProject .='<span>'.$projectZone[$i]->areaHeight.'H</span> ';
                                        if($projectZone[$i]->AreaUnitId != ""){
                                            $listProject .='<span>('.$projectZone[$i]->areaSquareFoot.$projectZone[$i]->Square->unit.')</span> ';
                                        }
                                        $listProject .= "   ".'<a href="'.URL::route('admin.contact.deleteZone', $projectZone[$i]->id).'" style="color:red">Delete</a>';
                                    }
                                        $listProject .='</p>';
                                    }
                                    echo $listProject;

                                 ?>
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
	@stop
@stop