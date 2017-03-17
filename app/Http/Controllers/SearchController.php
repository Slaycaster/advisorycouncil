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

		
		$unitac = DB::table('unit_offices')
					->join('unit_office_secondaries', 'unit_offices.id', '=', 'unit_office_secondaries.UnitOfficeID')
					->select('UnitOfficeName', DB::raw('count(*) as total'))
					->join('advisory_council', 'advisory_council.second_id', '=', 'unit_office_secondaries.id')
					->havingRaw('count(*) >= 0')
					->groupBy('UnitOfficeName')
					->get();

		$unitpa = DB::table('unit_offices')
					->join('unit_office_secondaries', 'unit_offices.id', '=', 'unit_office_secondaries.UnitOfficeID')
					->select('UnitOfficeName', DB::raw('count(*) as total'))
					->join('police_advisory', 'police_advisory.second_id', '=', 'unit_office_secondaries.id')
					->havingRaw('count(*) >= 0')
					->groupBy('UnitOfficeName')
					->get();


		foreach ($unitpa as $value) {

			  	$name = $value->UnitOfficeName;
			  
			  	if ($unitac->where('UnitOfficeName',$name)->count() == 0) {
			  		$unitac->push($value);
			  	}else{
			  		
			  		$ac_col = $unitac->where('UnitOfficeName',$name)->toArray();
			  		$total_pa = $value->total;
			  		$ac_col[0]->total = $ac_col[0]->total + $total_pa;
			  		$unitac->merge($ac_col);


			  		
			  	}

			  }

			  $unitac = $unitac->sortBy('UnitOfficeName');
			  $unitac = $unitac->toArray();
			  $dt = \Lava::DataTable();
			   $dt->addStringColumn('Office Name')
		       ->addNumberColumn('Total');
		      
		       foreach ($unitac as $value) {
		       		$dt->addRow([$value->UnitOfficeName, $value->total]);
		       }
       
       
       return $dt;

	}


	public function getSecondOffice(){
		$secondac = DB::table('unit_office_secondaries')
						->join('unit_offices', 'unit_offices.id', '=', 'unit_office_secondaries.UnitOfficeID')
						->select('UnitOfficeSecondaryName', DB::raw('count(*) as total'))
						->join('advisory_council', 'advisory_council.second_id', '=', 'unit_office_secondaries.id')
						->havingRaw('count(*) >= 0')
						->groupBy('UnitOfficeSecondaryName')
						->get();

		$secondpa = DB::table('unit_office_secondaries')
						->join('unit_offices', 'unit_offices.id', '=', 'unit_office_secondaries.UnitOfficeID')
						->select('UnitOfficeSecondaryName', DB::raw('count(*) as total'))
						->join('police_advisory', 'police_advisory.second_id', '=', 'unit_office_secondaries.id')
						->havingRaw('count(*) >= 0')
						->groupBy('UnitOfficeSecondaryName')
						->get();


		foreach ($secondpa as $value) {

			  	$name = $value->UnitOfficeSecondaryName;
			  
			  	if ($secondac->where('UnitOfficeSecondaryName',$name)->count() == 0) {
			  		$secondac->push($value);
			  	}else{
			  		
			  		$ac_col = $secondac->where('UnitOfficeSecondaryName',$name)->toArray();
			  		$total_pa = $value->total;
			  		$ac_col[0]->total = $ac_col[0]->total + $total_pa;
			  		$secondac->merge($ac_col);


			  		
			  	}

			  }

			  $secondac = $secondac->sortBy('UnitOfficeSecondaryName');
			  $secondac = $secondac->toArray();
			  $dt = \Lava::DataTable();
			   $dt->addStringColumn('Office Name')
		       ->addNumberColumn('Total');
		       //return $secondac;
		       
		       foreach ($secondac as $value) {
		       		$dt->addRow([$value->UnitOfficeSecondaryName, $value->total]);
		       }




		      

		       //return json_encode($dt);
		       return $dt;



	}



	public function getTertiaryOffice(){
		$tertiaryac = DB::table('unit_office_tertiaries')
						->select('UnitOfficeTertiaryName', DB::raw('count(*) as total'))
						->Join('advisory_council', 'advisory_council.tertiary_id', '=', 'unit_office_tertiaries.id')
						->havingRaw('count(*) >= 0')
						->groupBy('UnitOfficeTertiaryName')
						->get();

		$tertiarypa = DB::table('unit_office_tertiaries')
						->select('UnitOfficeTertiaryName', DB::raw('count(*) as total'))
						->Join('police_advisory', 'police_advisory.tertiary_id', '=', 'unit_office_tertiaries.id')
						->havingRaw('count(*) >= 0')
						->groupBy('UnitOfficeTertiaryName')
						->get();


		foreach ($tertiarypa as $value) {

			  	$name = $value->UnitOfficeTertiaryName;
			  
			  	if ($tertiaryac->where('UnitOfficeTertiaryName',$name)->count() == 0) {
			  		$tertiaryac->push($value);
			  	}else{
			  		
			  		$ac_col = $tertiaryac->where('UnitOfficeTertiaryName',$name)->toArray();
			  		$total_pa = $value->total;
			  		$ac_col[0]->total = $ac_col[0]->total + $total_pa;
			  		$tertiaryac->merge($ac_col);


			  		
			  	}

			  }

			  $tertiaryac = $tertiaryac->sortBy('UnitOfficeTertiaryName');
			  $tertiaryac = $tertiaryac->toArray();
			  $dt = \Lava::DataTable();
			   $dt->addStringColumn('Office Name')
		       ->addNumberColumn('Total');
		      
		       foreach ($tertiaryac as $value) {
		       		$dt->addRow([$value->UnitOfficeTertiaryName, $value->total]);
		       }
				

		       //return json_encode($dt);
		       return $dt;


	}


	public function getQuarternaryOffice(){
		$quarternaryac = DB::table('unit_office_quaternaries')
							->select('UnitOfficeQuaternaryName', DB::raw('count(*) as total'))
							->Join('advisory_council', 'advisory_council.quaternary_id', '=', 'unit_office_quaternaries.id')
							->havingRaw('count(*) >= 0')
							->groupBy('UnitOfficeQuaternaryName')
							->get();

		$quarternarypa = DB::table('unit_office_quaternaries')
							->select('UnitOfficeQuaternaryName', DB::raw('count(*) as total'))
							->Join('police_advisory', 'police_advisory.quaternary_id', '=', 'unit_office_quaternaries.id')
							->havingRaw('count(*) >= 0')
							->groupBy('UnitOfficeQuaternaryName')
							->get();


		foreach ($quarternarypa as $value) {

			  	$name = $value->UnitOfficeQuaternaryName;
			  
			  	if ($quarternaryac->where('UnitOfficeQuaternaryName',$name)->count() == 0) {
			  		$quarternaryac->push($value);
			  	}else{
			  		
			  		$ac_col = $quarternaryac->where('UnitOfficeQuaternaryName',$name)->toArray();
			  		$total_pa = $value->total;
			  		$ac_col[0]->total = $ac_col[0]->total + $total_pa;
			  		$quarternaryac->merge($ac_col);


			  		
			  	}

			  }

			  $quarternaryac = $quarternaryac->sortBy('UnitOfficeQuaternaryName');
			  $quarternaryac = $quarternaryac->toArray();
			  $dt = \Lava::DataTable();
			   $dt->addStringColumn('Office Name')
		       ->addNumberColumn('Total');
		      
		       foreach ($quarternaryac as $value) {
		       		$dt->addRow([$value->UnitOfficeQuaternaryName, $value->total]);
		       }
				

		       //return json_encode($dt);
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
		
			  foreach ($agepc as $value) {

			  	$myage = $value->age;
			  
			  	if ($ageac->where('age',$myage)->count() == 0) {
			  		$ageac->push($value);
			  	}else{
			  		
			  		$ac_col = $ageac->where('age',$myage)->toArray();

			  		$panum = $value->num;
			  		$ac_col[0]->num = $ac_col[0]->num + $panum;

			  		//$total = $acnum + $panum;
			  		//$ageac = $ageac->forget('age')->where("age", "<>", $myage);
			  		$ageac->merge($ac_col);


			  		
			  	}

			  }
			  $ageac = $ageac->sortBy('age');
			  $ageac = $ageac->toArray();
			  $dt = \Lava::DataTable();
			   $dt->addStringColumn('Age')
		       ->addNumberColumn('Total')
		       ->addNumberColumn('AgeInt');
		       //print_r($ageac);
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
										  '#b49d19', //yellow
										  '#be6822', //orange
										  '#a73f3f', //red
										  '#3a8883', //teal 
										  '#6bba90', //mint
										  '#f788e6', //pink
										  '#6174af', //indigo
										  '#9c58b9'  //lavender
										  ),
						'fontSize' => 15,
						'height' => 300,
						'width' => 500
						);

        $genderTable = $this->getGender();
		
        $chartoption['title'] = 'Male and Female Stakeholders';
       	$genderChart = \Lava::PieChart('Gender', $genderTable, $chartoption);

       	$sectorTable = $this->getSector();
       	$chartoption['title'] = 'Percentage of Stakeholders per AC Sector';
       	$sectorChart = \Lava::PieChart('Sector', $sectorTable, $chartoption);

       	/*$sectorfilter  = \Lava::CategoryFilter(0, [
		    'ui' => [
		        'labelStacking' => 'vertical',
		        'allowTyping' => false
		    ]
		]);

		$control = \Lava::ControlWrapper($sectorfilter, 'sectorcontrol');
		$chart   = \Lava::ChartWrapper($sectorChart, 'sectorchart');

		\Lava::Dashboard('Sector')->bind($control, $chart);  */


		$unitTable = $this->getUnitOffice();
       	$chartoption['title'] = 'Percentage of Stakeholders per Primary Unit/Offices';
       	$unitChart = \Lava::PieChart('UnitOffices', $unitTable, $chartoption);


		$secondTable = $this->getSecondOffice();
       	$chartoption['title'] = 'Percentage of Stakeholders per Secondary Unit/Offices';
       	$secondChart = \Lava::PieChart('UnitSecondOffices', $secondTable, $chartoption);

       	$terTable = $this->getTertiaryOffice();
       	$chartoption['title'] = 'Percentage of Stakeholders per Tertiary Unit/Offices';
       	$terChart = \Lava::PieChart('UnitTerOffices', $terTable, $chartoption);

       	$quarTable = $this->getQuarternaryOffice();
       	$chartoption['title'] = 'Percentage of Stakeholders per Quaternary Unit/Offices';
       	$quarChart = \Lava::PieChart('UnitQuarOffices', $quarTable, $chartoption);




	
		/*
       	$unitfilter  = \Lava::CategoryFilter(0, [
		    'ui' => [
		        'labelStacking' => 'vertical',
		        'allowTyping' => false
		    ]
		]);

		$control = \Lava::ControlWrapper($unitfilter, 'unitcontrol');
		$chart   = \Lava::ChartWrapper($unitChart, 'unitchart');

		\Lava::Dashboard('UnitOffices')->bind($control, $chart);  */







       	$ageTable = $this->getAge();
       	$agedashboard = \Lava::Dashboard('Age');

       	$chartoption['title'] = 'Age Range of Stakeholders';
       	$ageChart = \Lava::PieChart('Age', $ageTable, $chartoption);
	    /*$ageChart = \Lava::PieChart('Age', $ageTable, [
			    'pieSliceText' => 'value',
			    'title' => 'Age Range of Stakeholders'
			]);

		
		$filter  = \Lava::NumberRangeFilter(1, [
		    'ui' => [
		        'labelStacking' => 'vertical',
		        'minValue' => 0
		    ]
		]);

		$control = \Lava::ControlWrapper($filter, 'control');
		$chart   = \Lava::ChartWrapper($ageChart, 'chart');
		$dashboard = $agedashboard->bind($control, $chart);*/




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

		return view('home.defaulthome')->with('all', $all)
									   ->with('ac', $ac)
									   ->with('twg', $twg)
									   ->with('psmu', $psmu)
									   ->with('pac', $pac)
									   ->with('ptwg', $ptwg)
									   ->with('ppsmu', $ppsmu);


	}


}