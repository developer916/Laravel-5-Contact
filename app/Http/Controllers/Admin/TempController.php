<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use  Input, Redirect, Session, Validator, DB, Mail,File, Request,Response,URL,Form;
use App\Model\TempUnit as TempUnitModel;
class TempController  extends Controller
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
        $param['pageNo'] = 22;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['unit'] = TempUnitModel::all();
        return View::make('admin.temp.index')->with($param);
    }
    public function create(){
        $param['pageNo'] =22;
        return View::make('admin.temp.create')->with($param);
    }
    public function store(){
        if (Input::has('unit_id')) {
            $rules = [
                'unit' => 'required',
            ];
        }else{
            $rules = [
                'unit' => 'required |unique:tempunit',
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
                $noteType = TempUnitModel::find($id);
            }else{
                $noteType = new TempUnitModel;
            }
            $noteType->unit = Input::get('unit');
            $noteType->save();
            $alert['msg'] = 'Temp unit has been saved successfully';
            $alert['type'] = 'success';
        }
        return Redirect::route('admin.temp')->with('alert', $alert);
    }
    public function edit($id){
        $param['pageNo'] = 22;
        $param['unit']=TempUnitModel::find($id);
        return View::make('admin.temp.edit')->with($param);
    }
    public function delete($id){
        try {
            TempUnitModel::find($id)->delete();
            $alert['msg'] = 'This temp unit has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This temp unit  focus has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.temp')->with('alert', $alert);
    }
}