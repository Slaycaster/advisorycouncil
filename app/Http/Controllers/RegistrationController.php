<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\users;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use Redirect;
use Response;

class RegistrationController extends Controller
{
    public function index(){

        $reqlist = users::where('status', '<>', '0')
                            ->where('email', '!=', 'admin')
                            ->orderBy('created_at','desc')
                            ->union(users::where('status', '=', '0'))
                            ->orderBy('created_at','desc')
                            ->get();

        return View('admin.admin_table')->with('users',$reqlist);
    }

    public function reloadCaptcha(){
        return captcha_image_html('ExampleCaptcha');
    }

    public function register(Request $req){

        $code = $req->input('CaptchaCode');
        $isHuman = captcha_validate($code);


        
        if ($isHuman == null) {

            $message = "Registration Failed! Verification Code do not match!";
            return json_encode(0);

        }else{
            $validate = users::where('email', '=', $req->username)->first();
            if ($validate === null) {
                $user = new users;
                $user->name = $req->fullname;
                $user->email = $req->username;
                $user->status = 0;
                $user->created_at = date('Y-m-d H:i:s');
                $user->password = bcrypt($req->password);
                $user->save();
                return json_encode(1);
                

            }else{
                $message = "username already exist!";
                return json_encode(2);
            }

        }
        
        
       // $reqlist = users::where('status', '<>', '0')
       //                     ->orderBy('created_at','desc')
       //                     ->union(users::where('status', '=', '0')
       //                     ->orderBy('created_at','desc')
       //                     ->get();
       //return View('admin.admin_table')->with('users',$reqlist);
       
        
    
        

        //return $reqlist;
    }//index

    

    public function checkusername(Request $req) {
        $validate = users::where('email', '=', $req->username)->first();
        
        return Response::json(sizeof($validate));
        

    }//checkusername

    public function getuser(Request $req) {
        $user = users::find($req->id);
        return $user;
    }//public function getuser(Request $req) {

    public function setstatus(Request $req){
        $user = users::find($req->id);
        $user->status = $req->status;

        if($req->status == 1) {
            $user->admintype = $req->admintype;
        }// if($req->status == 1) {

        $user->save();

    }//approve
    
}
