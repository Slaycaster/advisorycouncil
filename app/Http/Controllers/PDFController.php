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
				
			$res = $query->get();
			$numOfRows = count($res);
			$result = $numOfRows;
			foreach($res as $res)
			{
				$office2name = $this->getOffice2Name($res->second_id);
				$office3name = $this->getOffice3Name($res->tertiary_id);
				$office4name = $this->getOffice4Name($res->quaternary_id);

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

				$positionname = $this->getPositionName('Advisory_Position','acpositionname',$res->advisory_position_id); 
				$sector = $this->getSectorName($res->ac_sector_id);
			
				$result = $result."/".$res->lname." - ".$res->fname." ".$res->mname."/".$office."/".$sector."/".$positionname."/".$res->gender."/".$res->city."-".$res->province."/".$res->imagepath."/".$res->contactno."/".$res->email."/".$res->startdate;

			}
			
			return $result;
			
		}//civillian advisory

		if($callid == 2){
			
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
			$res = $query->get();
			$numOfRows = count($res);
			$result = $numOfRows;
			foreach($res as $res)
			{
				$office2name = $this->getOffice2Name($res->second_id);
				$office3name = $this->getOffice3Name($res->tertiary_id);
				$office4name = $this->getOffice4Name($res->quaternary_id);

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

				$positionname = $this->getPositionName('Police_Position','PositionName',$res->police_position_id); 
			
				$result = $result."/".$res->lname.", ".$res->fname." ".$res->mname."/".$office."/".$positionname."/".$res->gender."/".$res->city."-".$res->province."/".$res->imagepath."/".$res->contactno."/".$res->email."/".$res->startdate;

			}
			

						

			return $result;
		}//police advisory

	}

	public function getOffice2Name($second)
	{
		$officename = unit_office_secondaries::select('UnitOfficeSecondaryName')->where('id','=', $second)->first();
		$name = $officename->UnitOfficeSecondaryName;
		return $name;
		
	}

	public function getOffice3Name($tertiary)
	{
		if($tertiary!='' || $tertiary!=null){
			$officename = unit_office_tertiaries::select('UnitOfficeTertiaryName')->where('id','=', $tertiary)->first();
			$name = $officename->UnitOfficeTertiaryName;
			return $name;
		} else {return '';}
	}

	public function getOffice4Name($quaternary)
	{
		if($quaternary!='' || $quaternary!=null){
			$officename = unit_office_quaternaries::select('UnitOfficeQuaternaryName')->where('id','=',$quaternary)->first();
			$name = $officename->UnitOfficeQuaternaryName;
			return $name;
		} else {return '';}
	}

	public function getPositionName($tbl,$field,$position)
	{
		$posname = DB::table($tbl)->select($field)->where('id','=',$position)->first();
		$name = $posname->$field;
		return $name;
	}

	public function getSectorName($sector)
	{
		$sectname = AC_Sector::select('sectorname')->where('ID','=',$sector)->first();
		$name = $sectname->sectorname;
		return $name;
	}

    public function createPDF(Request $req)
    {
    	//var_dump($req->all());
    	$name = explode("/", $req->name);
    	$position = explode(",", $req->position);
    	$image = explode(",", $req->imageurl);
    	$office = explode(",", $req->office);
    	$sector = explode(",", $req->sector);
    	$gender = explode(",", $req->gender);
    	$location = explode(",", $req->address);
    	$contact = explode(",", $req->contact);
    	$email = explode(",", $req->email);

    	$col= 10;
    	$y0=40;
    	$imageCol=12;
    	$imagey0=42;
    	$textCol=38;
    	$texty0=45;

    	$fpdf= new PDF;
    	$fpdf->AddPage(90);
    	$fpdf->SetFont('Arial','B',16);

    	$i=1;
    	while ($i <= count($position)) 
    	{
    		# code...
    		$fpdf->Rect($col,$y0,64,35);
			$fpdf->Image('images/Philippine-National-Police.png',$imageCol,$imagey0,23);
			$fpdf->SetFont('Arial','B',7);
			$fpdf->Text($textCol,$texty0,$name[$i-1]);
			$fpdf->Text($textCol,$texty0+4,$position[$i-1]);
			$fpdf->Text($textCol,$texty0+8,$office[$i-1]);
			$fpdf->Text($textCol,$texty0+12,$contact[$i-1]);
			$fpdf->Text($textCol,$texty0+16,$email[$i-1]);
			if((($i+2)%2)==0){
				$col+=75;
				$imageCol+=75;
				$textCol+=75;
			}
			else{
				$col+=70;
				$imageCol+=70;
				$textCol+=70;
			}

			if(($i%16) ==0){
				$fpdf->AddPage(90);
				$col= 10;
				$imageCol=12;
				$textCol=38;
				$y0 = 40;
				$imagey0=42;
				$texty0=45;
			}
			
			if((($i+4)%4) ==0)
			{
				$col= 10;
				$imageCol=12;
				$textCol=38;
				$y0 += 40;
				$imagey0+=40;
				$texty0+=40;
			}
			
			$i++;
    	}		

    	$headers=['Content-Type' => 'application/pdf'];

    	//return $req->all();
    	return Response::make($fpdf->output('Advisory_Council.pdf','I'),200, $headers);

    }

}//CLASS PDFController

class PDF extends FPDF
{
	// Page header
	function Header()
	{
	    // Logo
	    // Arial bold 15
	    $this->Image('images/Philippine-National-Police.png',10,6,15);
	    $this->SetFont('Arial','B',15);
	    // Move to the right
	    $this->Cell(-160);
	    $this->Cell(0,10,'ADVISORY COUNCIL',0,0,'C');
	    
	    $this->Image('images/Philippine-National-Police.png',165,6,15);
	    $this->Cell(-120);
	    $this->Cell(0,10,'ADVISORY COUNCIL',0,0,'C');
	    $this->Ln(10);
	}

	// Page footer
	function Footer()
	{
	    // Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');

	}


}


// for($i=1;$i <= count($req->position);$i++)
//     	{	
// 			for($j=1;$j<=4;$j++){
// 				$fpdf->Rect($col,$y0,64,35);
// 				$fpdf->Image('images/Philippine-National-Police.png',$imageCol,$imagey0,23);
// 				$fpdf->SetFont('Arial','B',10);
// 				$fpdf->Text($textCol,$texty0,$req->[$i-1]);
// 				$fpdf->Text($textCol,$texty0+5,$req->pdfdata[$i-1]);
// 				$fpdf->Text($textCol,$texty0+10,$req->pdfdata[$i-1]);
// 				$fpdf->Text($textCol,$texty0+15,$req->pdfdata[$i-1]);
// 				$fpdf->Text($textCol,$texty0+20,$req->pdfdata[$i-1]);
// 				if($j==2){
// 					$col+=75;
// 					$imageCol+=75;
// 					$textCol+=75;
// 				}
// 				else{
// 					$col+=70;
// 					$imageCol+=70;
// 					$textCol+=70;
// 				}

// 			}

// 			$pagebreaker = $i%4;
// 			if($pagebreaker == 0){
// 				$fpdf->AddPage(90);
// 				$y0 = 40;
// 				$imagey0=42;
// 				$texty0=45;
// 			}
// 			else{
// 				$y0 += 40;
// 				$imagey0+=40;
// 				$texty0+=40;
// 			}

// 			$col= 10;
// 			$imageCol=12;
// 			$textCol=42;

// 		}
