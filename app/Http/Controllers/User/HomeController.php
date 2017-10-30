<?php namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use  Input, Redirect, Session, Validator, DB, Mail,File, Request,Response;
use App\Model\Members as MembersModel;
 class HomeController extends Controller{
     public  function index()
     {
         if(!Session::has('user_id')){
             return Redirect::route('user.login');
         }else{
             return Redirect::route('user.dashboard');
         }
     }
     public function login(){
         if ($alert = Session::get('alert')) {
             $param['alert'] = $alert;
         }
         $param['pageNo'] = 2;
         return View::make('user.auth.login')->with($param);
     }
     public function doLogin(){
         $rules = ['username'  => 'required',
             'userpassword'  => 'required',];
         $validator = Validator::make(Input::all(), $rules);
         if ($validator->fails()) {
             return Redirect::back()
                 ->withErrors($validator)
                 ->withInput();
         }else {
             $username = Input::get('username');
             $userpassword = Input::get('userpassword');
             $list = MembersModel::whereRaw('username = ? and password = md5(?)', array($username, $userpassword))->get();
             if(count($list)>0) {
                 Session::set('user_id', $list[0]->id);
                 return Redirect::route('user.dashboard');
             }else{
                 $listEmail = MembersModel::whereRaw('email = ? and password = md5(?)', array($username, $userpassword,))->get();
                 if(count($listEmail)>0) {
                     Session::set('user_id', $listEmail[0]->id);
                     return Redirect::route('user.dashboard');
                 }else{
                     $alert['msg'] = 'UserName or Email or Password is incorrect';
                     $alert['type'] = 'danger';
                     return Redirect::route('user.login')->with('alert', $alert);
                 }
             }

         }

     }

     public function register(){
        return View::make('user.auth.register');
     }
     public function store(){
         $rules = [
             'firstname'  => 'required ',
             'lastname'  => 'required ',
             'email' => 'required|unique:member',
             'password'  => 'required|confirmed',
             'password_confirmation' =>'required',
             'username'=> 'required|unique:member',
         ];
         $validator = Validator::make(Input::all(), $rules);

         if ($validator->fails()) {
             return Redirect::back()
                 ->withErrors($validator)
                 ->withInput();
         }else{
             $memberList = new MembersModel;
             $password = Input::get('password');
             $memberList->first_name = Input::get('firstname');
             $memberList->last_name = Input::get('lastname');
             $memberList->email = Input::get('email');
             $memberList->password = md5($password);
             $memberList->username = Input::get('username');
             $memberList->remember_token = Input::get('_token');
             $memberList->save();
             $alert['msg'] = 'User has been saved successfully';
             $alert['type'] = 'success';
             return Redirect::route('user.login')->with('alert', $alert);
         }
     }
     public function doLogout(){
         Session::forget('user_id');
         return Redirect::route('user.home');
     }
 }

