<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use  Input, Redirect, Session, Validator, DB, Mail,File, Request,Response,URL,Form;
use App\Model\Unit as UnitModel;
class SquareController  extends Controller
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
        $param['pageNo'] = 21;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['unit'] = UnitModel::all();
        return View::make('admin.square.index')->with($param);
    }
    public function create(){
        $param['pageNo'] =21;
        return View::make('admin.square.create')->with($param);
    }
    public function store(){
        if (Input::has('unit_id')) {
            $rules = [
                'unit' => 'required',
            ];
        }else{
            $rules = [
                'unit' => 'required |unique:unit',
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
                $noteType = UnitModel::find($id);
            }else{
                $noteType = new UnitModel;
            }
            $noteType->unit = Input::get('unit');
            $noteType->save();
            $alert['msg'] = 'Square unit has been saved successfully';
            $alert['type'] = 'success';
        }
        return Redirect::route('admin.square')->with('alert', $alert);
    }
    public function edit($id){
        $param['pageNo'] = 21;
        $param['unit']=UnitModel::find($id);
        return View::make('admin.square.edit')->with($param);
    }
    public function delete($id){
        try {
            UnitModel::find($id)->delete();
            $alert['msg'] = 'This square unit has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This square unit  focus has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.square')->with('alert', $alert);
    }

}
