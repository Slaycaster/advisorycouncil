<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\Advisory_Council;

use App\Models\Police_Advisory;

use App\Models\Police_Position;

use App\Models\unit_offices;

use App\Models\unit_office_secondaries;

use App\Models\unit_office_tertiaries;

use App\Models\unit_office_quaternaries;

use App\Models\Advisory_Position;

use App\Models\AC_Category;

use App\Models\AC_Subcategory;

use App\Models\Personnel_Sector;

use App\Models\AC_Sector;

use App\Models\Training;

use App\Models\Lecturer;

use App\Models\users;

use DB;

use Auth;

use Redirect;


class AdvDirectoryController extends Controller {

	public function readyadd(Request $req){

 		try {
 			$req->session()->put('tabtitle', '#tab3');
 			return view('adviser.adviser_form')->with('action', 0);
           
        } catch(\Exception $e) {
            return view('errors.errorpage')->with('pass', 'true');
        }//


 	}//select dropdowns

 	public function readyedit(Request $req) {
 		try {
 			$req->session()->put('tabtitle', '#tab3');

	 		if(!isset($req->c)) {
	 			return redirect("directory");
	 		}//if

			$tid = $req->c;

			$tidelements = explode("-", $tid);

			$result = $this->getData((int) $tidelements[1], (int) $tidelements[0]);

			//return $result[2][0];

			return view('adviser.adviser_form')->with('action', 1)
											 ->with('recorddata', $result)
											 ->with('type', (int) $tidelements[0])
											 ->with('id', (int) $tidelements[1]);
	           
        } catch(\Exception $e) {
            return view('errors.errorpage')->with('pass', 'true');
        }//

 		

		
	}//readyedit

	public function addadviser(Request $req) {
		$data = $req->all();

		DB::transaction(function($data) use ($data) {

			if (isset($_POST['submit'])) {

				if($data['advcateg'] == 0) {
					$this->addAC($data);

				} else {
					$this->addTP($data);

				}//if($data->advcateg == 0) {
			

			}// if
		});

	}//add - WHOLE

	public function editadviser(Request $req) {
		$data = $req->all();

		DB::transaction(function($data) use ($data) {

		
			if (isset($_POST['submit'])) {

				if($data['advcateg'] == 0) {
					$this->editAC($data);

				} else {
					$this->editTP($data);
					if(isset($data['traintitle'])) {
						$trainID = $this->getTrainIDList($data['ID']);

						if(isset($data['speaker'])) {
							$this->editLecturer($data, $trainID);
						}//if
					}//if


				}//if($data->advcateg == 0) {

				

			}// if
		});


	}//edit - WHOLE

