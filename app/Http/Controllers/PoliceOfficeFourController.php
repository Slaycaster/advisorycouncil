<?php


namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\unit_office_quaternaries;
use App\Models\unit_office_tertiaries;
use App\Models\unit_offices;
use App\Models\unit_office_secondaries;


class PoliceOfficeFourController extends Controller
{
    public function index(){
    	//$tertiaryid = $office4['UnitOfficeTertiaryID'];
    	//$tertiarydata = DB::table('unit_office_tertiaries')->find($tertiaryid);
    	$office = DB::table('unit_offices')->where('UnitOfficeHasField','=','true')->get();
    	$office4 = DB::table('unit_office_quaternaries')
            ->select('unit_office_quaternaries.id','unit_office_quaternaries.UnitOfficeQuaternaryName',
                    'unit_office_tertiaries.UnitOfficeTertiaryName',
                    'unit_office_secondaries.UnitOfficeSecondaryName',
                    'unit_offices.UnitOfficeName', 'unit_office_quaternaries.desc')
    		->join('unit_office_tertiaries','unit_office_quaternaries.UnitOfficeTertiaryID','=','unit_office_tertiaries.id')
    		->join('unit_office_secondaries','unit_office_tertiaries.UnitOfficeSecondaryID','=','unit_office_secondaries.id')
    		->join('unit_offices','unit_office_secondaries.UnitOfficeID','=','unit_offices.id')
    		->get();
    	
    	return view('maintenancetable.policeoffice4_table')->with('office', $office)
    														->with('office4', $office4);
    }

    public function add(Request $request){
        

            $policeoffice = new unit_office_quaternaries;
    	    $policeoffice->UnitOfficeQuaternaryName = $request->name;
            $policeoffice->desc = $request->desc;
    	    $policeoffice->UnitOfficeTertiaryID = $request->office3;
           	$policeoffice->save();
    }

    public function find(Request $request){
        $police = $request->id;
  		$data = unit_office_quaternaries::find($police);
        $tertiaryid = $data->UnitOfficeTertiaryID;
        $seconddata = DB::table('unit_office_tertiaries')->find($tertiaryid);
        $secondaryid = $seconddata->UnitOfficeSecondaryID;
        $thirddata = DB::table('unit_office_secondaries')->find($secondaryid);
        $unitid = $thirddata->UnitOfficeID;
     	$fourthdata = DB::table('unit_offices')->find($unitid);
    	return [$data,$fourthdata,$thirddata,$seconddata];
    }

    public function edit(Request $request){
    	

    		$policeoffice = unit_office_quaternaries::find($request->subID);
    	    $policeoffice->UnitOfficeTertiaryID = $request->office3;
    	    $policeoffice->UnitOfficeQuaternaryName = $request->name;
            $policeoffice->desc = $request->desc;
           	$policeoffice->save();
    }

    public function populate(Request $request){
    	$callid = $request->callid;
    	$id = $request->id;

    	if($callid == 1){
    		$seconddata = DB::table('unit_office_secondaries')->where('UnitOfficeID','=',$id)
                                                              ->where('UnitOfficeHasTertiary','=', 'True')->get();
    		return $seconddata;
		}//populate secondary

		if($callid == 2){
    		$thirddata = DB::table('unit_office_tertiaries')->where('UnitOfficeSecondaryID','=',$id)
                                                            ->where('UnitOfficeHasQuaternary','=', 'true')->get();
    		return $thirddata;

		}//populate tertiary
    }

}
