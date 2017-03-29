<?php

namespace App\Http\Controllers;
use App\Models\AuditTrail;
use Illuminate\Http\Request;
use App;
use App\Models;
use DB;
use Response;
class AuditTrailController extends Controller
{
    public function index(){
        try {
            $auditTrail = DB::table('audit_trail')
                         ->join('users','audit_trail.user_id', '=', 'users.id')
                         ->orderBy('date_time','asc')
                         ->get(array('audit_trail.id','date_time','description','name','admintype'));
            return View ('transaction.auditTrail')->with('audit',$auditTrail);
           
        } catch(\Exception $e) {
            return view('errors.errorpage')->with('pass', 'true');
        }//

    }

    public function appendValue($data, $type, $element)
	{
		// operate on the item passed by reference, adding the element and type

		foreach ($data as $key => & $item) {
			$item[$element] = (array) $type;
		}
		return $data;		
	}




    public function filter(Request $req){

    	$type = 3;
    	$date = e($req->d);
    	$name = e($req->n);
    	
    	if (isset($req->t)) {
    		$type = e($req->t);
    	}

    	if ($name == '') {
    		$selection = DB::table('audit_trail')
    					 ->join('users','audit_trail.user_id', '=', 'users.id')
    					 ->whereDate('date_time','=', date('Y-m-d',strtotime($date)))
    					 ->orWhere('admintype','=', $type)
    					 ->orderBy('date_time','asc')
    					 ->get(array('audit_trail.id','date_time','description','name','admintype'))->toArray();

    	}else{
    		$selection = DB::table('audit_trail')
    					 ->join('users','audit_trail.user_id', '=', 'users.id')
    					 ->whereDate('date_time','=', date('Y-m-d',strtotime($date)))
                         ->orWhere('name','=', $name)
    					 ->orWhere('admintype','=', $type)
    					 ->orderBy('date_time','asc')
    					 ->get(array('audit_trail.id','date_time','description','name','admintype'))->toArray();
    	}

    	//$selection = $this->appendValue($selection, 'filter', 'class');
		



		
		return Response::json(array(
			'data'=>$selection
		));


		//this will retun the view
		//return View ('transaction.auditTrail')->with('audit',$selection);
    	}

}
