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
    public function index(Request $req){
        try {
           $req->session()->put('tabtitle', '#tab4');

            if(Auth::user()->admintype == 1) {
                return redirect('home');
            }//if


            $reqlist = users::where('status', '<>', '0')
                                ->orderBy('created_at','desc')
                                ->union(users::where('status', '=', '0'))
                                ->orderBy('created_at','desc')
                                ->get();

            return View('admin.admin_table')->with('users',$reqlist);
        } catch(\Exception $e) {
            return view('errors.errorpage')->with('pass', 'true');
        }//

        
    }

    public function reloadCaptcha(){
        return captcha_image_html('ExampleCaptcha');
    }

    public function register(Request $req){

        $code = $req->input('CaptchaCode');
        $isHuman = captcha_validate($code);


        
        if ($isHuman == null) {

            $message = "Registration Failed! Verification code does not match!";
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
        
        

        //return $reqlist;
    }//index

     public function adduser(Request $req){

        $admintype = $req->admintype;

        if($admintype == 0){
            $user = new users;
            $user->name = $req->fullname;
            $user->status = 1;
            $user->admintype = $admintype;
            $user->email = $req->username;
            $user->password = bcrypt($req->password);
            $user->created_at = date('Y-m-d H:i:s');
            $user->save();
        }
        else if($admintype == 1 || $admintype == 2){
            $sec = $req->secondary;
            $ter = $req->tertiary;
            $quat = $req->quaternary;

            if($sec == 'disitem'){ $sec = null;}
            if($ter == 'disitem'){ $ter = null;}
            if($quat == 'disitem'){ $quat = null;}

            $user = new users;
            $user->name = $req->fullname;
            $user->status = 1;
            $user->admintype = $admintype;
            $user->email = $req->username;
            $user->password = bcrypt($req->password);
            $user->unit_id = $req->primary;
            $user->second_id = $sec;
            $user->tertiary_id = $ter;
            $user->quaternary_id = $quat;
            $user->created_at = date('Y-m-d H:i:s');
            $user->save();

        }

    }//index

    public function edituser(Request $req) {
        $id = $req->id;

        $user = users::find($id);
        $user->name = $req->fullname;
        $user->email = $req->username;
        $user->password = bcrypt($req->password);
        $user->save();

    }//changepass

    public function checkoldpassword(Request $req) {

        if (Auth::attempt(['id' => $req->id, 'password' => $req->password, 'status' => 1])) {
            return 1;
        } else {
            return 0;

        }//if

        
    }//checkoldpass

    

    public function checkusername(Request $req) {
        $validate = users::where('email', '=', $req->username)->first();
        
        return Response::json(sizeof($validate));
        

    }//checkusername

    public function checknewusername(Request $req) {
        $id = $req->id;

        $validate = users::where('email', '=', $req->username)
                            ->where('id', '<>', $id)
                            ->first();
        
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
