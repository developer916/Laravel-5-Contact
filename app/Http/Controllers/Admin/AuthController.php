<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use  Input, Redirect, Session, Validator, DB, Mail,File, Request,Response,URL,Form;
use App\Model\AdminUser as AdminUserModel;
class AuthController extends Controller{
    public function index() {
        if (Session::has('admin_id')) {
            return Redirect::route('admin.dashboard');
        } else {
            return Redirect::route('admin.auth.login');
        }
    }
    public function login() {
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
            return View::make('admin.auth.login')->with($param);
        } else {
            return View::make('admin.auth.login');
        }
    }
    public function doLogin()
    {
        $rules = ['username' => 'required',
            'password' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $name = Input::get('username');
            $password = Input::get('password');
            $user = AdminuserModel::whereRaw('AdminUserName = ? and AdminUserPassword = md5(?) and is_active = ?', array($name, $password, '1'))->get();
            if (count($user) != 0) {
                Session::set('admin_id', 1);
                //Session::set('user_id',0);
                return Redirect::route('admin.dashboard');
            } else {
                $alert['msg'] = 'Invalid username and password';
                $alert['type'] = 'danger';
                return Redirect::route('admin.auth.login')->with('alert', $alert);
            }
        }
    }
    public function logout() {
        Session::forget(array('admin_id','user_id'));
        return Redirect::route('admin.auth.login');
    }

}
?>