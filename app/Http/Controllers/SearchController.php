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
		$dt->addStringColumn('Sector')
            ->addNumberColumn('Total');


       foreach ($sector as $value) {
       		$dt->addRow([$value->sectorname, $value->total]);
       }
        
       
       
       return $dt;


	}

	public function getUnitOffice(){
		$unit = DB::table('unit_offices')
					->select('UnitOfficeSecondaryName', DB::raw('count(*) as total'))
					->Join('advisory_council', 'advisory_council.second_id', '=', 'unit_office_secondaries.id')
					->Join('police_advisory', 'police_advisory.second_id', '=', 'unit_office_secondaries.id')
					->havingRaw('count(*) >= 0')
					->groupBy('UnitOfficeSecondaryName')->distinct()->get();

		$dt = \Lava::DataTable();
		$dt->addStringColumn('Unit Office')
            ->addNumberColumn('Total');

       foreach ($unit as $value) {
       		$dt->addRow([$value->unitofficename, $value->total]);
       }
        
       
       
       return $dt;

	}


	public function getAge(){
		$agepc = DB::table('police_advisory')
					->select(DB::raw('TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age, count(*) as num'))
					->havingRaw('count(*) >= 0')
					->groupBy('age')
					->get();
					

		$ageac = DB::table('advisory_council')
					->select(DB::raw('TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age, count(*) as num'))
					->havingRaw('count(*) >= 0')
					->groupBy('age')
					->get();
		$ageac = $ageac->keyBy('age');

			  foreach ($agepc as $value) {

			  	$myage = $value->age;
			  
			  	if (!$ageac->search('$myage')) {
			  		$ageac->push($value)->keyBy('age');
			  	}else{
			  		
			  		//$x = $ageac->num->whereIn('age', [$myage])->get();
			  		
			  	}

			  }
			  $ageac = $ageac->sortBy('age');

			  $dt = \Lava::DataTable();
			   $dt->addStringColumn('Age')
		       ->addNumberColumn('Total');

		       foreach ($ageac as $value) {
		       		$dt->addRow([$value->age, $value->num]);
		       }

		       return $dt;
	

	}




	public function dashboard(){
		

		$chartoption = array(
						'title' => '',
						'fontName' => 'Franklin Gothic Book',
						'colors' => array(
										  '#3d9130', //green
										  '#438db7', //baby blue
										  '#ffe659', //yellow
										  '#ffa359', //orange
										  '#a73f3f', //red
										  '#66ccc6', //teal 
										  '#72d9a2', //mint
										  '#f788e6', //pink
										  '#6174af', //indigo
										  '#cd72f3'  //lavender
										  ),
						'fontSize' => 14,
						'height' => 500,
						'width' => 500
						);

        $genderTable = $this->getGender();
		
        $chartoption['title'] = 'Male and Female Stakeholders';
       	$genderChart = \Lava::PieChart('Gender', $genderTable, $chartoption);

       	






       	$sectorTable = $this->getSector();
       	$chartoption['title'] = 'AC Sector';
       	$sectorChart = \Lava::PieChart('Sector', $sectorTable, $chartoption);

       	$sectorfilter  = \Lava::CategoryFilter(0, [
		    'ui' => [
		        'labelStacking' => 'vertical',
		        'allowTyping' => false
		    ]
		]);

		$control = \Lava::ControlWrapper($sectorfilter, 'sectorcontrol');
		$chart   = \Lava::ChartWrapper($sectorChart, 'sectorchart');

		\Lava::Dashboard('Sector')->bind($control, $chart);  


	
		$unitTable = $this->getUnitOffice();
       	$chartoption['title'] = 'Unit Offices';
       	$unitChart = \Lava::PieChart('UnitOffices', $unitTable, $chartoption);

       	$unitfilter  = \Lava::CategoryFilter(0, [
		    'ui' => [
		        'labelStacking' => 'vertical',
		        'allowTyping' => false
		    ]
		]);

		$control = \Lava::ControlWrapper($unitfilter, 'unitcontrol');
		$chart   = \Lava::ChartWrapper($unitChart, 'unitchart');

		\Lava::Dashboard('UnitOffices')->bind($control, $chart);  







       	$ageTable = $this->getAge();
       	$agedashboard = \Lava::Dashboard('Age');

	    $ageChart = \Lava::PieChart('Age', $ageTable, [
			    'pieSliceText' => 'value',
			    'title' => 'Age Rage of Stakeholders'
			]);

		
		$filter  = \Lava::NumberRangeFilter(1, [
		    'ui' => [
		        'labelStacking' => 'vertical',
		        'minValue' => 0
		    ]
		]);

		$control = \Lava::ControlWrapper($filter, 'control');
		$chart   = \Lava::ChartWrapper($ageChart, 'chart');
		$dashboard = $agedashboard->bind($control, $chart);




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