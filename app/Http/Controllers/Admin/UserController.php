<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use  Input, Redirect, Session, Validator, DB, Mail,File, Request,Response,URL,Form;
use App\Model\Members as MembersModel;
class UserController  extends Controller
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
        $param['pageNo'] = 51;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['members'] = MembersModel::all();
        return View::make('admin.member.index')->with($param);
    }
    public function create(){
        $param['pageNo'] =51;
        return View::make('admin.member.create')->with($param);
    }
    public function delete($id){
        try {
            MembersModel::find($id)->delete();
            $alert['msg'] = 'This user  has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This user  focus has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.member')->with('alert', $alert);
    }
}