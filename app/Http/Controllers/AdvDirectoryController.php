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

use App\Models\ranks;

use App\Models\AC_Subcategory;

use App\Models\Personnel_Sector;

use App\Models\AC_Sector;

use App\Models\Training;

use App\Models\Lecturer;

use DB;

use Auth;



class AdvDirectoryController extends Controller {

	public function readyadd(){

 		return view('module.adviser_add')->with('action', 0);

 	}//select dropdowns

 	public function readyedit() {
 		return view('module.adviser_add')->with('action', 1);
 	}//ready edit

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

				if($data->advcateg == 0) {
					$this->editAC($data);

				} else {
					$this->editTP($data);
					
					$trainID = $this->getTrainIDList($data->ID);

					$this->editLecturer($data, $trainID);


				}//if($data->advcateg == 0) {

				

			}// if
		});


	}//edit - WHOLE

	public function getView() {

		$recorddata = $this->getRecordData();

		return view('module.adviser_add')->with('recorddata', $recorddata);

	}//view for edit

	public function getRecordData(Request $req) {
		$id = 1;
		

		$categ = DB::table('advisers')->select('category')->where('ID', $id)->get();


		if($categ[0]->category == 0) {
			$recorddata = Advisory_Council::with('advisorycouncil')
									->with('training')
									->where('ID', $id)
									->get();


		} else {
			$recorddata =Advisory_Council::with('policeadvisory')
									->with('training')
									->where('ID', $id)
									->get();

		}// if

		$training = Training::with('lecturer')
					->where('adviser_id', $id)
					->get();

		return array($recorddata, date('d M Y', strtotime($recorddata[0]->birthdate)), $training);
		
	}//get record / modal view

	public function getList() {
		/**$directory = DB::table('advisers')
						->select('ID', 'lname', 'fname', 'mname', 'imagepath', 'category', 'email', 'contactno', 'landline')
						->orderBy('ID', 'desc')
						->get();

		//return $directory;

		return view('module.adviser')->with('directory', $directory);**/

		return view('module.adviser');
	}//public function getList() {

	public function readyPHome() {
		if (Auth::check()) {
	    	return redirect('home');

		}//if (Auth::check()) {

		/*$directory = DB::table('advisers')
						->select('ID', 'lname', 'fname', 'mname', 'imagepath', 'category', 'email', 'contactno', 'landline')
						->orderBy('ID', 'desc')
						->get();

		return view('home.defaultphome')->with('directory', $directory);*/


		return view('home.defaultphome');
	}//public function getList() {

	public function getRecent() {
		/*$recent = DB::table('advisers')
						->select('ID', 'lname', 'fname', 'mname', 'imagepath', 'category', 'email', 'contactno', 'landline')
						->orderBy('ID', 'desc')
						->limit(50)
						->get();

		//SUMMARY PANE INSERT CODE HERE
		$all = Advisory_Council::count();
		$ac = Advisory_Council::where('category', '=', 0)->count();
	    $twg = Advisory_Council::where('category', '=', 1)->count();
	    $psmu = Advisory_Council::where('category', '=', 2)->count();
	    $pac = 0;
	    $ptwg = 0;
	    $ppsmu = 0;

	    if ($all > 0) {
	    	$pac = round(($ac/$all) * 100, 2);
		    $ptwg = round(($twg/$all) * 100,2);
		    $ppsmu = round(($psmu/$all) * 100,2);
	    }//if
	    

		return view('home.defaulthome')->with('recent', $recent)
									   ->with('all', $all)
									   ->with('ac', $ac)
									   ->with('twg', $twg)
									   ->with('psmu', $psmu)
									   ->with('pac', $pac)
									   ->with('ptwg', $ptwg)
									   ->with('ppsmu', $ppsmu);*/

		return view('home.defaulthome');

	}//public function getRecent() {

	public function getACID() {
		$getid = Advisory_Council::orderBy('ID', 'desc')->take(1)->get();

		foreach ($getid as $key => $id) {
            return $id->ID;
        }//foreach ($getid as $key => $id) {


	}//public function getID() {

	public function getTPID() {
		$getid = Police_Advisory::orderBy('ID', 'desc')->take(1)->get();

		foreach ($getid as $key => $id) {
            return $id->ID;
        }//foreach ($getid as $key => $id) {


	}//public function getID() {

	public function getTrainIDList($id) {
		$getid = Training::where('training_id', $id)->pluck('ID');

		$trainID = array();
		foreach($getid as $key=> $item) {
			array_push($trainID, $item->ID);

		}//foreach($getid as $key=> $item) {

		return $trainID;
	}//public function getTrainID($id) {

	//DROPDOWN

	public function getInitACD() {
		$acposition = Advisory_Position::all();
 		$accateg = AC_Category::all();
 		$acsector = AC_Sector::all();

 		return array($acposition, $accateg, $acsector);
	}//public function getInitACD() {

	public function getInitTPD() {
		$pnpposition = Police_Position::all();
		$rank = ranks::all();
 		$primaryoffice = unit_offices::all();

 		return array($pnpposition, $rank, $primaryoffice);

	}//public function getInitTPD() {

	public function getSubCateg(Request $req) {
		$categID = $req->categID;

		$subcategory = AC_Subcategory::where('categoryId', $categID)->get();

		return $subcategory;

	}//public function getSubCateg() {

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
	 	$advisory->startdate = $data['durstart'];
	 	$advisory->fbuser = $data['facebook'];
	 	$advisory->twitteruser = $data['twitter'];
	 	$advisory->iguser = $data['instagram'];
	 	$advisory->birthdate = $data['bdate'];
	 	$advisory->street = $data['street'];
	 	$advisory->city = $data['city'];
	 	$advisory->province = $data['province'];
	 	$advisory->barangay = $data['barangay'];


	 	if($data['upphoto'] != "") {
	 		$advisory->imagepath = $this->loadphoto($data['upphoto']);

	 	}//if
	 	print_r($data['acsector']);

        $advisory->advisory_position_id = $data['acposition'];
        $advisory->subcategoryId = $data['acsubcateg'];
        $advisory->save();

        $id = $this->getACID();

        $this->addSector($data['acsector'], $id);
    } // add AC

    public function addSector($sector, $acid) {

    	for($ctr = 0 ; $ctr < sizeof($sector) ; $ctr++) {
    		$acsector = new Personnel_Sector;
    		$acsector->advisory_council_id = $acid;
    		$acsector->ac_sector_id = $sector[$ctr];
    		$acsector->save();


    	}//for

    }//public function addSector() {

    public function editSector($data) {
    	AC_Sector::where('advisory_council_id', $data['ID'])->delete();
    	$this->addSector($data, $data['ID']);

    }//public function editSector($id) {

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
	 	$advisory->startdate = $data['durstart'];
	 	$advisory->fbuser = $data['facebook'];
	 	$advisory->twitteruser = $data['twitter'];
	 	$advisory->iguser = $data['instagram'];
	 	$advisory->birthdate = $data['bdate'];
	 	$advisory->street = $data['street'];
	 	$advisory->city = $data['city'];
	 	$advisory->province = $data['province'];
	 	$advisory->barangay = $data['barangay'];

	 	if($data['upphoto'] != "") {
	 		$advisory->imagepath = $this->loadphoto($data['upphoto']);

	 	}//if

        $advisory->advisory_position_id = $data['acposition'];
        $advisory->subcategoryId = $data['acsubcateg'];
        $advisory->save();

	    $this->editSector($data);

    } // update AC

   	//TWG/PSMU

   	public function addTP($data, $id){
    
    	$advisory = new Police_Advisory;
    	$advisory->fname = $data['fname'];
	 	$advisory->lname = $data['lname'];
	 	$advisory->mname = $data['mname'];
	 	$advisory->qualifier = $data['qname'];
	 	$advisory->gender =  $data['gender'];
	 	$advisory->contactno = $data['mobile'];
	 	$advisory->landline = $data['landline'];
	 	$advisory->email = $data['email'];
	 	$advisory->startdate = $data['durstart'];
	 	$advisory->fbuser = $data['facebook'];
	 	$advisory->twitteruser = $data['twitter'];
	 	$advisory->iguser = $data['instagram'];
	 	$advisory->birthdate = $data['bdate'];
	 	$advisory->street = $data['street'];
	 	$advisory->city = $data['city'];
	 	$advisory->province = $data['province'];
	 	$advisory->barangay = $data['barangay'];

	 	if($data['upphoto'] != "") {
	 		$advisory->imagepath = $this->loadphoto($data['upphoto']);

	 	}//if
    	$advisory->police_position_id = $data['pnppost'];
    	$advisory->rank_id = $data['rank'];
    	$advisory->unit_id = $data['primary'];
    	$advisory->second_id = $data['secondary'];
    	$advisory->tertiary_id = $data['tertiary'];
    	$advisory->quaternary_id = $data['quaternary'];
    	$advisory->authorityorder = $data['authorder'];

    	$advisory->save();

    	$id = $this->getTPID();

    	$this->addTraining($data, $id);

    	//return redirect('policeadvisory');
	    
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
	 	$advisory->startdate = $data['durstart'];
	 	$advisory->fbuser = $data['facebook'];
	 	$advisory->twitteruser = $data['twitter'];
	 	$advisory->iguser = $data['instagram'];
	 	$advisory->birthdate = $data['bdate'];
	 	$advisory->street = $data['street'];
	 	$advisory->city = $data['city'];
	 	$advisory->province = $data['province'];
	 	$advisory->barangay = $data['barangay'];

	 	if($data['upphoto'] != "") {
	 		$advisory->imagepath = $this->loadphoto($data['upphoto']);

	 	}//if
    	$advisory->police_position_id = $data['pnppost'];
    	$advisory->rank_id = $data['rank'];
    	$advisory->unit_id = $data['primary'];
    	$advisory->second_id = $data['secondary'];
    	$advisory->tertiary_id = $data['tertiary'];
    	$advisory->quaternary_id = $data['quaternary'];
    	$advisory->authorityorder = $data['authorder'];
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

		   	$trainID = $this->getTrainID();

		   	$this->addLecturer($data['speaker'][$i], $trainID);

	    }//for

    }// add Training

    public function editTraining($data) {
    	Training::where('police_id', $data['ID'])->delete();

    	$this->addTraining($data, $data['ID']);

    }// update Training

   	public function getTrainID() {
   		$getid = Training::orderBy('ID', 'desc')->take(1)->get();

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

}//class
