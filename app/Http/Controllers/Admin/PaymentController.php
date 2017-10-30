<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use  Input, Redirect, Session, Validator, DB, Mail,File, Request,Response,URL,Form;
use App\Model\Payment as PaymentModel;
class PaymentController  extends Controller
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
        $param['pageNo'] =41;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $param['payment'] = PaymentModel::all();
        return View::make('admin.payment.index')->with($param);
    }
    public function create(){
        $param['pageNo'] =41;
        return View::make('admin.payment.create')->with($param);
    }
    public function store(){
        if (Input::has('payment_id')) {
            $rules = [
                'payment' => 'required',
            ];
        }else{
            $rules = [
                'payment' => 'required |unique:paymentterm',
            ];
        }
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else{
            if (Input::has('payment_id')) {
                $id = Input::get('payment_id');
                $payment = PaymentModel::find($id);
            }else{
                $payment = new PaymentModel;
            }
            $payment->payment = Input::get('payment');
            $payment->save();
            $alert['msg'] = 'Payment  has been saved successfully';
            $alert['type'] = 'success';
        }
        return Redirect::route('admin.payment')->with('alert', $alert);
    }
    public function edit($id){
        $param['pageNo'] = 41;
        $param['payment']=PaymentModel::find($id);
        return View::make('admin.payment.edit')->with($param);
    }
    public function delete($id){
        try {
            PaymentModel::find($id)->delete();
            $alert['msg'] = 'This payment has been deleted successfully';
            $alert['type'] = 'success';
        } catch(\Exception $ex) {
            $alert['msg'] = 'This payment  focus has been already used';
            $alert['type'] = 'danger';
        }
        return Redirect::route('admin.payment')->with('alert', $alert);
    }
}