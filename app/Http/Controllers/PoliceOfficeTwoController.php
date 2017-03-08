<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Models;

class PoliceOfficeTwoController extends Controller
{
    public function index(){
    	$suboffice = App\Models\unit_office_secondaries::with('unitoffice')->get();
    	$office = App\Models\unit_offices::where('UnitOfficeHasField', '=', 'True')->get();

    	return view('maintenancetable.policeoffice2_table')->with('offices', $office)->with('suboffices', $suboffice);
    }

    public function add(Request $request){
        if(isset($_POST['submit'])){
            $policeoffice = new App\Models\unit_office_secondaries;

    	    $policeoffice->UnitOfficeSecondaryName = $request->name;
            $policeoffice->UnitOfficeHasTertiary = $request->haster;
            $policeoffice->UnitOfficeID = $request->office;
            $policeoffice->desc = $request->desc;
 
           	$policeoffice->save();

        }
    }

    public function find(Request $request){
        $police = $request->id;
    	$id = App\Models\unit_office_secondaries::find($police);
    	return $id;
    }

    public function edit(Request $request){
    	if(isset($_POST['submit']))
    	{

    		$id = App\Models\unit_office_secondaries::find($request->subID);
    		
    		$id->UnitOfficeID = $request->office;
            $id->UnitOfficeSecondaryName = $request->name;
            $id->UnitOfficeHasTertiary = $request->haster;
            $id->desc = $request->desc;

    		$id->save();
    	}
    }

}
