<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use  Input, Redirect, Session, Validator, DB, Mail,File, Request,Response,URL,Form;
use App\Model\NoteStatus as NoteStatusModel;
class NoteStatusController  extends Controller
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
        $param['pageNo'] = 14;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['noteStatus'] = NoteStatusModel::all();
        return View::make('admin.noteStatus.index')->with($param);
    }
    public function create(){
        $param['pageNo'] =14;
        return View::make('admin.noteStatus.create')->with($param);
    }
    public function store(){
        if (Input::has('noteStatus_id')) {
            $rules = [
                'notesStatus' => 'required',
            ];
        }else{
            $rules = [
                'notesStatus' => 'required |unique:noteStatus',
            ];
        }
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else{
            if (Input::has('noteStatus_id')) {
                $id = Input::get('noteStatus_id');
                $noteType = NoteStatusModel::find($id);
            }else{
                $noteType = new NoteStatusModel;
            }
            $noteType->notesStatus = Input::get('notesStatus');
            $noteType->save();
            $alert['msg'] = 'Note status has been saved successfully';
            $alert['type'] = 'success';
        }
        return Redirect::route('admin.noteStatus')->with('alert', $alert);
    }
    public function edit($id){
        $param['pageNo'] = 14;
        $param['noteStatus']=NoteStatusModel::find($id);
        return View::make('admin.noteStatus.edit')->with($param);
    }
    public function delete($id){
        try {
            NoteStatusModel::find($id)->delete();
            $alert['msg'] = 'This note status has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This note status  focus has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.noteStatus')->with('alert', $alert);
    }
}