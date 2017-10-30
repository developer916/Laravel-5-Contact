<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use  Input, Redirect, Session, Validator, DB, Mail,File, Request,Response,URL,Form;
use App\Model\NoteType as NoteTypeModel;
class NoteTypeController extends Controller
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
        $param['pageNo'] =11;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['noteType'] = NoteTypeModel::all();
        return View::make('admin.noteType.index')->with($param);
    }
    public function create(){
        $param['pageNo'] =11;
        return View::make('admin.noteType.create')->with($param);
    }
    public function store(){
        if (Input::has('noteType_id')) {
            $rules = [
                'notesType' => 'required',
            ];
        }else{
            $rules = [
                'notesType' => 'required |unique:noteType',
            ];
        }
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else{
            if (Input::has('noteType_id')) {
                $id = Input::get('noteType_id');
                $noteType = NoteTypeModel::find($id);
            }else{
                $noteType = new NoteTypeModel;
            }
            $noteType->notesType = Input::get('notesType');
            $noteType->save();
            $alert['msg'] = 'Note type has been saved successfully';
            $alert['type'] = 'success';
        }
        return Redirect::route('admin.noteType')->with('alert', $alert);
    }
    public function edit($id){
        $param['pageNo'] = 11;
        $param['noteType']=NoteTypeModel::find($id);
        return View::make('admin.noteType.edit')->with($param);
    }
    public function delete($id){
        try {
            NoteTypeModel::find($id)->delete();
            $alert['msg'] = 'This note type has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This note type  focus has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.noteType')->with('alert', $alert);
    }
}