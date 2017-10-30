<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use  Input, Redirect, Session, Validator, DB, Mail,File, Request,Response,URL,Form;
use App\Model\Members as MembersModel, App\Model\Address as AddressModel , App\Model\Category as CategoryModel , App\Model\People as PeopleModel
    , App\Model\Company as CompanyModel , App\Model\Industry as IndustryModel , App\Model\Tags as TagsModel, App\Model\Type as TypeModel, App\Model\ProjectZone as ProjectZoneModel,
    App\Model\TagPeople as TagPeopleModel,App\Model\Note as NoteModel, App\Model\NoteAssign as NoteAssignModel, App\Model\NoteCommType as NoteCommTypeModel,
    App\Model\NoteStatus as NoteStatusModel, App\Model\NoteType as NoteTypeModel, App\Model\NoteTypeDetails as NoteTypeDetailsModel, App\Model\Project as ProjectModel,
    App\Model\Quote as QuoteModel,App\Model\Payment as PaymentModel;
class ContactController  extends Controller
{
    public function __construct()
    {
        $this->beforeFilter(function () {
            if (!Session::has('admin_id')) {
                return Redirect::route('admin.auth.login');
            }
        });
    }

    public function index(){
        $param['pageNo'] = 61;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['contact'] = PeopleModel::all();
        return View::make('admin.contact.index')->with($param);
    }
    public function view($id){
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['pageNo'] = 61;
        $param['people'] = PeopleModel::find($id);
        $param['selectTags'] = TagPeopleModel::whereRaw('peopleId =?', array($id))->get();
        $param['project'] = ProjectModel::whereRaw('peopleId = ?' , array($id))->get();
        $param['category'] = CategoryModel::whereRaw(true)->orderBy('category','asc')->get();
        $param['industry'] = IndustryModel::whereRaw(true)->orderBy('industry','asc')->get();
        $param['tags'] = TagsModel::whereRaw(true)->orderBy('tags','asc')->get();
        $param['company'] = CompanyModel::whereRaw(true)->orderBy('companyName','asc')->get();
        $param['type'] = TypeModel::whereRaw(true)->orderBy('type','asc')->get();
        $param['selectTags'] = TagPeopleModel::whereRaw('peopleId =?', array($id))->get();
        $param['members'] = MembersModel::whereRaw(true)->orderBy('first_name','asc')->get();
        $param['project'] = ProjectModel::whereRaw('peopleId =?' ,array($id))->get();
        $projectIDs = ProjectModel::whereRaw('peopleId =?' ,array($id))->get();
        $k =0;
        $listQuote = array();
        for($i=0; $i<count($projectIDs); $i++){
            $quotes = QuoteModel::whereRaw('projectId = ?', array($projectIDs[$i]->id))->get();
            for($j=0; $j<count($quotes); $j++){
                $listQuote[$k] = $quotes[$j];
                $k++;
            }
        }
        $param['listQuote'] = $listQuote;
        $param['note'] = NoteModel::whereRaw('peopleId=?' , array($id))->get();
        $note = NoteModel::whereRaw('peopleId=?' , array($id))->get();
        $list = "";
        for($i=0; $i<count($note); $i++){
            $list .= '<div class="col-md-12 margin-bottom-10 forest-change-note-header">';
            if(strtoupper($note[$i]->noteCommType->noteCommType)== "PHONE") {
                $list .='<div class="panel panel-blue margin-bottom-20" >';
            }else if (strtoupper($note[$i]->noteCommType->noteCommType)== "EMAIL") {
                $list .='<div class="panel panel-green margin-bottom-20" >';
            }
            if(strtoupper($note[$i]->noteCommType->noteCommType)== "PHONE") {
                $list .= '<div class="panel-heading forest-panel-heading-note" style="background: #3498db; ">';
            }else if (strtoupper($note[$i]->noteCommType->noteCommType)== "EMAIL") {
                $list .= '<div class="panel-heading forest-panel-heading-note" style="background: #2ecc71;">';
            }
            $list .='<h3 class="panel-title forest-panel-title-note">';
            if(strtoupper($note[$i]->noteCommType->noteCommType)== "PHONE") {
                $list .='<img src="/images/Modern-Phone-icon.jpg" style="width:30px; height:30px;">';
            }else if (strtoupper($note[$i]->noteCommType->noteCommType)== "EMAIL") {
                $list .='<img src="/images/Email.png" style="width:30px; height:30px;">';
            }
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
        return View::make('admin.contact.detail')->with($param);
    }
    public function deleteProject($id,$slug){
        $project = ProjectModel::find($id);
        $peopleID = $project->peopleId;
        try {
            ProjectModel::find($id)->delete();
            $alert['msg'] = 'Project has been deleted successfully';
            $alert['type'] = 'success';
            $alert['list'] = 'project';
        } catch(\Exception $ex) {
            $alert['msg'] = 'Project has been already used';
            $alert['type'] = 'danger';
            $alert['list'] = 'project';
        }
        if($slug == "main"){
            return Redirect::route('admin.contact.view',array($peopleID))->with('alert', $alert);
        }else if($slug =="add"){
            return Redirect::route('user.project.add',array($peopleID))->with('alert', $alert);
        }

    }
    public function deleteQuote($id, $slug){
        $quote = QuoteModel::find($id);
        $projectID = $quote->projectId;
        $project = ProjectModel::find($projectID);
        $peopleID = $project->peopleId;
        try {
            QuoteModel::find($id)->delete();
            $alert['msg'] = 'Quote has been deleted successfully';
            $alert['type'] = 'success';
            $alert['list'] = 'quote';
        } catch(\Exception $ex) {
            $alert['msg'] = 'Quote has been already used';
            $alert['type'] = 'danger';
            $alert['list'] = 'quote';
        }
        if($slug == "main"){
            return Redirect::route('admin.contact.view',array($peopleID))->with('alert', $alert);
        }else if($slug =="project"){
            return Redirect::route('admin.contact.project',array($peopleID,$projectID))->with('alert', $alert);
        }else if($slug == "addQuote"){
            return Redirect::route('user.project.addQuote',array($peopleID,$projectID))->with('alert', $alert);
        }else if($slug == "editQuote"){
            return Redirect::route('admin.contact.project',array($peopleID,$projectID))->with('alert', $alert);
        }
    }
    public function project($peopleId, $projectId){
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['pageNo'] = 61;
        $param['people'] = PeopleModel::find($peopleId);
        $param['project'] = ProjectModel::find($projectId);
        $param['projectZone'] = ProjectZoneModel::whereRaw('projectId =?', array($projectId))->get();
        $param['quote'] = QuoteModel::whereRaw('projectId =?', array($projectId))->get();
        $param['note'] = NoteModel::whereRaw('peopleId=?' , array($peopleId))->get();
        $note = NoteModel::whereRaw('peopleId=?' , array($peopleId))->get();
        $list = "";
        for($i=0; $i<count($note); $i++){
            $list .= '<div class="col-md-12 margin-bottom-10 forest-change-note-header">';
            if(strtoupper($note[$i]->noteCommType->noteCommType)== "PHONE") {
                $list .='<div class="panel panel-blue margin-bottom-20" >';
            }else if (strtoupper($note[$i]->noteCommType->noteCommType)== "EMAIL") {
                $list .='<div class="panel panel-green margin-bottom-20" >';
            }
            if(strtoupper($note[$i]->noteCommType->noteCommType)== "PHONE") {
                $list .= '<div class="panel-heading forest-panel-heading-note" style="background: #3498db; ">';
            }else if (strtoupper($note[$i]->noteCommType->noteCommType)== "EMAIL") {
                $list .= '<div class="panel-heading forest-panel-heading-note" style="background: #2ecc71;">';
            }
            $list .='<h3 class="panel-title forest-panel-title-note">';
            if(strtoupper($note[$i]->noteCommType->noteCommType)== "PHONE") {
                $list .='<img src="/images/Modern-Phone-icon.jpg" style="width:30px; height:30px;">';
            }else if (strtoupper($note[$i]->noteCommType->noteCommType)== "EMAIL") {
                $list .='<img src="/images/Email.png" style="width:30px; height:30px;">';
            }
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
        return View::make('admin.contact.project')->with($param);
    }
    public function quote($peopleId, $projectId, $quoteId){
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['pageNo'] = 61;
        $user_id = Session::get('user_id');
        $param['member'] = MembersModel::find($user_id);
        $param['people'] = PeopleModel::find($peopleId);
        $param['project'] = ProjectModel::find($projectId);
        $param['quote'] = QuoteModel::whereRaw('projectId = ? ',array($projectId))->get();
        $param['members'] = MembersModel::whereRaw(true)->orderBy('first_name','asc')->get();
        $param['payment'] = PaymentModel::whereRaw(true)->orderBy('payment','asc')->get();
        $param['quoteItem'] = QuoteModel::find($quoteId);
        return View::make('admin.contact.quote')->with($param);
    }
    public function delete($id){
        try {
            $list  = ProjectModel::whereRaw('peopleId = ?', array($id))->get();
            for($i =0; $i<count($list); $i++){
                QuoteModel::whereRaw('projectId = ?', array($list[$i]->id))->delete();
            }
            ProjectModel::whereRaw('peopleId = ?', array($id))->delete();
            PeopleModel::find($id)->delete();
            $alert['msg'] = 'This contact has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This contact  focus has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.contact')->with('alert', $alert);
    }
    public function deleteZone($id){
        $projectZoneList = ProjectZoneModel::find($id);
        $projectID = $projectZoneList->projectId;
        $project = ProjectModel::find($projectID);
        $peopleID = $project->peopleId;
        try {
            ProjectZoneModel::find($id)->delete();
            $alert['msg'] = 'This project zone has been deleted successfully';
            $alert['list'] ='zone';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This project zone has been already used';
            $alert['list'] ='zone';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.contact.project',array($peopleID, $projectID))->with('alert', $alert);
    }
}