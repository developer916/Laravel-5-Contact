<?php namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Model\Members;
use Illuminate\Support\Facades\View;
use  Input, Redirect, Session, Validator, DB, Mail,File, Request,Response;
use App\Model\Members as MembersModel;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->beforeFilter(function () {
            if (!Session::has('user_id')) {
                return Redirect::route('user.login');
            }
        });
    }
    public function index(){
        $param['pageNo'] = 10;
        $user_id = Session::get('user_id');
        $param['member'] = Members::find($user_id);
        return View::make('user.dashboard.dashboard')->with($param);
    }
}