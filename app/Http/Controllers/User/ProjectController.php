<?php
namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Model\Members;
use App\Model\Quote;
use Illuminate\Support\Facades\View;
use  Input, Redirect, Session, Validator, DB, Mail,File, Request,Response,URL,Form;
use App\Model\Members as MembersModel, App\Model\People as PeopleModel, App\Model\Project as ProjectModel, App\Model\Unit as UnitModel,
    App\Model\TempUnit as TempUnitModel, App\Model\VelocityUnit as VelocityUnitModel, App\Model\ProjectType as ProjectTypeModel, App\Model\Quote as QuoteModel,
  App\Model\Note as NoteModel, App\Model\NoteAssign as NoteAssignModel, App\Model\NoteCommType as NoteCommTypeModel, App\Model\ProjectZone as ProjectZoneModel,
    App\Model\NoteStatus as NoteStatusModel, App\Model\NoteType as NoteTypeModel, App\Model\NoteTypeDetails as NoteTypeDetailsModel, App\Model\Payment as PaymentModel;
class ProjectController extends Controller
{
    public function __construct()
    {
        $this->beforeFilter(function () {
            if (!Session::has('user_id')) {
                return Redirect::route('user.login');
            }
        });
    }
    /*******projects Add*********/
    public function add($peopleId){
        $user_id = Session::get('user_id');
        $param['member'] = MembersModel::find($user_id);
        $param['people'] = PeopleModel::find($peopleId);
        $param['pageNo'] = 7;
        $param['noteType'] =NoteTypeModel::whereRaw(true)->orderBy('notesType','asc')->get();
        $param['noteCommType'] = NoteCommTypeModel::whereRaw(true)->orderBy('noteCommType','asc')->get();
        $param['noteAssign'] = NoteAssignModel::whereRaw(true)->orderBy('noteAssign','asc')->get();
        $param['noteStatus'] = NoteStatusModel::whereRaw(true)->orderBy('notesStatus','asc')->get();
        $param['noteTypeDetails'] = NoteTypeDetailsModel::whereRaw(true)->orderBy('noteTypeDetails','asc')->get();
        $param['projectType'] = ProjectTypeModel::whereRaw(true)->orderBy('type','asc')->get();
        $param['unit'] = UnitModel::whereRaw(true)->orderBy('unit','asc')->get();
        $param['velocityUnit'] = VelocityUnitModel::whereRaw(true)->orderBy('unit','asc')->get();
        $param['tempUnit'] = TempUnitModel::whereRaw(true)->orderBy('unit','asc')->get();
        $note = NoteModel::whereRaw('peopleId=?' , array($peopleId))->get();
        $param['project'] = ProjectModel::whereRaw('peopleId =?',array($peopleId))->get();
        $param['members'] = MembersModel::whereRaw(true)->orderBy('first_name','asc')->get();
        $list = "";
        for($i=0; $i<count($note); $i++){
            $list .= '<div class="col-md-12 margin-bottom-20 forest-change-note-header">';
            if(strtoupper($note[$i]->noteCommType->noteCommType)== "PHONE") {
                $list .='<div class="panel panel-blue margin-bottom-40">';
            }else if (strtoupper($note[$i]->noteCommType->noteCommType)== "EMAIL") {
                $list .='<div class="panel panel-green margin-bottom-40">';
            }
            $list .='<div class="panel-heading forest-panel-heading-note">';
            $list .='<h3 class="panel-title forest-panel-title-note">';
            if(strtoupper($note[$i]->noteCommType->noteCommType)== "PHONE") {
                $list .='<img src="/images/Modern-Phone-icon.jpg" style="width:30px; height:30px;">';
            }else if (strtoupper($note[$i]->noteCommType->noteCommType)== "EMAIL") {
                $list .='<img src="/images/Email.png" style="width:30px; height:30px;">';
            }
            $list .='<a href = "javascript:void(0)" onclick = "onEditNoteChange('.$note[$i]->id.')">Edit</a>';
            $list .='<span>('. ucfirst($note[$i]->noteType->notesType) .')</span>';
            $list .='<span>('. substr($note[$i]->updated_at,0,16) .')</span>';
            $list .='<span>('. ucfirst($note[$i]->noteStatus->notesStatus ) .')</span>';
            $list .=' </h3>
                                </div>
                                <div class="panel-body">';
            $list .=$note[$i]->notes;
            $list .=' </div>
                             </div>
                          </div>';
        }
        $param['list'] = $list;
        return View::make('user.project.add')->with($param);
    }
    public function addProject(){
        if(Request::ajax()){
            $rules = [
                'projectName' => 'required',
            ];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Response::json(['result' => 'failed', 'error' => $validator->getMessageBag()->toArray()]);
            } else{
                $peopleId = Input::get('peopleId');
                $project = new ProjectModel;
                $project->projectName = Input::get('projectName');
                $project->peopleId = $peopleId;
                $project->projectDesc = Input::get('projectDescription');
                $project->save();
                $projectID = $project->id;
                $countResultDiv = Input::get('countResultDiv');
                if($countResultDiv == 1){
                    $projecTypeCheck = Input::get('projectType0');
                    if($projecTypeCheck !=""){
                        $i =0;
                        $ProjectZoneModelResult = new ProjectZoneModel;
                        $ProjectZoneModelResult->projectId = $projectID;
                        $ProjectZoneModelResult->ZoneName = '';
                        $ProjectZoneModelResult->projectZoneTypeId = Input::get('projectType' . $i);
                        $ProjectZoneModelResult->areaWidth = Input::get('w' . $i);
                        $ProjectZoneModelResult->areaLength = Input::get('l' . $i);
                        $ProjectZoneModelResult->areaHeight = Input::get('h' . $i);
                        $ProjectZoneModelResult->areaSquareFoot = Input::get('sq' . $i);
                        $ProjectZoneModelResult->AreaUnitId = Input::get('unit' . $i);
                        $ProjectZoneModelResult->freshAirVelocity = Input::get('airVelocity' . $i);
                        $ProjectZoneModelResult->freshAirVelocityUnitId = Input::get('airVelocityUnit' . $i);
                        $ProjectZoneModelResult->exhastAirVelocity = Input::get('exhaustVelocity' . $i);
                        $ProjectZoneModelResult->exhastAirVelocityUnitId = Input::get('exhaustVelocityUnit' . $i);
                        $ProjectZoneModelResult->freshAir = Input::get('freshAir' . $i);
                        $ProjectZoneModelResult->ductWidth = Input::get('ductW' . $i);
                        $ProjectZoneModelResult->ductHeight = Input::get('ductH' . $i);
                        $ProjectZoneModelResult->ductAirVelocity = Input::get('ductAirVelocity' . $i);
                        $ProjectZoneModelResult->OutdoorTemp = Input::get('outDoorTemp' . $i);
                        $ProjectZoneModelResult->OutdoorTempUnitId = Input::get('outTempUnit' . $i);
                        $ProjectZoneModelResult->TargetTemp = Input::get('targetTemp' . $i);
                        $ProjectZoneModelResult->TargetTempUnitId = Input::get('targetTempUnit' . $i);
                        $ProjectZoneModelResult->note = Input::get('notes' . $i);
                        $ProjectZoneModelResult->save();
                    }
                }else {
                    for ($i = 0; $i < ($countResultDiv); $i++) {
                        $projectType = Input::get('projectType' . $i);
                        $rules = [
                            'projectType' . $i => 'required',
                        ];

                        $validator = Validator::make(Input::all(), $rules);
                        if ($validator->fails()) {
                            return Response::json(['result' => 'failed', 'error' => $validator->getMessageBag()->toArray()]);
                        }
                    }
                    for ($i = 0; $i < ($countResultDiv); $i++) {
                        $ProjectZoneModelResult = new ProjectZoneModel;
                        $ProjectZoneModelResult->projectId = $projectID;
                        $ProjectZoneModelResult->ZoneName = '';
                        $ProjectZoneModelResult->projectZoneTypeId = Input::get('projectType' . $i);
                        $ProjectZoneModelResult->areaWidth = Input::get('w' . $i);
                        $ProjectZoneModelResult->areaLength = Input::get('l' . $i);
                        $ProjectZoneModelResult->areaHeight = Input::get('h' . $i);
                        $ProjectZoneModelResult->areaSquareFoot = Input::get('sq' . $i);
                        $ProjectZoneModelResult->AreaUnitId = Input::get('unit' . $i);
                        $ProjectZoneModelResult->freshAirVelocity = Input::get('airVelocity' . $i);
                        $ProjectZoneModelResult->freshAirVelocityUnitId = Input::get('airVelocityUnit' . $i);
                        $ProjectZoneModelResult->exhastAirVelocity = Input::get('exhaustVelocity' . $i);
                        $ProjectZoneModelResult->exhastAirVelocityUnitId = Input::get('exhaustVelocityUnit' . $i);
                        $ProjectZoneModelResult->freshAir = Input::get('freshAir' . $i);
                        $ProjectZoneModelResult->ductWidth = Input::get('ductW' . $i);
                        $ProjectZoneModelResult->ductHeight = Input::get('ductH' . $i);
                        $ProjectZoneModelResult->ductAirVelocity = Input::get('ductAirVelocity' . $i);
                        $ProjectZoneModelResult->OutdoorTemp = Input::get('outDoorTemp' . $i);
                        $ProjectZoneModelResult->OutdoorTempUnitId = Input::get('outTempUnit' . $i);
                        $ProjectZoneModelResult->TargetTemp = Input::get('targetTemp' . $i);
                        $ProjectZoneModelResult->TargetTempUnitId = Input::get('targetTempUnit' . $i);
                        $ProjectZoneModelResult->note = Input::get('notes' . $i);
                        $ProjectZoneModelResult->save();
                    }
                }
                $url = URL::route('user.project.add',$peopleId);
                return Response::json(['result' => 'success', 'url' => $url , 'message' =>"Your project has been saved successfully."]);
            }
        }
    }
    public function project($peopleId, $projectId){
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $user_id = Session::get('user_id');
        $param['member'] = MembersModel::find($user_id);
        $param['people'] = PeopleModel::find($peopleId);
        $param['pageNo'] = 7;
        $param['noteType'] =NoteTypeModel::whereRaw(true)->orderBy('notesType','asc')->get();
        $param['noteCommType'] = NoteCommTypeModel::whereRaw(true)->orderBy('noteCommType','asc')->get();
        $param['noteAssign'] = NoteAssignModel::whereRaw(true)->orderBy('noteAssign','asc')->get();
        $param['noteStatus'] = NoteStatusModel::whereRaw(true)->orderBy('notesStatus','asc')->get();
        $param['noteTypeDetails'] = NoteTypeDetailsModel::whereRaw(true)->orderBy('noteTypeDetails','asc')->get();
        $param['projectType'] = ProjectTypeModel::whereRaw(true)->orderBy('type','asc')->get();
        $param['unit'] = UnitModel::whereRaw(true)->orderBy('unit','asc')->get();
        $param['velocityUnit'] = VelocityUnitModel::whereRaw(true)->orderBy('unit','asc')->get();
        $param['tempUnit'] = TempUnitModel::whereRaw(true)->orderBy('unit','asc')->get();
        $param['members'] = MembersModel::whereRaw(true)->orderBy('first_name','asc')->get();
        $note = NoteModel::whereRaw('peopleId=?' , array($peopleId))->get();
        $param['project'] = ProjectModel::find($projectId);
        $param['note'] = $note;
        $param['projectZone'] = ProjectZoneModel::whereRaw('projectId =?', array($projectId))->get();
        $param['quote'] = QuoteModel::whereRaw('projectId =?', array($projectId))->get();
        $list = "";
        for($i=0; $i<count($note); $i++){
            $list .= '<div class="col-md-12 margin-bottom-20 forest-change-note-header">';
            if(strtoupper($note[$i]->noteCommType->noteCommType)== "PHONE") {
                $list .='<div class="panel panel-blue margin-bottom-40">';
            }else if (strtoupper($note[$i]->noteCommType->noteCommType)== "EMAIL") {
                $list .='<div class="panel panel-green margin-bottom-40">';
            }
            $list .='<div class="panel-heading forest-panel-heading-note">';
            $list .='<h3 class="panel-title forest-panel-title-note">';
            if(strtoupper($note[$i]->noteCommType->noteCommType)== "PHONE") {
                $list .='<img src="/images/Modern-Phone-icon.jpg" style="width:30px; height:30px;">';
            }else if (strtoupper($note[$i]->noteCommType->noteCommType)== "EMAIL") {
                $list .='<img src="/images/Email.png" style="width:30px; height:30px;">';
            }
            $list .='<a href = "javascript:void(0)" onclick = "onEditNoteChange('.$note[$i]->id.')">Edit</a>';
            $list .='<span>('. ucfirst($note[$i]->noteType->notesType) .')</span>';
            $list .='<span>('. substr($note[$i]->updated_at,0,16) .')</span>';
            $list .='<span>('. ucfirst($note[$i]->noteStatus->notesStatus ) .')</span>';
            $list .=' </h3>
                                </div>
                                <div class="panel-body">';
            $list .=$note[$i]->notes;
            $list .=' </div>
                             </div>
                          </div>';
        }
        $param['list'] = $list;
        return View::make('user.project.editQuote')->with($param);
    }

    /************************project edit*****************/
    public function editProjectSection(){
        if(Request::ajax()){
            $rules = [
                'projectName' => 'required',
            ];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Response::json(['result' => 'failed', 'error' => $validator->getMessageBag()->toArray()]);
            } else{
                $projectId = Input::get('projectId');
                $project = ProjectModel::find($projectId);
                $project->projectName = Input::get('projectName');
                $project->projectDesc = Input::get('projectDescription');
                $project->save();
                $projectList = ProjectModel::find($projectId);

                $list = "";
                $list .= Form::token();
                $list .='<input type="hidden" name="projectId" value="'.$project->id.'">
                                <div class="form-group">
                                    <label>Project Name</label>
                                    <input type="text" name="projectName" value="'.$project->projectName.'" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Project Name</label>
                                    <textarea type="text" name="projectDescription" class="form-control" rows="5">'.$project->projectDesc.'</textarea>
                                </div>
                                <div class="form-group text-right">
                                    <input type="button" class="btn-u btn-u-blue" value="Edit Project" onclick = "onSaveProject()">
                                </div>';
                return Response::json(['result' =>'success', 'message'=>"Project has been updated successfully", 'list' =>$list]);
            }
        }
    }
    /*****add zone******/
    public function addZones(){
        $countResultDiv = Input::get('countResultDiv');
        for($i=0; $i<($countResultDiv);$i++){
            $projectType = Input::get('projectType'.$i);
            $rules = [
                'projectType'.$i => 'required',
            ];

            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Response::json(['result' => 'failed', 'error' => $validator->getMessageBag()->toArray()]);
            }
        }
        $projectID = Input::get('projectId');
        for($i=0; $i<($countResultDiv); $i++) {
            $ProjectZoneModelResult = new ProjectZoneModel;
            $ProjectZoneModelResult->projectId = $projectID;
            $ProjectZoneModelResult->ZoneName = '';
            $ProjectZoneModelResult->projectZoneTypeId = Input::get('projectType' . $i);
            $ProjectZoneModelResult->areaWidth = Input::get('w' . $i);
            $ProjectZoneModelResult->areaLength = Input::get('l' . $i);
            $ProjectZoneModelResult->areaHeight = Input::get('h' . $i);
            $ProjectZoneModelResult->areaSquareFoot = Input::get('sq' . $i);
            $ProjectZoneModelResult->AreaUnitId = Input::get('unit' . $i);
            $ProjectZoneModelResult->freshAirVelocity = Input::get('airVelocity' . $i);
            $ProjectZoneModelResult->freshAirVelocityUnitId = Input::get('airVelocityUnit' . $i);
            $ProjectZoneModelResult->exhastAirVelocity = Input::get('exhaustVelocity' . $i);
            $ProjectZoneModelResult->exhastAirVelocityUnitId = Input::get('exhaustVelocityUnit' . $i);
            $ProjectZoneModelResult->freshAir = Input::get('freshAir' . $i);
            $ProjectZoneModelResult->ductWidth = Input::get('ductW' . $i);
            $ProjectZoneModelResult->ductHeight = Input::get('ductH' . $i);
            $ProjectZoneModelResult->ductAirVelocity = Input::get('ductAirVelocity' . $i);
            $ProjectZoneModelResult->OutdoorTemp = Input::get('outDoorTemp' . $i);
            $ProjectZoneModelResult->OutdoorTempUnitId = Input::get('outTempUnit' . $i);
            $ProjectZoneModelResult->TargetTemp = Input::get('targetTemp' . $i);
            $ProjectZoneModelResult->TargetTempUnitId = Input::get('targetTempUnit' . $i);
            $ProjectZoneModelResult->note = Input::get('notes' . $i);
            $ProjectZoneModelResult->save();
        }
            $projectZone = ProjectZoneModel::whereRaw('projectId =?' ,array($projectID))->get();
            $list = '';
            for($i=0; $i<count($projectZone); $i++){
                $list .='<p>';
                if(strtoupper($projectZone[$i]->ProjectType->type) == "DIRECT SPACE"){
                    $list .='<a href="javascript:void(0)" onclick="onChangeEditProject('.$projectZone[$i]->id.')">Edit</a> ';
                    $list .='<span>'.$projectZone[$i]->ProjectType->type.'</span> ';
                    $list .='<span>'.$projectZone[$i]->areaWidth.'W *</span> ';
                    $list .='<span>'.$projectZone[$i]->areaLength.'L *</span> ';
                    $list .='<span>'.$projectZone[$i]->areaHeight.'H</span> ';
                    if($projectZone[$i]->AreaUnitId != ""){
                        $list .='<span>('.$projectZone[$i]->areaSquareFoot.$projectZone[$i]->Square->unit.')</span> ';
                    }
                    $list .= "   ".'<a href="'.URL::route('user.project.deleteZone', $projectZone[$i]->id).'" style="color:red">Delete</a>';

                }else if(strtoupper($projectZone[$i]->ProjectType->type) == "In-Duct Duct Size"){
                    $list .='<a href="javascript:void(0)" onChangeEditProject('.$projectZone[$i]->id.')"></a> ';
                    $list .='<span>'.$projectZone[$i]->ProjectType->type.'</span> ';
                    $list .='<span>'.$projectZone[$i]->ductWidth.'W *</span> ';
                    $list .='<span>'.$projectZone[$i]->ductHeight.'H</span> ';
                    if($projectZone[$i]->AreaUnitId != ""){
                        $list .='<span>('.$projectZone[$i]->areaSquareFoot.$projectZone[$i]->Square->unit.')</span> ';
                    }
                    $list .='<span>OA:'.$projectZone[$i]->freshAir.'%</span> ';
                    $list .= "   ".'<a href="'.URL::route('user.project.deleteZone', $projectZone[$i]->id).'" style="color:red">Delete</a>';
                }else{
                    $list .='<a href="javascript:void(0)" onclick="onChangeEditProject('.$projectZone[$i]->id.')">Edit</a> ';
                    $list .='<span>'.$projectZone[$i]->ProjectType->type.'</span> ';
                    $list .='<span>'.$projectZone[$i]->areaWidth.'W *</span> ';
                    $list .='<span>'.$projectZone[$i]->areaLength.'L *</span> ';
                    $list .='<span>'.$projectZone[$i]->areaHeight.'H</span> ';
                    if($projectZone[$i]->AreaUnitId != ""){
                        $list .='<span>('.$projectZone[$i]->areaSquareFoot.$projectZone[$i]->Square->unit.')</span> ';
                    }
                    $list .= "   ".'<a href="'.URL::route('user.project.deleteZone', $projectZone[$i]->id).'" style="color:red">Delete</a>';
                }
                $list .='</p>';
            }

            return Response::json(['result' => 'success', 'message' => 'Project Zon has been saved successfully.', 'list'=>$list]);
    }
    public function editZones(){
        if(Request::ajax()){
            $projectZoneId = Input::get('id');
            $projectZone = ProjectZoneModel::find($projectZoneId);
            $projectType = ProjectTypeModel::whereRaw(true)->orderBy('type','asc')->get();
            $unit = UnitModel::whereRaw(true)->orderBy('unit','asc')->get();
            $velocityUnit = VelocityUnitModel::whereRaw(true)->orderBy('unit','asc')->get();
            $tempUnit = TempUnitModel::whereRaw(true)->orderBy('unit','asc')->get();
            $list ='';
            $list .='<div class="row">
                    <div class="col-md-12">
                        <form action ="'.URL::route('user.project.editZonesStore').'" method="post" id="editZoneDiv">';
                         $list .= Form::token();
                        $list .='<input type="hidden" name="zoneId" value="'.$projectZoneId.'">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Type</label>
                                    <select name="projectType" class="form-control" id="projectType">
                                        <option value="">Select Type</option>';
                                            foreach($projectType as $key=>$value){
                                                if($value->id == $projectZone->projectZoneTypeId){
                                                    $list .='<option value="'.$value->id.'" selected>'.$value->type.'</option>';
                                                }else{
                                                    $list .='<option value="'.$value->id.'">'.$value->type.'</option>';
                                                }
                                            }

                                $list .='</select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>W</label>
                                    <input type="text" name="w" class="form-control" id="w" value="'.$projectZone->areaWidth.'">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>L</label>
                                    <input type="text" name="l" class="form-control" id="l" value="'.$projectZone->areaLength.'">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>H</label>
                                    <input type="text" name="h" class="form-control" id="h" value="'.$projectZone->areaHeight.'">
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label>Unit</label>
                                    <select  name="unit" class="form-control" id="unit">
                                        <option value="">Unit</option>';
                                        foreach($unit as $key=>$value){
                                            if($value->id == $projectZone->AreaUnitId){
                                                $list .= '<option value="'.$value->id.'" selected>'.$value->unit.'</option>';
                                            }else{
                                                $list .= '<option value="'.$value->id.'">'.$value->unit.'</option>';
                                            }
                                        }
                        $list .= '
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Sq</label>
                                    <input type="text" name="sq" class="form-control" id="sq" value="'.$projectZone->areaSquareFoot.'">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fresh Air Velocity</label>
                                    <input type="text" class="form-control" name="airVelocity" placeholder="Fresh Air Velocity" id="airVelocity" value="'.$projectZone->freshAirVelocity.'">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Unit</label>
                                    <select class="form-control" name="airVelocityUnit" id="airVelocityUnit">
                                        <option value="">Unit</option>';
                                        foreach($velocityUnit as $key=>$value){
                                            if($value->id == $projectZone->freshAirVelocityUnitId){
                                                $list .= '<option value="'.$value->id.'" selected>'.$value->unit.'</option>';
                                            }else{
                                                $list .= '<option value="'.$value->id.'">'.$value->unit.'</option>';
                                            }
                                        }
                                        $list .='
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Exhaust Air Velocity</label>
                                    <input type="text" class="form-control" name="exhaustVelocity" placeholder="Exhaust Air Velocity" id="exhaustVelocity" value="'.$projectZone->exhastAirVelocity.'">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Unit</label>
                                    <select class="form-control" name="exhaustVelocityUnit" id="exhaustVelocityUnit">
                                        <option value="">Unit</option>';
                                        foreach($velocityUnit as $key=>$value){
                                            if($value->id == $projectZone->exhastAirVelocityUnitId){
                                                $list .= '<option value="'.$value->id.'" selected>'.$value->unit.'</option>';
                                            }else{
                                                $list .= '<option value="'.$value->id.'">'.$value->unit.'</option>';
                                            }
                                        }
                                   $list .=' </select>
                                </div>
                            </div>
                        </div>
                        <!-- Third line-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fresh Air %</label>
                                    <input type="text" name="freshAir" class="form-control" placeholder="Fresh Air %" id="freshAir" value="'.$projectZone->freshAir.'">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>W</label>
                                    <input type="text" name="ductW" class="form-control" placeholder="Duct Width" id="ductW" value="'.$projectZone->ductWidth.'">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>H</label>
                                    <input type="text" name="ductH" class="form-control" placeholder="Duct Height" id="ductH" value="'.$projectZone->ductHeight.'">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Duct Air Velocity</label>
                                    <input type="text" name="ductAirVelocity" class="form-control" placeholder="Duct Height" id="ductAirVelocity" value="'.$projectZone->ductAirVelocity.'">
                                </div>
                            </div>
                        </div>
                        <!-- third line -->
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Outdoor Temp</label>
                                    <input type="text" name="outDoorTemp" class="form-control" placeholder="Outdoor Temp" id="outDoorTemp"  value="'.$projectZone->OutdoorTemp.'">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>Unit</label>
                                <select name="outTempUnit" class="form-control" id="outTempUnit">
                                    <option>Unit</option>';
                                        foreach($tempUnit as $key=>$value){
                                            if($value->id == $projectZone->OutdoorTempUnitId){
                                                $list .= '<option value="'.$value->id.'" selected>'.$value->unit.'</option>';
                                            }else{
                                                $list .= '<option value="'.$value->id.'">'.$value->unit.'</option>';
                                            }
                                        }
                                $list .='</select>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Target Temp</label>
                                    <input type="text" name="targetTemp" class="form-control" placeholder="Target Temp" id="targetTemp" value="'.$projectZone->TargetTemp.'">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>Unit</label>
                                <select name="targetTempUnit" class="form-control" id="targetTempUnit">
                                    <option>Unit</option>';
                                    foreach($tempUnit as $key=>$value){
                                        if($value->id == $projectZone->TargetTempUnitId){
                                            $list .= '<option value="'.$value->id.'" selected>'.$value->unit.'</option>';
                                        }else{
                                            $list .= '<option value="'.$value->id.'">'.$value->unit.'</option>';
                                        }
                                    }
                                $list .='</select>
                            </div>
                        </div>
                        <div class="row margin-bottom-20">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Notes</label>
                                    <textarea class="form-control" name="notes" placeholder="Notes" rows="5" id="notes">'.$projectZone->note.'</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <input type="button" class="btn-u btn-u-blue" onclick="onEditZoneStore()" value="Edit Zone">
                                <button type="button" class="btn-u btn-u-red"  data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                 </div>
                 </div>';
            return Response::json(['result' => 'success',  'list'=>$list]);
        }
    }
    public function editZonesStore(){
        if(Request::ajax()){
            $rules = [
                'projectType' => 'required',
            ];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Response::json(['result' => 'failed', 'error' => $validator->getMessageBag()->toArray()]);
            } else{
                $zoneId = Input::get('zoneId');
                $ProjectZoneModelResult = ProjectZoneModel::find($zoneId);
                $projectID = $ProjectZoneModelResult->projectId;
                $ProjectZoneModelResult->projectZoneTypeId = Input::get('projectType');
                $ProjectZoneModelResult->areaWidth = Input::get('w');
                $ProjectZoneModelResult->areaLength = Input::get('l');
                $ProjectZoneModelResult->areaHeight = Input::get('h');
                $ProjectZoneModelResult->areaSquareFoot = Input::get('sq');
                $ProjectZoneModelResult->AreaUnitId = Input::get('unit');
                $ProjectZoneModelResult->freshAirVelocity = Input::get('airVelocity');
                $ProjectZoneModelResult->freshAirVelocityUnitId = Input::get('airVelocityUnit');
                $ProjectZoneModelResult->exhastAirVelocity = Input::get('exhaustVelocity');
                $ProjectZoneModelResult->exhastAirVelocityUnitId = Input::get('exhaustVelocityUnit');
                $ProjectZoneModelResult->freshAir = Input::get('freshAir');
                $ProjectZoneModelResult->ductWidth = Input::get('ductW');
                $ProjectZoneModelResult->ductHeight = Input::get('ductH');
                $ProjectZoneModelResult->ductAirVelocity = Input::get('ductAirVelocity');
                $ProjectZoneModelResult->OutdoorTemp = Input::get('outDoorTemp');
                $ProjectZoneModelResult->OutdoorTempUnitId = Input::get('outTempUnit');
                $ProjectZoneModelResult->TargetTemp = Input::get('targetTemp');
                $ProjectZoneModelResult->TargetTempUnitId = Input::get('targetTempUnit');
                $ProjectZoneModelResult->note = Input::get('notes');
                $ProjectZoneModelResult->save();
                $projectZone = ProjectZoneModel::whereRaw('projectId =?' ,array($projectID))->get();
                $list = '';
                for($i=0; $i<count($projectZone); $i++){
                    $list .='<p>';
                    if(strtoupper($projectZone[$i]->ProjectType->type) == "DIRECT SPACE"){
                        $list .='<a href="javascript:void(0)" onclick="onChangeEditProject('.$projectZone[$i]->id.')">Edit</a>';
                        $list .='<span>'.$projectZone[$i]->ProjectType->type.'</span> ';
                        $list .='<span>'.$projectZone[$i]->areaWidth.'W *</span> ';
                        $list .='<span>'.$projectZone[$i]->areaLength.'L *</span> ';
                        $list .='<span>'.$projectZone[$i]->areaHeight.'H</span> ';
                        if($projectZone[$i]->AreaUnitId != ""){
                            $list .='<span>('.$projectZone[$i]->areaSquareFoot.$projectZone[$i]->Square->unit.')</span>';
                        }
                        $list .= "   ".'<a href="'.URL::route('user.project.deleteZone', $projectZone[$i]->id).'" style="color:red">Delete</a>';
                    }else if(strtoupper($projectZone[$i]->ProjectType->type) == "In-Duct Duct Size"){
                        $list .='<a href="javascript:void(0)" onChangeEditProject('.$projectZone[$i]->id.')"></a>';
                        $list .='<span>'.$projectZone[$i]->ProjectType->type.'</span> ';
                        $list .='<span>'.$projectZone[$i]->ductWidth.'W *</span> ';
                        $list .='<span>'.$projectZone[$i]->ductHeight.'H</span> ';
                        if($projectZone[$i]->AreaUnitId != ""){
                            $list .='<span>('.$projectZone[$i]->areaSquareFoot.$projectZone[$i]->Square->unit.')</span> ';
                        }
                        $list .='<span>OA:'.$projectZone[$i]->freshAir.'%</span>';
                        $list .= "   ".'<a href="'.URL::route('user.project.deleteZone', $projectZone[$i]->id).'" style="color:red">Delete</a>';
                    }else{
                        $list .='<a href="javascript:void(0)" onclick="onChangeEditProject('.$projectZone[$i]->id.')">Edit</a> ';
                        $list .='Zone '.($i+1).': ';
                        $list .='<span>'.$projectZone[$i]->ProjectType->type.'</span> ';
                        $list .='<span>'.$projectZone[$i]->areaWidth.'W *</span>  ';
                        $list .='<span>'.$projectZone[$i]->areaLength.'L *</span> ';
                        $list .='<span>'.$projectZone[$i]->areaHeight.'H</span> ';
                        if($projectZone[$i]->AreaUnitId != ""){
                            $list .='<span>('.$projectZone[$i]->areaSquareFoot.$projectZone[$i]->Square->unit.')</span> ';
                        }
                        $list .= "   ".'<a href="'.URL::route('user.project.deleteZone', $projectZone[$i]->id).'" style="color:red">Delete</a>';
                    }
                    $list .='</p>';
                }

                return Response::json(['result' => 'success',  'list'=>$list , 'message' =>"Project zone has been update successfully."]);
            }
        }
    }
    public function addQuote($peopleId, $projectId){
        $user_id = Session::get('user_id');
        $param['member'] = MembersModel::find($user_id);
        $param['people'] = PeopleModel::find($peopleId);
        $param['project'] = ProjectModel::find($projectId);
        $param['quote'] = QuoteModel::whereRaw('projectId = ? ',array($projectId))->get();
        $param['members'] = Members::whereRaw(true)->orderBy('first_name','asc')->get();
        $param['payment'] = PaymentModel::whereRaw(true)->orderBy('payment','asc')->get();
        return View::make('user.project.addquote')->with($param);
    }
    public function storeQuote(){
         if(Request::ajax()){
             if(Input::has('quoteListId')) {
                 $rules = [
                     'quoteName' => 'required ',
                 ];
             }else{
                 $rules = [
                     'quoteName' => 'required | unique:quote',
                 ];
             }

             $validator = Validator::make(Input::all(), $rules);
             if ($validator->fails()) {
                 return Response::json(['result' => 'failed', 'error' => $validator->getMessageBag()->toArray()]);
             } else {
                 $quoteListId ='';
                 if(Input::has('quoteListId')){
                     $quoteListId= Input::get('quoteListId');
                     $quote = QuoteModel::find($quoteListId);
                 }else{
                     $quote = new QuoteModel;
                 }
                 $quote->quoteName = Input::get('quoteName');
                 $quote->projectId = Input::get('projectId');
                 $quote->quoteDesc = Input::get('quoteDescription');
                 $quote->payment = Input::get('payment');
                 $quote->assign = Input::get('assosiate');
                 $quote->save();
                 $projectId = Input::get('projectId');
                 $project = ProjectModel::find($projectId);
                 $list = '';
                 $quote = QuoteModel::whereRaw('projectId =?', array($projectId))->get();
                 for ($i = 0; $i < count($quote); $i++) {
                     $list .= '<p>';
                     $list .= '<a href="' . URL::route('user.project.quote', array($project->peopleId, $project->id, $quote[$i]->id)) . '">' . $quote[$i]->quoteName . '</a>';
                     $list .= '</p>';
                 }
                 if($quoteListId !=""){
                     return Response::json(['result' => 'success', 'list' => $list, 'message' => "Quote has been update successfully.", 'quoteList' =>'1']);
                 }else{
                     return Response::json(['result' => 'success', 'list' => $list, 'message' => "Quote has been update successfully.", 'quoteList' =>'0s']);
                 }

             }
         }
    }
    public function quote($peopleId, $projectId, $quoteId){
        $user_id = Session::get('user_id');
        $param['member'] = MembersModel::find($user_id);
        $param['people'] = PeopleModel::find($peopleId);
        $param['project'] = ProjectModel::find($projectId);
        $param['quote'] = QuoteModel::whereRaw('projectId = ? ',array($projectId))->get();
        $param['members'] = Members::whereRaw(true)->orderBy('first_name','asc')->get();
        $param['payment'] = PaymentModel::whereRaw(true)->orderBy('payment','asc')->get();
        $param['quoteItem'] = QuoteModel::find($quoteId);
        return View::make('user.project.quoteEdit')->with($param);
    }
    public function deleteZone($id){
            $projectZoneList = ProjectZoneModel::find($id);
            $projectID = $projectZoneList->projectId;
            $project = ProjectModel::find($projectID);
            $peopleID = $project->peopleId;
        try {
            ProjectZoneModel::find($id)->delete();
            $alert['msg'] = 'This project zone has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This project zone has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('user.project',array($peopleID, $projectID))->with('alert', $alert);
    }
}