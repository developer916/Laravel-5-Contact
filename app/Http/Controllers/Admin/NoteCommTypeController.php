<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use  Input, Redirect, Session, Validator, DB, Mail,File, Request,Response,URL,Form;
use App\Model\NoteCommType as NoteCommTypeModel;
class NoteCommTypeController  extends Controller
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
        $param['pageNo'] = 13;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['noteCommType'] = NoteCommTypeModel::all();
        return View::make('admin.noteCommType.index')->with($param);
    }
    public function create(){
        $param['pageNo'] =13;
        return View::make('admin.noteCommType.create')->with($param);
    }

    public function store(){
        if (Input::has('noteCommType_id')) {
            $rules = [
                'noteCommType' => 'required',
            ];
        }else{
            $rules = [
                'noteCommType' => 'required |unique:noteCommType',
            ];
        }
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else{
            if (Input::has('noteCommType_id')) {
                $id = Input::get('noteCommType_id');
                $noteType = NoteCommTypeModel::find($id);
            }else{
                $noteType = new NoteCommTypeModel;
            }
            $noteType->noteCommType = Input::get('noteCommType');
            $noteType->save();
            $alert['msg'] = 'Note comm type has been saved successfully';
            $alert['type'] = 'success';
        }
        return Redirect::route('admin.noteCommType')->with('alert', $alert);
    }
    public function edit($id){
        $param['pageNo'] = 13;
        $param['noteCommType']=NoteCommTypeModel::find($id);
        return View::make('admin.noteCommType.edit')->with($param);
    }
    public function delete($id){
        try {
            NoteCommTypeModel::find($id)->delete();
            $alert['msg'] = 'This note comm type has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This note comm type  focus has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.noteCommType')->with('alert', $alert);
    }
}