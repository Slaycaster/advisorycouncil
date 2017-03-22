<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Models;

class PoliceOfficesController extends Controller
{
    public function index(){
    	$office = App\Models\unit_offices::all();

		return view('maintenancetable/policeoffice_table')->with('offices', $office);

        //return $staffdesc;
	}
    
    public function confirmOffice(Request $request){
    	if(isset($_POST['addbtn'])){
    		return $this->insert($request);
    	}
    	
    }

    public function add(Request $request){
        if(isset($_POST['submit'])){
            $office = new App\Models\unit_offices;
            $office->UnitOfficeName = $request->input('name');
            $office->UnitOfficeHasField = $request->input('hassec');
            $office->desc = $request->input('desc');

    	    $office->save();
        }
    }

    public function find(Request $request){
        $police=$request->id;
    	$id = App\Models\unit_offices::find($police);
    	return $id;
    }

    public function edit(Request $request){
    	if(isset($_POST['submit'])){
    		$id = App\Models\unit_offices::find($request->policeID);
    		$id->UnitOfficeName = $request->name;
            $id->UnitOfficeHasField = $request->hassec;
            $office->desc = $request->desc;

    		$id->save();
    	}
    }
}
