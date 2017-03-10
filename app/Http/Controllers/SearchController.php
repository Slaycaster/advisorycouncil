<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advisory_Council;
use App\Models\Police_Advisory;
use Response;
use DB;

class SearchController extends Controller
{
    public function appendValue($data, $type, $element)
	{
		// operate on the item passed by reference, adding the element and type
		foreach ($data as $key => & $item) {
			$item[$element] = $type;
		}
		return $data;		
	}

	public function appendURL($data, $prefix)
	{
		// operate on the item passed by reference, adding the url based on slug
		foreach ($data as $key => & $item) {
			$item['url'] = url($prefix.'/'.$item['ID']);
		}
		return $data;		
	}

	public function index(Request $req)
	{
		$query = e($req->q);

		if(!$query && $query == '') return Response::json(array(), 400);

		$adv = Advisory_Council::where('fname','like','%'.$query.'%')
			->orWhere('lname','like','%'.$query.'%')
			->orWhere('mname','like','%'.$query.'%')
			->orderBy('lname','asc')
			->take(5)
			->get(array('ID','imagepath','fname','mname','lname'))->toArray();

		$police = Police_Advisory::where('fname','like','%'.$query.'%')
			->orWhere('lname','like','%'.$query.'%')
			->orWhere('mname','like','%'.$query.'%')
			->orderBy('lname','asc')
			->take(5)
			->get(array('ID','imagepath','fname','mname','lname'))->toArray();

		
		// Data normalization
		
		$adv = $this->appendURL($adv, 'ACSearch');
		$police = $this->appendURL($police, 'PoliceSearch');
		
		// Add type of data to each item of each set of results
		$adv = $this->appendValue($adv, 'AdvisoryCouncil', 'class');
		$police = $this->appendValue($police, 'police', 'class');
		
		$data = array_merge($adv,$police);
		
		return Response::json(array(
			'data'=>$data
		));
	}

	public function view(){
		return view('transaction.login');
	}

	public function AdvancedSearch(Request $req){
		$query = $req->sq;
		$ac = DB::table('advisory_council')
					->join('advisory_position', 'advisory_position.ID', '=', 'advisory_council.advisory_position_id')
					->select('advisory_council.ID','lname', 'fname', 'mname', 'imagepath', 'email', 
						     'contactno', 'landline','startdate', 'acpositionname', 'officename')
					->whereDate("advisory_council.created_at" , ">=", "DATE_ADD(NOW(),INTERVAL -15 DAY)")
					->where('fname','like','%'.$query.'%')
					->orWhere('lname','like','%'.$query.'%')
					->orWhere('mname','like','%'.$query.'%')

					->orderBy('advisory_council.created_at', 'desc')
					->get();
	
		$pa = DB::table('police_advisory')
					->join('police_position', 'police_position.id', '=', 'police_advisory.police_position_id')
					->join('unit_offices', 'unit_offices.id', '=', 'police_advisory.unit_id')
					->join('unit_office_secondaries', 'unit_office_secondaries.id', '=', 'police_advisory.second_id')
					->join('unit_office_tertiaries', 'unit_office_tertiaries.id', '=', 'police_advisory.tertiary_id')
					->join('unit_office_quaternaries', 'unit_office_quaternaries.id', '=', 'police_advisory.quaternary_id')
					->where('fname','like','%'.$query.'%')
					->orWhere('lname','like','%'.$query.'%')
					->orWhere('mname','like','%'.$query.'%')
					->select('police_advisory.ID', 'lname', 'fname', 'mname', 'imagepath', 'email', 
						     'contactno', 'landline', 'startdate', 'policetype',
						     'UnitOfficeName', 'UnitOfficeSecondaryName', 'UnitOfficeTertiaryName',
						     'UnitOfficeQuaternaryName', 'PositionName')
					->orderBy('police_advisory.created_at', 'desc')
					->get();

					$data = array('ac' => $ac, 'pa' => $pa );
					return $data;

	}


	public function findAC(Request $req){
		$query = $req->sq;
		$ac = DB::table('advisory_council')
					->join('advisory_position', 'advisory_position.ID', '=', 'advisory_council.advisory_position_id')
					->select('advisory_council.ID','lname', 'fname', 'mname', 'imagepath', 'email', 
						     'contactno', 'landline','startdate', 'acpositionname', 'officename')
					->where('advisory_council.ID','=',$query)
					->orderBy('advisory_council.created_at', 'desc')
					->get();

		return $ac;

	}

