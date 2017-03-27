<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Response;
use App\Http\Requests;
USE Codedge\Fpdf\Fpdf\FPDF;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Advisory_Council;
use App\Models\Advisory_Position;
use App\Models\Police_Position;
use App\Models\AC_Sector;
use App\Models\Police_Advisory;
use App\Models\unit_office_quaternaries;
use App\Models\unit_office_tertiaries;
use App\Models\unit_office_secondaries;
class PDFController extends Controller
{
	public function index(){
		$advisoryCouncil = Advisory_Council::get();
		$policeAdvisory = Police_Advisory::get();
		$policeposition = Police_Position::get();
		$advisoryposition = Advisory_Position::get();
		$acsector = AC_Sector::get();
		$unitsecond = unit_office_secondaries::get();
		$unittertiary = unit_office_tertiaries::get();
		$unitquaternary = unit_office_quaternaries::get();
		return view('/welcome')->with('advisoryCouncil',$advisoryCouncil)
							   ->with('policeAdvisory',$policeAdvisory)
							   ->with('policeposition', $policeposition)
							   ->with('advisoryposition', $advisoryposition)
							   ->with('acsector', $acsector)
							   ->with('unitsecond', $unitsecond)
							   ->with('unittertiary', $unittertiary)
							   ->with('unitquaternary', $unitquaternary);
	}
	public function loaddata(Request $req)
	{
		$callid = $req->callid;
		$city =$req->city;
		$province=$req->province;
		$ageFrom=$req->ageFrom;
		$ageTo=$req->ageTo;
		$numOfRows = 0;
		$result;
		//$whereclause = Array();
		//$policeAdvisoryQuery = DB::table('Police_Position');
		
		if($callid == 1){
			$query = Advisory_Council::query();
			if($req->office2 != 0)
				{ $query = $query->where('second_id','=',$req->office2); }
				
			if($req->gender != 0)
				{if($req->gender == 2) { $query = $query->where('gender','=',1); }
				 else if($req->gender == 1){ $query = $query->where('gender','=',0);} }
			if($req->sector !=0)
				{ $query = $query->where('ac_sector_id','=',$req->sector); }
		
			if($city != null || $city != "")
				{ $query = $query->where('city','like','%'.$city.'%'); }
		
			if($province != null || $province != "")
				{ $query = $query->where('province','like','%'.$province.'%'); }
			if($req->civposition != 0)
				{ $query = $query->where('advisory_position_id','=',$req->civposition); }
			if($ageFrom >0 && $ageTo > 0)
				{
					$query = $query->whereRaw("TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) >=" . $ageFrom . " and TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) <= " . $ageTo);
									
				}
				
			$res = $query->distinct()->get();
			$numOfRows = count($res);
			$result = $numOfRows;
			foreach($res as $res)
			{
				$office2name = $this->getName('unit_office_secondaries','UnitOfficeSecondaryName',$res->second_id);
				$office3name = $this->getName('unit_office_tertiaries','UnitOfficeTertiaryName',$res->tertiary_id);
				$office4name = $this->getName('unit_office_quaternaries','UnitOfficeQuaternaryName',$res->quaternary_id);
				if($office3name!='' && $office4name!='')
				{
					$office = $office4name." - ".$office3name." - ".$office2name;
				}
				if($office3name!='' && $office4name=='')
				{
					$office = $office3name." - ".$office2name;
				}
				if($office3name=='' && $office4name=='')
				{
					$office = $office2name;
				}
<<<<<<< HEAD
				$positionname = $this->getName('Advisory_Position','acpositionname',$res->advisory_position_id); 
				$sector = $this->getName('AC_Sector','sectorname',$res->ac_sector_id);
			
				$result = $result."/".$res->lname.", ".$res->fname." ".$res->mname."/".$office."/".$sector."/".$positionname."/".$res->gender."/".$res->city."-".$res->province."/".$res->imagepath."/".$res->contactno."/".$res->email."/".$res->startdate;
=======

				if($res->mname != '' && $res->mname!=null)
				{
					$mname = substr($res->mname, 0,1).".";
				}else {$mname = "";}

				$positionname = $this->getName('Advisory_Position','acpositionname',$res->advisory_position_id); 
				$sector = $this->getName('AC_Sector','sectorname',$res->ac_sector_id);
			
				$result = $result."/".$res->lname.", ".$res->fname." ".$mname."/".$office."/".$sector."/".$positionname."/".$res->gender."/".$res->city."-".$res->province."/".$res->imagepath."/".$res->contactno."/".$res->email."/".$res->startdate;

>>>>>>> 62717d264d5971ea482ad86498a0a5bb6b279e37
			}
			
		}//civillian advisory
		if($callid == 2)
		{
			
			$query = Police_Advisory::query();
			$query = $query->where('policetype', '=', $req->advisory);
						   								
			if($req->office2 != 0)
				{ 
					//array_add($whereclause, "second_id",$req->office2);
					$query = $query->where('second_id','=',$req->office2);
				}
				
			if($req->gender != 0)
				{if($req->gender == 2) { //array_add($whereclause,"gender",0);
										 $query = $query->where('gender','=',1); }
				 else if($req->gender == 1){//array_add($whereclause,"gender",0);
											$query = $query->where('gender','=',0);} }
		
			if($city != null || $city != "")
				{//array_add($whereclause, "city",$city);
					$query = $query->where('city','like','%'.$city.'%');
				}
		
			if($province != null || $province != "")
				{//array_add($whereclause, "province",$province);
					$query = $query->where('province','like','%'.$province.'%');
				}
		
			if($req->office3 != 0)
				{//array_add($whereclause, "tertiary_id",$req->office3);
					$query = $query->where('tertiary_id','=',$req->office3);
				}
		
			if($req->office4 != 0)
				{//array_add($whereclause, "quaternary_id",$req->office4); 
					$query = $query->where('quaternary_id','=',$req->office4);
				}
		
			if($req->polposition != 0)
				{//array_add($whereclause, "police_position_id",$req->polposition);
					$query = $query->where('police_position_id','=',$req->polposition);
				}
			if($ageFrom >0 && $ageFrom != '' && $ageTo > 0 && $ageTo != '') 
				{
					$query = $query->whereRaw("TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) >=" . $ageFrom . " and TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) <= " . $ageTo);
				
									
				}
			//var_dump($query->toSql());
			$res = $query->distinct()->get();
			$numOfRows = count($res);
			$result = $numOfRows;
			foreach($res as $res)
			{
				$office2name = $this->getName('unit_office_secondaries','UnitOfficeSecondaryName',$res->second_id);
				$office3name = $this->getName('unit_office_tertiaries','UnitOfficeTertiaryName',$res->tertiary_id);
				$office4name = $this->getName('unit_office_quaternaries','UnitOfficeQuaternaryName',$res->quaternary_id);
				if($office3name!='' && $office4name!='')
				{
					$office = $office4name." - ".$office3name." - ".$office2name;
				}
				if($office3name!='' && $office4name=='')
				{
					$office = $office3name." - ".$office2name;
				}
				if($office3name=='' && $office4name=='')
				{
					$office = $office2name;
				}
<<<<<<< HEAD
				$positionname = $this->getName('Police_Position','PositionName',$res->police_position_id); 
			
				$result = $result."/".$res->lname.", ".$res->fname." ".$res->mname."/".$office."/".$positionname."/".$res->gender."/".$res->city."-".$res->province."/".$res->imagepath."/".$res->contactno."/".$res->email."/".$res->startdate;
=======

				if($res->mname != '' && $res->mname!=null)
				{
					$mname = substr($res->mname, 0,1).".";
				}else {$mname = "";}

				$positionname = $this->getName('Police_Position','PositionName',$res->police_position_id); 
			
				$result = $result."/".$res->lname.", ".$res->fname." ".$mname."/".$office."/".$positionname."/".$res->gender."/".$res->city."-".$res->province."/".$res->imagepath."/".$res->contactno."/".$res->email."/".$res->startdate;

>>>>>>> 62717d264d5971ea482ad86498a0a5bb6b279e37
			}
		}//police advisory
		if($callid == 3)
		{
			$query = Advisory_Council::query();
			$query2 = Police_Position::query();
			if($req->office2 != 0)
				{ 
					//array_add($whereclause, "second_id",$req->office2);
					$query = $query->where('second_id','=',$req->office2);
					$query2 = $query2->where('second_id','=',$req->office2);
				}
			if($req->office3 != 0)
				{//array_add($whereclause, "tertiary_id",$req->office3);
					$query = $query->where('tertiary_id','=',$req->office3);
					$query2 = $query2->where('tertiary_id','=',$req->office3);
				}
		
			if($req->office4 != 0)
				{//array_add($whereclause, "quaternary_id",$req->office4); 
					$query = $query->where('quaternary_id','=',$req->office4);
					$query2 = $query2->where('quaternary_id','=',$req->office4);
				}
			if($city != null || $city != "")
				{ 
					$query = $query->where('city','like','%'.$city.'%');
					$query2 = $query2->where('city','like','%'.$city.'%');
				}
		
			if($province != null || $province != "")
				{ 
					$query = $query->where('province','like','%'.$province.'%');
					$query2 = $query2->where('province','like','%'.$province.'%');
				}
<<<<<<< HEAD
			if($ageFrom >0 && $ageTo > 0)
=======

			if($ageFrom >0 && $ageTo > 0 && $ageFrom != '' && $ageTo != '') 
>>>>>>> 62717d264d5971ea482ad86498a0a5bb6b279e37
				{
					$query = $query->whereRaw("TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) >=" . $ageFrom . " and TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) <= " . $ageTo);
					$query2 = $query2->whereRaw("TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) >=" . $ageFrom . " and TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) <= " . $ageTo);
									
				}

			$res = $query->get();
			$res2 = $query->get();
			$numOfRows = count($res);
			$numOfRows2 = count($res2);
			$result = $numOfRows;
			$result2 = $numOfRows2;
			
			foreach($res2 as $res2)
			{
				$office2name = $this->getName('unit_office_secondaries','UnitOfficeSecondaryName',$res2->second_id);
				$office3name = $this->getName('unit_office_tertiaries','UnitOfficeTertiaryName',$res2->tertiary_id);
				$office4name = $this->getName('unit_office_quaternaries','UnitOfficeQuaternaryName',$res2->quaternary_id);
				if($office3name!='' && $office4name!='')
				{
					$office = $office4name." - ".$office3name." - ".$office2name;
				}
				if($office3name!='' && $office4name=='')
				{
					$office = $office3name." - ".$office2name;
				}
				if($office3name=='' && $office4name=='')
				{
					$office = $office2name;
				}
<<<<<<< HEAD
				$positionname = $this->getName('Advisory_Position','acpositionname',$res2->advisory_position_id); 
				$sector = $this->getName('AC_Sector','sectorname',$res2->ac_sector_id);
			
				$result2 = $result2."/". $res2->ID."/".$res2->lname.", ".$res2->fname." ".$res2->mname."/".$office."/".$sector."/".$positionname."/".$res2->gender."/".$res2->city."-".$res2->province."/".$res2->imagepath."/".$res2->contactno."/".$res2->email."/".$res2->startdate;
=======

				if($res2->mname != '' && $res2->mname!=null)
				{
					$midname = substr($res2->mname,0, 1).".";
				}else {$midname = "";}

				$positionname = $this->getName('Advisory_Position','acpositionname',$res2->advisory_position_id); 
				$sector = $this->getName('AC_Sector','sectorname',$res2->ac_sector_id);
			
				$result2 = $result2."/".$res2->lname.", ".$res2->fname." ".$midname."/".$office."/".$sector."/".$positionname."/".$res2->gender."/".$res2->city."-".$res2->province."/".$res2->imagepath."/".$res2->contactno."/".$res2->email."/".$res2->startdate;

>>>>>>> 62717d264d5971ea482ad86498a0a5bb6b279e37
			}
			foreach($res as $res)
			{
				$office2name = $this->getName('unit_office_secondaries','UnitOfficeSecondaryName',$res->second_id);
				$office3name = $this->getName('unit_office_tertiaries','UnitOfficeTertiaryName',$res->tertiary_id);
				$office4name = $this->getName('unit_office_quaternaries','UnitOfficeQuaternaryName',$res->quaternary_id);
				if($office3name!='' && $office4name!='')
				{
					$office = $office4name." - ".$office3name." - ".$office2name;
				}
				if($office3name!='' && $office4name=='')
				{
					$office = $office3name." - ".$office2name;
				}
				if($office3name=='' && $office4name=='')
				{
					$office = $office2name;
				}
<<<<<<< HEAD
				$positionname = $this->getName('Police_Position','PositionName',$res->police_position_id); 
			
				$result = $result."/".$res->lname.", ".$res->fname." ".$res->mname."/".$office."/".$positionname."/".$res->gender."/".$res->city."-".$res->province."/".$res->imagepath."/".$res->contactno."/".$res->email."/".$res->startdate;
=======

				if($res->mname != '' && $res->mname!=null)
				{
					$mname = substr($res->mname, 0,1).".";
				}else {$mname = "";}

				$positionname = $this->getName('Police_Position','PositionName',$res->police_position_id); 
			
				$result = $result."/".$res->lname.", ".$res->fname." ".$mname."/".$office."/".$positionname."/".$res->gender."/".$res->city."-".$res->province."/".$res->imagepath."/".$res->contactno."/".$res->email."/".$res->startdate;

>>>>>>> 62717d264d5971ea482ad86498a0a5bb6b279e37
			}
			return [$result,$result2];
		}// ALL CIVILLIAN AND POLICE ADVISORY
		return $result;
			
	}
	public function getName($tbl,$field,$office)
	{
		if($office != '' && $office!=null){
			$officename = DB::table($tbl)->select($field)->where('id','=', $office)->first();
			$name = $officename->$field;
			return $name;
		}
		else {return '';} 	
	}
    public function createPDF(Request $req)
    {
    	//var_dump($req->all());
    	$fpdf= new PDF;
    	$fpdf->AddPage();
    	$fpdf->body($req);
    	$headers=['Content-Type' => 'application/pdf'];
    	return Response::make($fpdf->output('Advisory_Council.pdf','I'),200, $headers);
    }
}//CLASS PDFController
class PDF extends FPDF
{
	// Page header
	function Header()
	{
	    $x = $this->GetPageWidth();
	    $this->Image('images/Philippine-National-Police.png',20,15,20);
	    $this->Image('images/pp_logoforae.png',($x)-45,15,25);
	    $this->SetFont('times','b',12);
	    $this->text(($x/2)-25,25,'Republic of the Philippines');
	    $this->text(($x/2)-37,29,'Center for Police Strategy Management');
	    $this->text(($x/2)-17,33,'C.Y. 2017-2018');
	    
	    // Move to the right
	    //$this->cell(160);
	    //$this->setFillColor(0,37,58);
	    //$this->Rect(0,40,100,200);
	    
	    // $this->Image('images/Philippine-National-Police.png',($x/2)+10,6,15);
	    // $this->Image('images/pp_logoforae.png',$x-27,6,20);
	    // $this->Cell(-120);
	    // $this->Cell(0,10,'ADVISORY COUNCIL',0,0,'C');
	    $this->Ln(10);
	}
	// Page footer
	function Footer()
	{
	    // Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    $y = $this->GetPageHeight();
	    $x = $this->GetPageWidth();
	    // $this->Line(0,$y-15,$x,$y-15);
	    // $this->Line($x/2,0,$x/2,$y);
	    // // Arial italic 8
	    $this->SetFont('Arial','',7);
	    // Page numbe
	    
<<<<<<< HEAD
	    $this->text(10,199,"Vision: \".... a Highly Capable, Effectuve and Credible police service...");
	    $this->text(20,201,"Towards the attainment of a safer place to live, work and do business.\"");
	    $this->text(($x/2)+10,199,"Vision: \".... a Highly Capable, Effectuve and Credible police service...");
	    $this->text(($x/2)+20,201,"Towards the attainment of a safer place to live, work and do business.\"");
	    $this->SetFont('Arial','B',5);
	    $this->Cell(128,18,$this->PageNo().' Page',0,0,'C');
	    $this->Cell(178,18,$this->PageNo().' Page',0,0,'C');
=======
	    $this->text(30,$y-15,"Vision: \".... a Highly Capable, Effective and Credible police service towards the attainment of a safer place to live, work and do business.\"");
	    // $this->text(($x/2)+10,199,"Vision: \".... a Highly Capable, Effectuve and Credible police service...");
	    // $this->text(($x/2)+20,201,"Towards the attainment of a safer place to live, work and do business.\"");
	    $this->SetFont('Arial','B',7);

	    $this->Cell(0,9,$this->PageNo().' Page',0,0,'C');
	   // $this->Cell(0,18,$this->PageNo().' Page',0,0,'C');

>>>>>>> 62717d264d5971ea482ad86498a0a5bb6b279e37
	}
	function body($req)
	{
		$name = explode("/", $req->name);
    	$position = explode(",", $req->position);
    	$image = explode(",", $req->imageurl);
    	$office = explode(",", $req->office);
    	$sector = explode(",", $req->sector);
    	$gender = explode(",", $req->gender);
    	$location = explode(",", $req->address);
    	$contact = explode(",", $req->contact);
    	$email = explode(",", $req->email);
<<<<<<< HEAD
    	$col= 12;
    	$y0=40;
    	$imageCol=13;
    	$imagey0=41;
    	$textCol=42;
    	$texty0=45;
=======

    	$x = ($this->GetPageWidth())/2;
	    $col=20;
    	$y0=55;
    	$imageCol=21;
    	$imagey0=56;
    	$textCol=58;
    	$texty0=60;

>>>>>>> 62717d264d5971ea482ad86498a0a5bb6b279e37
		$i=1;
    	while ($i <= count($position)) 
    	{
    		# code...\

    		$this->Rect($col,$y0,85,45);
			$this->SetFont('Arial','B',9);
			$this->Text($textCol,$texty0,strtoupper($name[$i-1]));
			$this->SetFont('Arial','',8);
			$this->Text($textCol,$texty0+8,$position[$i-1]);
			$this->Text($textCol,$texty0+11,$office[$i-1]);
			$this->Text($textCol,$texty0+14,$contact[$i-1]);
			$this->Text($textCol,$texty0+17,$email[$i-1]);
			if($image[$i-1] == null)
    			{ $this->Image('objects/Logo/InitProfile.png',$imageCol,$imagey0,35); }
    		else 
<<<<<<< HEAD
    			{ $this->Image($image[$i-1],$imageCol,$imagey0,23); }
=======
    			{ $this->Image($image[$i-1],$imageCol,$imagey0,35); }

>>>>>>> 62717d264d5971ea482ad86498a0a5bb6b279e37
			if((($i+2)%2)==0){
				$col=20;
				$imageCol=21;
				$textCol=58;
				$y0 += 52;
				$imagey0+=52;
				$texty0+=53;
			}
			else{
				$col=($x);
				$imageCol=($x)+1;
				$textCol=(($x)+38);
			}
<<<<<<< HEAD
			if(($i%16) ==0){
				$this->AddPage(90);
				$col= 10;
				$imageCol=12;
				$textCol=38;
				$y0 = 40;
				$imagey0=42;
				$texty0=45;
=======

			if(($i%8)==0){
				$this->AddPage();
				$col=20;
		    	$y0=55;
		    	$imageCol=21;
		    	$imagey0=56;
		    	$textCol=58;
		    	$texty0=60;
>>>>>>> 62717d264d5971ea482ad86498a0a5bb6b279e37
			}
			
			$i++;
    	}		
	}
}