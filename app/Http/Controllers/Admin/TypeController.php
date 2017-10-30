<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use  Input, Redirect, Session, Validator, DB, Mail,File, Request,Response,URL,Form;
use App\Model\ProjectType as ProjectTypeModel;
class TypeController  extends Controller
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
        $param['pageNo'] = 31;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['projectType'] = ProjectTypeModel::all();
        return View::make('admin.type.index')->with($param);
    }
    public function create(){
        $param['pageNo'] =31;
        return View::make('admin.type.create')->with($param);
    }
    public function store(){
        if (Input::has('type_id')) {
            $rules = [
                'type' => 'required',
            ];
        }else{
            $rules = [
                'type' => 'required |unique:projecttype',
            ];
        }
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else{
            if (Input::has('type_id')) {
                $id = Input::get('type_id');
                $payment = ProjectTypeModel::find($id);
            }else{
                $payment = new ProjectTypeModel;
            }
            $payment->type = Input::get('type');
            $payment->save();
            $alert['msg'] = 'Project type  has been saved successfully';
            $alert['type'] = 'success';
        }
        return Redirect::route('admin.type')->with('alert', $alert);
    }
    public function edit($id){
        $param['pageNo'] = 31;
        $param['type']=ProjectTypeModel::find($id);
        return View::make('admin.type.edit')->with($param);
    }
    public function delete($id){
        try {
            ProjectTypeModel::find($id)->delete();
            $alert['msg'] = 'This project type has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This project type  focus has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.type')->with('alert', $alert);
    }
}