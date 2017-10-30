<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use  Input, Redirect, Session, Validator, DB, Mail,File, Request,Response,URL,Form;
use App\Model\Members as MembersModel, App\Model\Note as NoteModel, App\Model\NoteAssign as NoteAssignModel, App\Model\NoteCommType as NoteCommTypeModel,
    App\Model\NoteStatus as NoteStatusModel, App\Model\NoteType as NoteTypeModel, App\Model\NoteTypeDetails as NoteTypeDetailsModel, App\Model\Project as ProjectModel, App\Model\Quote as QuoteModel;
class NoteController  extends Controller
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
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['pageNo']= 12;
        $param['members'] = MembersModel::whereRaw(true)->orderBy('first_name','asc')->get();

        /****note base*******/
        $param['noteType'] =NoteTypeModel::whereRaw(true)->orderBy('notesType','asc')->get();
        $param['noteCommType'] = NoteCommTypeModel::whereRaw(true)->orderBy('noteCommType','asc')->get();
        $param['noteAssign'] = NoteAssignModel::whereRaw(true)->orderBy('noteAssign','asc')->get();
        $param['noteStatus'] = NoteStatusModel::whereRaw(true)->orderBy('notesStatus','asc')->get();
        $param['noteTypeDetails'] = NoteTypeDetailsModel::whereRaw(true)->orderBy('noteTypeDetails','asc')->get();
        /****note ***/
        $param['note'] = NoteModel::paginate(10);
        return View::make('admin.note.index')->with($param);
    }
    public function delete($id){
        try {
            NoteModel::find($id)->delete();
            $alert['msg'] = 'This note  has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This note   focus has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.note')->with('alert', $alert);
    }
}