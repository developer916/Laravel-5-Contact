<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use  Input, Redirect, Session, Validator, DB, Mail,File, Request,Response,URL,Form;
use App\Model\VelocityUnit as VelocityUnitModel;
class VelocityController  extends Controller
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
        $param['pageNo'] = 23;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['unit'] = VelocityUnitModel::all();
        return View::make('admin.velocity.index')->with($param);
    }
    public function create(){
        $param['pageNo'] =23;
        return View::make('admin.velocity.create')->with($param);
    }
    public function store(){
        if (Input::has('unit_id')) {
            $rules = [
                'unit' => 'required',
            ];
        }else{
            $rules = [
                'unit' => 'required |unique:velocityunit',
            ];
        }
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else{
            if (Input::has('unit_id')) {
                $id = Input::get('unit_id');
                $noteType = VelocityUnitModel::find($id);
            }else{
                $noteType = new VelocityUnitModel;
            }
            $noteType->unit = Input::get('unit');
            $noteType->save();
            $alert['msg'] = 'Velocity unit has been saved successfully';
            $alert['type'] = 'success';
        }
        return Redirect::route('admin.velocity')->with('alert', $alert);
    }
    public function edit($id){
        $param['pageNo'] = 23;
        $param['unit']=VelocityUnitModel::find($id);
        return View::make('admin.velocity.edit')->with($param);
    }
    public function delete($id){
        try {
            VelocityUnitModel::find($id)->delete();
            $alert['msg'] = 'This velocity unit has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This velocity unit  focus has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.velocity')->with('alert', $alert);
    }
}