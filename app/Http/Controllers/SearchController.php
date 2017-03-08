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
		$pa = DB::table("police_advisory")
					->select(DB::raw('count(*) as m where gender = 0'),DB::raw('count(*) as f where gender = 1'));
					->get();
		$ac = DB::table("advisory_council")
					->select(DB::raw('count(*) as m where gender = 0'),DB::raw('count(*) as f where gender = 1'));
					->get();

	}



	

}