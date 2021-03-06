<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advisory_Council;
use App\Models\Police_Advisory;
use Response;
use DB;
use Auth;

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
		
		$adv = $this->appendURL($adv, 'search\civilian');
		$police = $this->appendURL($police, 'search\police');
		
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
					->join('ac_sector', 'advisory_council.ac_sector_id', '=', 'ac_sector.ID')
					->join('unit_office_secondaries', 'unit_office_secondaries.id', '=', 'advisory_council.second_id')
					->join('unit_offices', 'unit_offices.id', '=', 'unit_office_secondaries.UnitOfficeID')
					->leftJoin('unit_office_tertiaries', 'unit_office_tertiaries.id', '=', 'advisory_council.tertiary_id')
					->leftJoin('unit_office_quaternaries', 'unit_office_quaternaries.id', '=', 'advisory_council.quaternary_id')
					->select('advisory_council.ID','lname', 'fname', 'mname', 'imagepath', 'email', 'birthdate',
						     'contactno', 'landline','startdate', 'acpositionname', 'officename',
						     'UnitOfficeName', 'UnitOfficeSecondaryName', 'UnitOfficeTertiaryName',
						     'UnitOfficeQuaternaryName','sectorname',DB::raw(' DATEDIFF(DATE_ADD(
						        birthdate, 
						        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
						            YEAR(CURDATE())-YEAR(birthdate),
						            YEAR(CURDATE())-YEAR(birthdate)+1
						        ) YEAR
						    ),CURDATE()) as daysleft'))
					->where('fname','like','%'.$query.'%')
					->orWhere('lname','like','%'.$query.'%')
					->orWhere('mname','like','%'.$query.'%')
					->orWhere('sectorname','like','%'.$query.'%')
					->orWhere('UnitOfficeName','like','%'.$query.'%')
					->orWhere('UnitOfficeSecondaryName','like','%'.$query.'%')
					->orWhere('UnitOfficeTertiaryName','like','%'.$query.'%')
					->orWhere('UnitOfficeQuaternaryName','like','%'.$query.'%')
					->orderBy('advisory_council.lname', 'desc')
					->paginate(12);
	
		$pa = DB::table('police_advisory')
					->join('police_position', 'police_position.id', '=', 'police_advisory.police_position_id')
					->join('unit_office_secondaries', 'unit_office_secondaries.id', '=', 'police_advisory.second_id')
					->join('unit_offices', 'unit_offices.id', '=', 'unit_office_secondaries.UnitOfficeID')
					->leftJoin('unit_office_tertiaries', 'unit_office_tertiaries.id', '=', 'police_advisory.tertiary_id')
					->leftJoin('unit_office_quaternaries', 'unit_office_quaternaries.id', '=', 'police_advisory.quaternary_id')
					->where('fname','like','%'.$query.'%')
					->orWhere('lname','like','%'.$query.'%')
					->orWhere('mname','like','%'.$query.'%')
					->orWhere('PositionName','like','%'.$query.'%')
					->orWhere('UnitOfficeName','like','%'.$query.'%')
					->orWhere('UnitOfficeSecondaryName','like','%'.$query.'%')
					->orWhere('UnitOfficeTertiaryName','like','%'.$query.'%')
					->orWhere('UnitOfficeQuaternaryName','like','%'.$query.'%')
					->select('police_advisory.ID', 'lname', 'fname', 'mname', 'imagepath', 'email', 
						     'contactno', 'landline', 'startdate', 'policetype',
						     'UnitOfficeName', 'UnitOfficeSecondaryName', 'UnitOfficeTertiaryName',
						     'UnitOfficeQuaternaryName', 'PositionName',DB::raw(' DATEDIFF(DATE_ADD(
						        birthdate, 
						        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
						            YEAR(CURDATE())-YEAR(birthdate),
						            YEAR(CURDATE())-YEAR(birthdate)+1
						        ) YEAR
						    ),CURDATE()) as daysleft'))
					->orderBy('police_advisory.lname', 'desc')
					->paginate(12);
					/*
					$ac = $ac->push($pa);
					if (count($pa) != 0) {
						$ac = $ac->push($pa);
						if (count($pa) != 0) {
							$ac = $ac->push($pa);
						}
						*/
						

						//return $data;

						if (Auth::check()) {
					    	return view('search.search_result')->with('data',$ac)
														       ->with('data2',$pa)
														       ->with('query', $query);
						} else {
					    	return view('search.psearch_result')->with('data',$ac)
														       ->with('data2',$pa)
														       ->with('query', $query);	
						}
						
       

		
	}


	public function findAC(Request $req){
		
			$query = $req->sq;
			$ac = DB::table('advisory_council')
						->join('advisory_position', 'advisory_position.ID', '=', 'advisory_council.advisory_position_id')
						->join('unit_office_secondaries', 'unit_office_secondaries.id', '=', 'advisory_council.second_id')
						->join('unit_offices', 'unit_offices.id', '=', 'unit_office_secondaries.UnitOfficeID')
						->leftJoin('unit_office_tertiaries', 'unit_office_tertiaries.id', '=', 'advisory_council.tertiary_id')
						->leftJoin('unit_office_quaternaries', 'unit_office_quaternaries.id', '=', 'advisory_council.quaternary_id')
						->select('advisory_council.ID','lname', 'fname', 'mname', 'imagepath', 'email', 'birthdate',
							     'contactno', 'landline','startdate', 'acpositionname', 'officename',
							     'UnitOfficeName', 'UnitOfficeSecondaryName', 'UnitOfficeTertiaryName',
							     'UnitOfficeQuaternaryName',DB::raw(' DATEDIFF(DATE_ADD(
							        birthdate, 
							        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
							            YEAR(CURDATE())-YEAR(birthdate),
							            YEAR(CURDATE())-YEAR(birthdate)+1
							        ) YEAR
							    ),CURDATE()) as daysleft'))
						->where('advisory_council.ID','=',$query)
						->orderBy('advisory_council.created_at', 'desc')
						->paginate(12);

			foreach ($ac as $key => $result) {
				$name = $result->fname . " ";

				if($result->mname != '') {
					$name = $name . $result->mname . " ";
				}//if

				$name = $name . $result->lname;
			}

			if (Auth::check()) {
				return view('search.search_result')->with('data',$ac)
											   				   ->with('data2',array())
											   				   ->with('query', $name);
			} else {
				return view('search.psearch_result')->with('data',$ac)
											   					->with('data2',array())
											   					->with('query', $name);
			}

       
		

	}

	public function findPA(Request $req){
		
			$query = $req->sq;
			$police = DB::table('police_advisory')
						->join('police_position', 'police_position.id', '=', 'police_advisory.police_position_id')
						->join('unit_office_secondaries', 'unit_office_secondaries.id', '=', 'police_advisory.second_id')
						->join('unit_offices', 'unit_offices.id', '=', 'unit_office_secondaries.UnitOfficeID')
						->leftJoin('unit_office_tertiaries', 'unit_office_tertiaries.id', '=', 'police_advisory.tertiary_id')
						->leftJoin('unit_office_quaternaries', 'unit_office_quaternaries.id', '=', 'police_advisory.quaternary_id')
						->where('police_advisory.ID','=',$query)
						->select('police_advisory.ID', 'lname', 'fname', 'mname', 'imagepath', 'email', 'birthdate',
							     'contactno', 'landline', 'startdate', 'policetype',
							     'UnitOfficeName', 'UnitOfficeSecondaryName', 'UnitOfficeTertiaryName',
							     'UnitOfficeQuaternaryName', 'PositionName',DB::raw(' DATEDIFF(DATE_ADD(
							        birthdate, 
							        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
							            YEAR(CURDATE())-YEAR(birthdate),
							            YEAR(CURDATE())-YEAR(birthdate)+1
							        ) YEAR
							    ),CURDATE()) as daysleft'))
						->orderBy('police_advisory.created_at', 'desc')
						->paginate(12);

						foreach ($police as $key => $result) {
							$name = $result->fname . " ";

							if($result->mname != '') {
								$name = $name . $result->mname . " ";
							}//if

							$name = $name . $result->lname;
						}

						if (Auth::check()) {
					    	return view('search.search_result')->with('data2',$police)
														   	   ->with('data',array())
														   	   ->with('query', $name);
						} else {
					    	return view('search.psearch_result')->with('data2',$police)
														   	   ->with('data',array())
														   	   ->with('query', $name);
						}			
           
        

			
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

				  		foreach ($ac_col as $key => $gettotal) {
				  			$gettotal->total = $gettotal->total + $total_pa;
				  		}//foreeach

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
				  		foreach ($ac_col as $key => $gettotal) {
				  			$gettotal->total = $gettotal->total + $total_pa;
				  		}//foreeach
				  		
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
				  		foreach ($ac_col as $key => $gettotal) {
				  			$gettotal->total = $gettotal->total + $total_pa;
				  		}//foreeach
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
				  		foreach ($ac_col as $key => $gettotal) {
				  			$gettotal->total = $gettotal->total + $total_pa;
				  		}//foreeach
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

	public function getACPosition(){
	
           $position = DB::table('advisory_position')
						->select('acpositionname', DB::raw('count(*) as total'))
						->join('advisory_council', 'advisory_council.advisory_position_id', '=', 'advisory_position.ID')
						->havingRaw('count(*) >= 0')
						->groupBy('acpositionname')->get();

			$dt = \Lava::DataTable();
			$dt->addStringColumn('AC Position')
	            ->addNumberColumn('Total');


	       foreach ($position as $value) {
	       		$dt->addRow([$value->acpositionname, $value->total]);
	       }
	        
	       
	       
	       return $dt;

       
		
	}

	public function getPolicePosition(){
		
			$position = DB::table('police_position')
						->select('PositionName', DB::raw('count(*) as total'))
						->join('police_advisory', 'police_advisory.police_position_id', '=', 'police_position.id')
						->havingRaw('count(*) >= 0')
						->groupBy('PositionName')->get();

			$dt = \Lava::DataTable();
			$dt->addStringColumn('Police Position')
	            ->addNumberColumn('Total');


	       foreach ($position as $value) {
	       		$dt->addRow([$value->PositionName, $value->total]);
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

			        $dataCollection =  collect([
											    ['name' => 'part1','desc' => '15 to 30', 'num' => 0],
											    ['name' => 'part2','desc' => '31 to 40', 'num' => 0],
											    ['name' => 'part3','desc' => '41 to 60', 'num' => 0],
											    ['name' => 'part4','desc' => '60 and above', 'num' => 0],
											]);
			       $dataArray = $dataCollection->toArray();


			       foreach ($ageac as $value) {
					       
					       
						if ($value->age >= 15 && $value->age <= 30 ) {
					       				$dataArray[0]['num'] = $dataArray[0]['num'] + $value->num;
					    }else if ($value->age > 30 && $value->age <= 40 ) {
					       				$dataArray[1]['num']= $dataArray[1]['num'] + $value->num;
					  	}else if($value->age > 40 && $value->age <= 60 ){
					       				$dataArray[2]['num'] = $dataArray[2]['num'] + $value->num;
				     	}else if($value->age > 60){
					       				$dataArray[3]['num'] = $dataArray[3]['num'] + $value->num;
				       	}
			       	}
					
					for ($i=0; $i < 4; $i++) { 
						$dt->addRow([$dataArray[$i]['desc'], $dataArray[$i]['num']]);
					}		       	

			      

			       return $dt;
       
	

	}


	public function futurebdaypa(){
		$query =  Police_Advisory::select('fname','lname','mname', DB::raw("DATE_FORMAT(birthdate, '%c %b') as fbd"), DB::raw(' DATEDIFF(DATE_ADD(birthdate, 
										        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
										            YEAR(CURDATE())-YEAR(birthdate),
										            YEAR(CURDATE())-YEAR(birthdate)+1
										        ) YEAR
										    ),CURDATE()) as daysleft'))
										->where(DB::raw(' DATEDIFF(DATE_ADD(birthdate, 
										        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
										            YEAR(CURDATE())-YEAR(birthdate),
										            YEAR(CURDATE())-YEAR(birthdate)+1
										        ) YEAR
										    ),CURDATE())'),'<=', 14)
		    								->where(DB::raw(' DATEDIFF(DATE_ADD(birthdate, 
										        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
										            YEAR(CURDATE())-YEAR(birthdate),
										            YEAR(CURDATE())-YEAR(birthdate)+1
										        ) YEAR
										    ),CURDATE())'),'>', 0)
		    								->orderBy('daysleft')
										    ->get();
		return $query;
	}

	public function futurebdayac(){

		$query = Advisory_Council::select('fname','lname','mname', DB::raw("DATE_FORMAT(birthdate, '%c %b') as fbd"), DB::raw(' DATEDIFF(DATE_ADD(birthdate, 
										        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
										            YEAR(CURDATE())-YEAR(birthdate),
										            YEAR(CURDATE())-YEAR(birthdate)+1
										        ) YEAR
										    ),CURDATE()) as daysleft'))
		    								->where(DB::raw(' DATEDIFF(DATE_ADD(birthdate, 
										        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
										            YEAR(CURDATE())-YEAR(birthdate),
										            YEAR(CURDATE())-YEAR(birthdate)+1
										        ) YEAR
										    ),CURDATE())'),'<=', 14)
		    								->where(DB::raw(' DATEDIFF(DATE_ADD(birthdate, 
										        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
										            YEAR(CURDATE())-YEAR(birthdate),
										            YEAR(CURDATE())-YEAR(birthdate)+1
										        ) YEAR
										    ),CURDATE())'),'>', 0)
		    								->orderBy('daysleft')
										    ->get();

		return $query;

	}

	public function birthdaypa(){
		$query = Police_Advisory::select('fname', 'lname','mname', 'policetype')
								->where(DB::raw(' DATEDIFF(DATE_ADD(birthdate, 
										        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
										            YEAR(CURDATE())-YEAR(birthdate),
										            YEAR(CURDATE())-YEAR(birthdate)+1
										        ) YEAR
										    ),CURDATE())'),'=', 0)->get();

		return $query;
	}

	public function birthdayac(){
		$query = Advisory_Council::select('fname', 'lname','mname')
								->where(DB::raw(' DATEDIFF(DATE_ADD(birthdate, 
										        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
										            YEAR(CURDATE())-YEAR(birthdate),
										            YEAR(CURDATE())-YEAR(birthdate)+1
										        ) YEAR
										    ),CURDATE())'),'=', 0)->get();

		return $query;
	}

	public function upcomings(){
		$data = array($this->futurebdayac(),$this->futurebdaypa());
		return $data;
	}

	public function birthdays(){
		$data = array($this->birthdayac(),$this->birthdaypa());
		return $data;
	}




	public function dashboard(Request $req){
		//UI
	
		try {
			$req->session()->put('tabtitle', '#tab1');

			$chartoption = array(
							'title' => '',
							'fontName' => 'Franklin Gothic Book',
							'fontSize' => 15,
							'height' => 300,
							'width' => 400
							);

			$unitTable = $this->getUnitOffice();
	       	$chartoption['title'] = 'Overall Percentage of Stakeholders';
	       	$unitChart = \Lava::PieChart('UnitOffices', $unitTable, $chartoption);


	       	$chartoption['width'] = 500;

	        $genderTable = $this->getGender();
			
	        $chartoption['title'] = 'Male and Female Stakeholders';
	       	$genderChart = \Lava::PieChart('Gender', $genderTable, $chartoption);

	       	$ageTable = $this->getAge();
	       	$chartoption['title'] = 'Age Range of Stakeholders';
	       	$ageChart = \Lava::PieChart('Age', $ageTable, $chartoption);

	       	$acpositionTable = $this->getACPosition();
	       	$chartoption['title'] = 'Percentage of Stakeholders per AC Position';
	       	$acpositionChart = \Lava::PieChart('ACPosition', $acpositionTable , $chartoption);
	       
	       	$policepositionTable = $this->getPolicePosition();
	       	$chartoption['title'] = 'Percentage of Stakeholders per Rank';
	       	$policepositionChart = \Lava::PieChart('PolicePosition', $policepositionTable , $chartoption);

	       	$chartoption['width'] = 600;
			$secondTable = $this->getSecondOffice();
	       	$chartoption['title'] = 'Percentage of Stakeholders per Unit/Offices';
	       	$secondChart = \Lava::ColumnChart('UnitSecondOffices', $secondTable, $chartoption);

	       	$chartoption['width'] = 930;
	       	$terTable = $this->getTertiaryOffice();
	       	$chartoption['title'] = 'Percentage of Stakeholders per PPO/CPO';
	       	$terChart = \Lava::ColumnChart('UnitTerOffices', $terTable, $chartoption);

	       	$quarTable = $this->getQuarternaryOffice();
	       	$chartoption['title'] = 'Percentage of Stakeholders per MPS';
	       	$quarChart = \Lava::ColumnChart('UnitQuarOffices', $quarTable, $chartoption);
	       	
	       	$sectorTable = $this->getSector();
	       	$chartoption['title'] = 'Percentage of Stakeholders per AC Sector';
	       	$sectorChart = \Lava::ColumnChart('Sector', $sectorTable, $chartoption);

		    $acbday = Advisory_Council::where(DB::raw(' DATEDIFF(DATE_ADD(birthdate, 
										        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
										            YEAR(CURDATE())-YEAR(birthdate),
										            YEAR(CURDATE())-YEAR(birthdate)+1
										        ) YEAR
										    ),CURDATE())'),'<=', 14)
		    								->where(DB::raw(' DATEDIFF(DATE_ADD(birthdate, 
										        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
										            YEAR(CURDATE())-YEAR(birthdate),
										            YEAR(CURDATE())-YEAR(birthdate)+1
										        ) YEAR
										    ),CURDATE())'),'>', 0)
		    								->count();

		    $pabday = Police_Advisory::where(DB::raw(' DATEDIFF(DATE_ADD(birthdate, 
										        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
										            YEAR(CURDATE())-YEAR(birthdate),
										            YEAR(CURDATE())-YEAR(birthdate)+1
										        ) YEAR
										    ),CURDATE())'),'<=', 14)
		    								->where(DB::raw(' DATEDIFF(DATE_ADD(birthdate, 
										        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
										            YEAR(CURDATE())-YEAR(birthdate),
										            YEAR(CURDATE())-YEAR(birthdate)+1
										        ) YEAR
										    ),CURDATE())'),'>', 0)
		    								->count();

		    $fdayac = $this->futurebdayac(); // get the list of upcoming bday in ac

			$fdaypa = $this->futurebdaypa(); // get the list of upcoming bday in pa

		     $tdaypa = $this->birthdaypa(); // get the list of todays birthday pa

		     $tdayac = $this->birthdayac(); // get the list of todays birthday ac

		    								



		    $totalbday = $acbday + $pabday;

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
										   ->with('ppsmu', $ppsmu)
										   ->with('ubday', $totalbday)
										   //->with('fdayac', $fdayac)
										   //->with('fdaypa', $fdaypa)
										   ->with('tdaycount', sizeof($tdayac) + sizeof($tdaypa));

		} catch(\Exception $e) {
			return view('errors.errorpage');
		}

	           
      

		

	}


}