	public function getAdv($filter, $sorter){
		try {
			$civilian = DB::table('advisory_council')
					->join('advisory_position', 'advisory_position.ID', '=', 'advisory_council.advisory_position_id')
					->join("ac_sector", "ac_sector.ID", "=", "advisory_council.ac_sector_id")
					->join('unit_office_secondaries', 'unit_office_secondaries.id', '=', 'advisory_council.second_id')
					->join('unit_offices', 'unit_offices.id', '=', 'unit_office_secondaries.UnitOfficeID')
					->leftJoin('unit_office_tertiaries', 'unit_office_tertiaries.id', '=', 'advisory_council.tertiary_id')
					->leftJoin('unit_office_quaternaries', 'unit_office_quaternaries.id', '=', 'advisory_council.quaternary_id')
					->select('advisory_council.ID','lname', 'fname', 'mname', 'imagepath', 'email', 'birthdate',
						     'contactno', 'landline','startdate', 'acpositionname', 'officename',
						     'UnitOfficeSecondaryName', 'UnitOfficeTertiaryName',
						     'UnitOfficeQuaternaryName',DB::raw(' DATEDIFF(DATE_ADD(
						        birthdate, 
						        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
						            YEAR(CURDATE())-YEAR(birthdate),
						            YEAR(CURDATE())-YEAR(birthdate)+1
						        ) YEAR
						    ),CURDATE()) as daysleft'))
					->orderBy('advisory_council.'. $filter, $sorter)
					->paginate(12);

			$police = DB::table('police_advisory')
						->join('police_position', 'police_position.id', '=', 'police_advisory.police_position_id')
						->join('unit_office_secondaries', 'unit_office_secondaries.id', '=', 'police_advisory.second_id')
						->join('unit_offices', 'unit_offices.id', '=', 'unit_office_secondaries.UnitOfficeID')
						->leftJoin('unit_office_tertiaries', 'unit_office_tertiaries.id', '=', 'police_advisory.tertiary_id')
						->leftJoin('unit_office_quaternaries', 'unit_office_quaternaries.id', '=', 'police_advisory.quaternary_id')
						->select('police_advisory.ID', 'lname', 'fname', 'mname', 'imagepath', 'email', 'birthdate',
						     'contactno', 'landline', 'startdate', 'policetype',
						     'UnitOfficeSecondaryName', 'UnitOfficeTertiaryName',
						     'UnitOfficeQuaternaryName', 'PositionName', DB::raw('DATEDIFF(DATE_ADD(
					        birthdate, 
					        INTERVAL IF(DAYOFYEAR(birthdate) >= DAYOFYEAR(CURDATE()),
					            YEAR(CURDATE())-YEAR(birthdate),
					            YEAR(CURDATE())-YEAR(birthdate)+1
					        ) YEAR
					    ),CURDATE()) as daysleft'))
						->orderBy('police_advisory.' . $filter, $sorter)
						->paginate(12);

			return array($civilian, $police);
           
        } catch(\Exception $e) {
            return view('errors.errorpage')->with('pass', 'true');
        }//
		
	}

	public function getList(Request $req) {
		try {
			//UI
			$req->session()->put('tabtitle', '#tab3');

			$adv = $this->getAdv('created_at', 'desc');
			$acposition = Advisory_Position::select('ID', 'acpositionname')->get();
			$pnpposition = Police_Position::select('id', 'PositionName')->get();
			$acsector = AC_Sector::select('ID', 'sectorname')->get();
			$unitoffice = unit_offices::select('id', 'UnitOfficeName')->get();

			/*INSERT CODE FOR DIRECTORY LIST VIEW*/

			//return $unitoffice;
			return view('adviser.advisercontent')->with("directory", $adv)
										 		 ->with("showcontrol", "true")
										 		 ->with("acposition", $acposition)
										 		 ->with("pnpposition",$pnpposition)
										 		 ->with("acsector", $acsector)
										 		 ->with("unitoffice", $unitoffice);
           
        } catch(\Exception $e) {
            return view('errors.errorpage')->with('pass', 'true');
        }//

		
	}//public function getList() {

	public function readyPHome() {
		try {
			if (Auth::check()) {
	    		return redirect('home');

			}//if (Auth::check()) {

			$adv = $this->getAdv('created_at', 'desc');


			return view('home.defaultphome')->with('directory', $adv);
           
        } catch(\Exception $e) {
            return view('errors.errorpage')->with('pass', 'true');
        }//

		
	}//public function getList() {

	public function getACID() {
		
		$getid = Advisory_Council::orderBy('ID', 'desc')->take(1)->get();

		foreach ($getid as $key => $id) {
            return $id->ID;
        }//foreach ($getid as $key => $id) {


	}//public function getID() {

	public function getTPID($authorder) {
		$getid = Police_Advisory::where('authorityorder', '=', $authorityorder)
								->orderBy('ID', 'desc')->take(1)->get();

		foreach ($getid as $key => $id) {
            return $id->ID;
        }//foreach ($getid as $key => $id) {


	}//public function getID() {

	public function getTrainIDList($id) {
		$getid = Training::where('police_id', $id)->pluck('ID');

		return $getid;
	}//public function getTrainID($id) {

	//DROPDOWN

	public function getInitACD() {
		$acposition = Advisory_Position::all();
 		//$accateg = AC_Category::all();
 		$primaryoffice = unit_offices::all();
 		$acsector = AC_Sector::all();

 		return array($acposition, $acsector, $primaryoffice,);
	}//public function getInitACD() {

	public function getInitTPD() {
		$pnpposition = Police_Position::all();
 		$primaryoffice = unit_offices::all();

 		return array($pnpposition, $primaryoffice);

	}//public function getInitTPD() {

	public function getSubCateg(Request $req) {
		$categID = $req->categID;

		$subcategory = AC_Subcategory::where('categoryId', $categID)->get();

		return $subcategory;

	}//public function getSubCateg() {

	public function getPriOffice() {
		$prioffice = unit_offices::all();

		return $prioffice;
	}//public function getPriOffice() {

	public function getSecOffice(Request $req) {
		$primary = $req->poID;

		$secoffice = unit_office_secondaries::where('UnitOfficeID', $primary)->get();

		return $secoffice;
	}//public function getSecOffice(Request $req) {

	public function getTerOffice(Request $req) {
		$secondary = $req->soID;

		$teroffice = unit_office_tertiaries::where('UnitOfficeSecondaryID', $secondary)->get();

		return $teroffice;
	}//public function getSecOffice(Request $req) {

	public function getQuarOffice(Request $req) {
		$tertiary = $req->toID;

		$quaroffice = unit_office_quaternaries::where('UnitOfficeTertiaryID', $tertiary)->get();

		return $quaroffice;
	}//public function getSecOffice(Request $req) {

 	public function edit(Request $req){
	 	$id = $req->ID;
	 	$advisers = Advisory_Council::find($id);
	 	return $advisers;

	 } // retrieve for edit

	//AC

	public function addAC($data){
        $advisory = new Advisory_Council;
        $advisory->fname = $data['fname'];
	 	$advisory->lname = $data['lname'];
	 	$advisory->mname = $data['mname'];
	 	$advisory->qualifier = $data['qname'];
	 	$advisory->gender =  $data['gender'];
	 	$advisory->contactno = $data['mobile'];
	 	$advisory->landline = $data['landline'];
	 	$advisory->officename = $data['officename'];
        $advisory->officeaddress = $data['officeadd'];
	 	$advisory->email = $data['email'];

	 	if($data['durstart'] != "") {
	 		$advisory->startdate = $data['durstart'];

	 	}//if
		if($data['bdate'] != "") {
	 		$advisory->birthdate = $data['bdate'];

	 	}//if

	 	$advisory->fbuser = $data['facebook'];
	 	$advisory->twitteruser = $data['twitter'];
	 	$advisory->iguser = $data['instagram'];

	 	

	 	$advisory->street = $data['street'];
	 	$advisory->city = $data['city'];
	 	$advisory->province = $data['province'];
	 	$advisory->barangay = $data['barangay'];


	 	if($data['upphoto'] != "") {
	 		$advisory->imagepath = $this->loadphoto($data['upphoto']);

	 	}//if

        $advisory->advisory_position_id = $data['acposition'];
        $advisory->ac_sector_id = $data['acsector'];

       	$advisory->second_id = $data['secondary'];

	    if($data['tertiary'] != 'disitem') {
	    	$advisory->tertiary_id = $data['tertiary'];
	    }//if

	    if($data['quaternary'] != 'disitem') {
	    	$advisory->quaternary_id = $data['quaternary'];
	    }//if

        $advisory->save();
    } // add AC

    public function editAC($data){

    	$advisory = Advisory_Council::find($data['ID']);
        $advisory->fname = $data['fname'];
	 	$advisory->lname = $data['lname'];
	 	$advisory->mname = $data['mname'];
	 	$advisory->qualifier = $data['qname'];
	 	$advisory->gender =  $data['gender'];
	 	$advisory->contactno = $data['mobile'];
	 	$advisory->landline = $data['landline'];
	 	$advisory->officename = $data['officename'];
        $advisory->officeaddress = $data['officeadd'];
	 	$advisory->email = $data['email'];
	 	
	 	if($data['durstart'] != "") {
	 		$advisory->startdate = $data['durstart'];

	 	} else {
	 		$advisory->startdate = NULL;

	 	}//if

	 	if($data['durend'] != "") {
	 		$advisory->enddate = $data['durend'];

	 	} else {
	 		$advisory->enddate = NULL;

	 	}//if


		if($data['bdate'] != "") {
	 		$advisory->birthdate = $data['bdate'];

	 	} else {
	 		$advisory->birthdate = NULL;

	 	}//if

	 	$advisory->fbuser = $data['facebook'];
	 	$advisory->twitteruser = $data['twitter'];
	 	$advisory->iguser = $data['instagram'];
	 	
	 	$advisory->street = $data['street'];
	 	$advisory->city = $data['city'];
	 	$advisory->province = $data['province'];
	 	$advisory->barangay = $data['barangay'];


	 	if($data['upphoto'] != "") {
	 		$advisory->imagepath = $this->loadphoto($data['upphoto']);

	 	}//if
	 	print_r($data['acsector']);

        $advisory->advisory_position_id = $data['acposition'];
        $advisory->ac_sector_id = $data['acsector'];

       	$advisory->second_id = $data['secondary'];

	    if($data['tertiary'] != 'disitem') {
	    	$advisory->tertiary_id = $data['tertiary'];
	    }//if

	    if($data['quaternary'] != 'disitem') {
	    	$advisory->quaternary_id = $data['quaternary'];
	    }//if

        $advisory->save();

    } // update AC

   	//TWG/PSMU

   	public function addTP($data){
    
    	$advisory = new Police_Advisory;
    	$advisory->fname = $data['fname'];
	 	$advisory->lname = $data['lname'];
	 	$advisory->mname = $data['mname'];
	 	$advisory->qualifier = $data['qname'];
	 	$advisory->gender =  $data['gender'];
	 	$advisory->contactno = $data['mobile'];
	 	$advisory->landline = $data['landline'];
	 	$advisory->email = $data['email'];

	 	if($data['durstart'] != "") {
	 		$advisory->startdate = $data['durstart'];

	 	}//if

	 	$advisory->fbuser = $data['facebook'];
	 	$advisory->twitteruser = $data['twitter'];
	 	$advisory->iguser = $data['instagram'];
	 	
	 	if($data['bdate'] != "") {
	 		$advisory->birthdate = $data['bdate'];

	 	}//if

	 	$advisory->street = $data['street'];
	 	$advisory->city = $data['city'];
	 	$advisory->province = $data['province'];
	 	$advisory->barangay = $data['barangay'];
	 	$advisory->policetype = $data['advcateg'];

	 	if($data['upphoto'] != "") {
	 		$advisory->imagepath = $this->loadphoto($data['upphoto']);

	 	}//if
    	$advisory->police_position_id = $data['pnppost'];
    	$advisory->second_id = $data['secondary'];

	    if($data['tertiary'] != 'disitem') {
	    	$advisory->tertiary_id = $data['tertiary'];
	    }//if

	    if($data['quaternary'] != 'disitem') {
	    	$advisory->quaternary_id = $data['quaternary'];
	    }//if

	    $advisory->authorityorder = $data['authorder'];

    	$advisory->save();


    	if(isset($data['traintitle'])) {
	    	$id = $this->getTPID($data['authorder']);

	    	$this->addTraining($data, $id);
	    }//if

	    
	}// add TP

	 public function editTP($data){
    	$advisory = Police_Advisory::find($data['ID']);
    	$advisory->fname = $data['fname'];
	 	$advisory->lname = $data['lname'];
	 	$advisory->mname = $data['mname'];
	 	$advisory->qualifier = $data['qname'];
	 	$advisory->gender =  $data['gender'];
	 	$advisory->contactno = $data['mobile'];
	 	$advisory->landline = $data['landline'];
	 	$advisory->email = $data['email'];
	 	$advisory->fbuser = $data['facebook'];
	 	$advisory->twitteruser = $data['twitter'];
	 	$advisory->iguser = $data['instagram'];
	 	$advisory->street = $data['street'];
	 	$advisory->city = $data['city'];
	 	$advisory->province = $data['province'];
	 	$advisory->barangay = $data['barangay'];
	 	$advisory->policetype = $data['advcateg'];

	 	if($data['durstart'] != "") {
	 		$advisory->startdate = $data['durstart'];

	 	} else {
	 		$advisory->startdate = NULL;

	 	}//if

	 	if($data['durend'] != "") {
	 		$advisory->enddate = $data['durend'];

	 	} else {
	 		$advisory->enddate = NULL;

	 	}//if


		if($data['bdate'] != "") {
	 		$advisory->birthdate = $data['bdate'];

	 	} else {
	 		$advisory->birthdate = NULL;

	 	}//if

	 	if($data['upphoto'] != "") {
	 		$advisory->imagepath = $this->loadphoto($data['upphoto']);

	 	}//if
    	$advisory->police_position_id = $data['pnppost'];
    	$advisory->second_id = $data['secondary'];

	    if($data['tertiary'] != 'disitem') {
	    	$advisory->tertiary_id = $data['tertiary'];
	    }//if

	    if($data['quaternary'] != 'disitem') {
	    	$advisory->quaternary_id = $data['quaternary'];
	    }//if

	    $advisory->authorityorder =$data['authorder'];

    	$advisory->save();
        
    }// update TP

    //Training

    public function addTraining($data, $id) {
    	$count = count($data['traintitle']);

    	for($i=0 ; $i < $count ; $i++){
		   	$training = new Training();
		   	$training->trainingname = $data['traintitle'][$i];
		   	$training->startdate = $data['sdate'][$i];
		   	$training->enddate = $data['edate'][$i];
		   	$training->location = $data['location'][$i];
		   	$training->organizer = $data['org'][$i];
		   	$training->starttime = $data['stime'][$i];
		   	$training->endtime = $data['etime'][$i];
		   	$training->trainingtype = $data['traincateg'][$i];
		   	$training->police_id = $id;
		   	$training->save();

		   	if(isset($data['speaker'])) {
			   	$trainID = $this->getTrainID($id);

			   	$this->addLecturer($data['speaker'][$i], $trainID);
		   	 }//if

	    }//for

    }// add Training

    public function editTraining($data) {
    	Training::where('police_id', $data['ID'])->delete();

    	$this->addTraining($data, $data['ID']);

    }// update Training

   	public function getTrainID($id) {
   		$getid = Training::where('police_id', '=', $id)
   						 ->orderBy('ID', 'desc')->take(1)->get();

		foreach ($getid as $key => $id) {
            return $id->ID;
        }//foreach ($getid as $key => $id) {


   	}//public function getTrainID() {

   	public function addLecturer($data, $trainID) {
   		for($ctr = 0 ; $ctr < sizeof($data) ; $ctr++) {
   			$lecturer = new Lecturer;

   			$lecturer->lecturername = $data[$ctr];
   			$lecturer->training_id = $trainID;

   			$lecturer->save();

   		}//for($ctr = 0 ; $ctr < sizeof($data->speakers) ; $ctr++) {
   	}//public function addLecturer($data, $trainID) {

   	//call
   	public function editLecturer($data, $trainID) {

   		for ($ctr=0; $ctr < sizeof($trainID) ; $ctr++) { 
   			Lecturer::where('training_id', $trainID[$ctr])->delete();

   			
   		}//for
   										
   		$this->editTraining($data);

   	}//public function editLecturer($data, $trainID) {

   	public function loadphoto($photo) {

		$trimfilestring = explode(';', $photo);
		$ext = substr($trimfilestring[0], strpos($trimfilestring[0], "/") + 1);
		$base64string = substr($trimfilestring[1], strpos($trimfilestring[1], ",") + 1);

		$decodephoto = base64_decode($base64string);

		$filename =  "objects/displayphoto/" . str_random() . "." . $ext;

		file_put_contents($filename, $decodephoto);

		return $filename;
		//Storage::disk('public')->put($filename, $decodephoto);

		
		//return asset(Storage::disk('public')->url($filename));
	}//loadphoto
	
	public function readyModal(Request $req) {
		$type = $req->type;
		$id = $req->id;

		return $this->getData($id, $type);


	}//readyModal

	public function getData($id, $type){

		if($type == 0) {

				$ac = Advisory_Council::join('advisory_position', 'advisory_position.ID', '=', 'advisory_council.advisory_position_id')
										->join("ac_sector", "ac_sector.ID", "=", "advisory_council.ac_sector_id")
										->join('unit_office_secondaries', 'unit_office_secondaries.id', '=', 'advisory_council.second_id')
										->join("unit_offices", "unit_offices.id", "=", "unit_office_secondaries.UnitOfficeID")
										->leftJoin('unit_office_tertiaries', 'unit_office_tertiaries.id', '=', 'advisory_council.tertiary_id')
										->leftJoin('unit_office_quaternaries', 'unit_office_quaternaries.id', '=', 'advisory_council.quaternary_id')
										->where("advisory_council.ID" , "=", $id)
										->get();

				return array($ac, $this->formatOutput($ac));

		}else if($type == 1 || $type == 2) {

			$pa = Police_Advisory::join("police_position", "police_position.ID", "=", "police_advisory.police_position_id")
									->join('unit_office_secondaries', 'unit_office_secondaries.id', '=', 'police_advisory.second_id')
									->join("unit_offices", "unit_offices.id", "=", "unit_office_secondaries.UnitOfficeID")
									->leftJoin("unit_office_tertiaries", "unit_office_tertiaries.id", "=", "police_advisory.tertiary_id")
									->leftJoin("unit_office_quaternaries", "unit_office_quaternaries.id", "=", "police_advisory.quaternary_id")
									->where("police_advisory.ID", "=", $id)
									->get();

			$trainings= Training::where("training.police_id", "=", $id)
									->get();

			$lecturelist = array();

			$datelist = array();

			foreach ($trainings as $key => $val) {
				$lecturer = Lecturer::where("training_id", "=", $val->ID)
									->get();
				$startdate = date('d M Y', strtotime($val->startdate));
				$starttime = date('G:i A', strtotime($val->starttime));
				$enddate = date('d M Y', strtotime($val->enddate));
				$endtime = date('G:i A', strtotime($val->endtime));

				array_push($lecturelist, $lecturer);
				array_push($datelist, array($startdate, $starttime, $enddate, $endtime));
				
			}//foreach

			return array($pa, $this->formatOutput($pa), array($trainings, $lecturelist, $datelist));

			
		}//if


	 }//public function getModal(Request $req){

	 public function formatOutput($data) {
	 	foreach ($data as $key => $val) {

	 		if($val->imagepath != "") {
	 			$img = asset($val->imagepath);

	 		} else {
	 			$img = asset('objects/Logo/InitProfile.png');

	 		}//if
			
			$bdate = date('d M Y', strtotime($val->birthdate));
			$startdate = date('d M Y', strtotime($val->startdate));

			if($val->enddate != ""){
				$enddate = date('d M Y', strtotime($val->enddate));
			} else {
				$enddate = "Present";
			}//if

			return array($img, $bdate, $startdate, $enddate);
		}//foreach

	 }//format output

}//class