	public function findPA(Request $req){
		$query = $req->sq;
		$police = DB::table('police_advisory')
					->join('police_position', 'police_position.id', '=', 'police_advisory.police_position_id')
					->join('unit_offices', 'unit_offices.id', '=', 'police_advisory.unit_id')
					->join('unit_office_secondaries', 'unit_office_secondaries.id', '=', 'police_advisory.second_id')
					->join('unit_office_tertiaries', 'unit_office_tertiaries.id', '=', 'police_advisory.tertiary_id')
					->join('unit_office_quaternaries', 'unit_office_quaternaries.id', '=', 'police_advisory.quaternary_id')
					->where('police_advisory.ID','=',$query)
					->select('police_advisory.ID', 'lname', 'fname', 'mname', 'imagepath', 'email', 
						     'contactno', 'landline', 'startdate', 'policetype',
						     'UnitOfficeName', 'UnitOfficeSecondaryName', 'UnitOfficeTertiaryName',
						     'UnitOfficeQuaternaryName', 'PositionName')
					->orderBy('police_advisory.created_at', 'desc')
					->get();
					return $police;
	}


	public function getGender(){
		$pam = DB::table("police_advisory")
					->where('gender', '=', '0')
					->count();
		$paf = DB::table("police_advisory")
					->where('gender', '=', '1')
					->count();
		$acm = DB::table("advisory_council")
					->where('gender', '=', '0')
					->count();
		$acf = DB::table("advisory_council")
					->where('gender', '=', '1')
					->count();


		$totalm = $pam + $acm;
		$totalf = $paf + $acf;
		$total = $totalm + $totalf;

		$dt = \Lava::DataTable();
		$dt->addStringColumn('Name')
            ->addNumberColumn('Gender');

        
        	$dt->addRow(["Male", $totalm]);
        	$dt->addRow(["Female", $totalf]);
        
		return $dt;

		
	}

	public function getSector(){
		$sector = DB::table('ac_sector')
					->select('sectorname', DB::raw('count(*) as total'))
					->join('advisory_council', 'advisory_council.ac_sector_id', '=', 'ac_sector.ID')
					->havingRaw('count(*) >= 0')
					->groupBy('sectorname')->get();

		$dt = \Lava::DataTable();
		$dt->addStringColumn('Name')
            ->addNumberColumn('Gender');


       foreach ($sector as $value) {
       		$dt->addRow([$value->sectorname, $value->total]);
       }
        
       
       
       return $dt;


	}




	public function dashboard(){

		

       $genderTable = $this->getGender();
		
        
       	$genderChart = \Lava::DonutChart('Gender', $genderTable, [
									    'title' => 'Male and Female Percentage'
									]);

       	$sectorTable = $this->getSector();

       	$sectorChart = \Lava::DonutChart('Sector', $sectorTable, [
									    'title' => 'Sector Percentage'
									]);




       $ac = Advisory_Council::count();
	    $twg = Police_Advisory::where('policetype', '=', 1)->count();
	    $psmu = Police_Advisory::where('policetype', '=', 2)->count();
	    $pac = 0;
	    $ptwg = 0;
	    $ppsmu = 0;
	    $all = $ac + $twg + $psmu;


	    if ($all > 0) {
	    	$pac = round(($ac/$all) * 100, 2);
		    $ptwg = round(($twg/$all) * 100,2);
		    $ppsmu = round(($psmu/$all) * 100,2);
	    }//if
	    

		$civilian = DB::table('advisory_council')
					->join('advisory_position', 'advisory_position.ID', '=', 'advisory_council.advisory_position_id')
					->select('advisory_council.ID','lname', 'fname', 'mname', 'imagepath', 'email', 
						     'contactno', 'landline','startdate', 'acpositionname', 'officename')
					->whereDate("advisory_council.created_at" , ">=", "DATE_ADD(NOW(),INTERVAL -15 DAY)")
					->orderBy('advisory_council.created_at', 'desc')
					->get();
	
		$police = DB::table('police_advisory')
					->join('police_position', 'police_position.id', '=', 'police_advisory.police_position_id')
					->join('unit_offices', 'unit_offices.id', '=', 'police_advisory.unit_id')
					->join('unit_office_secondaries', 'unit_office_secondaries.id', '=', 'police_advisory.second_id')
					->join('unit_office_tertiaries', 'unit_office_tertiaries.id', '=', 'police_advisory.tertiary_id')
					->join('unit_office_quaternaries', 'unit_office_quaternaries.id', '=', 'police_advisory.quaternary_id')
					->select('police_advisory.ID', 'lname', 'fname', 'mname', 'imagepath', 'email', 
						     'contactno', 'landline', 'startdate', 'policetype',
						     'UnitOfficeName', 'UnitOfficeSecondaryName', 'UnitOfficeTertiaryName',
						     'UnitOfficeQuaternaryName', 'PositionName')
					->whereDate("police_advisory.created_at" , ">=", "DATE_ADD(NOW(),INTERVAL -15 DAY)")
					->orderBy('police_advisory.created_at', 'desc')
					->get();


		return view('home.defaulthome')->with('all', $all)
									   ->with('ac', $ac)
									   ->with('twg', $twg)
									   ->with('psmu', $psmu)
									   ->with('pac', $pac)
									   ->with('ptwg', $ptwg)
									   ->with('ppsmu', $ppsmu)
									   ->with('acmember', $civilian)
									   ->with('tpmember', $police);


	}


}