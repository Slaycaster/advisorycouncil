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
use File;

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
		//$whereclause = Array();
		//$policeAdvisoryQuery = DB::table('Police_Position');
		
		if($callid == 1)
		{	
			$ACinfo = $this->ACinfo($req);
			return $ACinfo;
		}//civillian advisory

		if($callid == 2)
		{
			$PolAdInfo = $this->PolAdInfo($req);
			return $PolAdInfo;			
		}//police advisory

		if($callid == 3)
		{
			$ACinfo = $this->ACinfo($req);
			$PolAdInfo = $this->PolAdInfo($req);

			return [$ACinfo,$PolAdInfo];
		}// ALL CIVILLIAN AND POLICE ADVISORY
	}

	public function PolAdInfo($req)
	{
		$query = Police_Advisory::query();
			if($req->advisory!=0)
			{
				$query = $query->where('policetype', '=', $req->advisory);
			}
						   								
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
		
			if($req->city != null || $req->city != "")
				{//array_add($whereclause, "city",$city);
					$query = $query->where('city','like','%'.$city.'%');
				}
		
			if($req->province != null || $req->province != "")
				{//array_add($whereclause, "province",$province);
					$query = $query->where('province','like','%'.$req->province.'%');
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
			if($req->ageFrom >0 && $req->ageFrom != '' && $req->ageTo > 0 && $req->ageTo != '') 
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

				if($res->mname != '' && $res->mname!=null)
				{
					$mname = substr($res->mname, 0,1).".";
				}else {$mname = "";}

				if($res->city!='' && $res->province!='')
					{	$location = $res->city. " - ". $res->province; }
				else if($res->city!='' && $res->province=='')
					{ $location = $res->city; }
				else if($res->city=='' && $res->province!='')
				    { $location = $res->province; }
				else { $location = "";}

				$positionname = $this->getName('Police_Position','PositionName',$res->police_position_id); 
			
				$result = $result."|".$res->ID."|".$res->lname."|".$res->fname."|".$mname."|".$office2name."|".$office3name."|".$office4name."|".$positionname."|".$res->policetype."|".$res->gender."|".$location."|".$res->imagepath."|".$res->contactno."|".$res->landline."|".$res->email."|".$res->startdate;

			}

			return $result;
	}

	public function ACinfo($req)
	{
		$query = Advisory_Council::query();

			if($req->office2 != 0)
				{ $query = $query->where('second_id','=',$req->office2); }
				
			if($req->gender != 0)
				{if($req->gender == 2) { $query = $query->where('gender','=',1); }
				 else if($req->gender == 1){ $query = $query->where('gender','=',0);} }

			if($req->sector !=0)
				{ $query = $query->where('ac_sector_id','=',$req->sector); }
		
			if($req->city != null || $req->city != "")
				{ $query = $query->where('city','like','%'.$req->city.'%'); }
		
			if($req->province != null || $req->province != "")
				{ $query = $query->where('province','like','%'.$req->province.'%'); }

			if($req->civposition != 0)
				{ $query = $query->where('advisory_position_id','=',$req->civposition); }

			if($req->ageFrom >0 && $req->ageFrom != '' && $req->ageTo > 0 && $req->ageTo != '')
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

				if($res->mname != '' && $res->mname!=null)
				{
					$mname = substr($res->mname, 0,1).".";
				}else {$mname = "";}

				if($res->city!='' && $res->province!='')
					{	$location = $res->city. " - ". $res->province; }
				else if($res->city!='' && $res->province=='')
					{ $location = $res->city; }
				else if($res->city=='' && $res->province!='')
				    { $location = $res->province; }
				else { $location = "";}

				$positionname = $this->getName('Advisory_Position','acpositionname',$res->advisory_position_id); 
				$sector = $this->getName('AC_Sector','sectorname',$res->ac_sector_id);
			
				$result = $result."|".$res->ID."|".$res->lname."|".$res->fname."|".$mname."|".$office2name."|".$office3name."|".$office4name."|".$sector."|".$positionname."|".$res->gender."|".$location."|".$res->imagepath."|".$res->contactno."|".$res->landline."|".$res->email."|".$res->startdate;

			}

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
	    
	    $this->text(30,$y-15,"Vision: \".... a Highly Capable, Effective and Credible police service towards the attainment of a safer place to live, work and do business.\"");
	    // $this->text(($x/2)+10,199,"Vision: \".... a Highly Capable, Effectuve and Credible police service...");
	    // $this->text(($x/2)+20,201,"Towards the attainment of a safer place to live, work and do business.\"");
	    $this->SetFont('Arial','B',7);

	    $this->Cell(0,9,$this->PageNo().' Page',0,0,'C');
	   // $this->Cell(0,18,$this->PageNo().' Page',0,0,'C');

	}

	function body($req)
	{
		$fname = explode(",", $req->fname);
		$mname = explode(",", $req->mname);
		$lname = explode(",", $req->lname);
    	$position = explode(",", $req->position);
    	$image = explode(",", $req->imageurl);
    	$office2 = explode(",", $req->office2);
    	$office3 = explode(",", $req->office3);
    	$office4 = explode(",", $req->office4);
    	$poltype = explode(",", $req->poltype);
    	$landline = explode(",", $req->landline);	
    	$sector = explode(",", $req->sector);
    	$gender = explode(",", $req->gender);
    	$location = explode(",", $req->address);
    	$contact = explode(",", $req->contact);
    	$email = explode(",", $req->email);
    	$startdate = explode(",", $req->startdate);
    	$trimfilestring;

    	$x = ($this->GetPageWidth())/2;
	    $col=20;
    	$y0=55;
    	$imageCol=23;
    	$imagey0=60;
    	$textCol=60;
    	$texty0=65;

		$i=1;
		
    	while ($i <= count($position)) 
    	{
    		# code...\
    		$this->Rect($col,$y0,85,45);
			$this->SetFont('Arial','B',9);
			$this->Text($textCol,$texty0,(strtoupper($fname[$i-1])." ".strtoupper($mname[$i-1])." ".strtoupper($lname[$i-1])));
			$this->text($textCol-1,$texty0+3," (".$poltype[$i-1].")");
			$this->SetFont('Arial','',8);
			$this->Text($textCol,$texty0+8,$position[$i-1]);
			if($office3[$i-1]!='')
				{ $this->Text($textCol,$texty0+11,$office2[$i-1]." - ".$office3[$i-1]); }
			else { $this->Text($textCol,$texty0+11,$office2[$i-1]); }
			if($office4[$i-1]!="")
			{
				$this->text($textCol,$texty0+14,$office4[$i-1]);
				$this->Text($textCol,$texty0+14,$contact[$i-1]);
				$this->Text($textCol,$texty0+17,$email[$i-1]);
			}
			else 
			{ 
				$this->Text($textCol,$texty0+14,$contact[$i-1]);
				$this->Text($textCol,$texty0+17,$email[$i-1]);
			}
			if($startdate!="")
			{	
				$this->Text($textCol+12,$texty0+32,"Member since ".date("M Y", strtotime($startdate[$i-1])));
			}
			// $trimfilestring = explode('/', $image[$i-1]);
			// $ext = explode('.', $trimfilestring[2]);
			// //var_dump($trimfilestring);
			// $ext = substr($trimfilestring[0], strpos($trimfilestring[0], "/") + 1);
			// $base64string = substr($trimfilestring[1], strpos($trimfilestring[1], ",") + 1);

			// $decodephoto = base64_decode($base64string);

			// $filename =  "objects/displayphoto/" . str_random() . "." . $ext;

			// file_put_contents($filename, $decodephoto);
		   //var_dump($image[27]);
			// $filename = $image[0];
			// print_r($filename);
			// break;
			// print_r($trimfilestring[2]);
			// break;
			// if(($i-1)==12) { $this->Image('objects/Logo/InitProfile.png',$imageCol,$imagey0,35); }
    		
			// else
			// $filename = file_get_contents($image[$i-1]);
			// var_dump($filename);
			
			// var_dump(getimagesize($image[$i-1]));
			if($image[$i-1]!="")
	    			{ 
				    	
						// $curlHandler = curl_init();

						// curl_setopt($curlHandler, CURLOPT_URL, $image[$i-1]);
						// curl_setopt($curlHandler, CURLOPT_HEADER, 0);

						// $output = curl_exec($curlHandler);

						//$img = asset($image[$i-1]);
	    				// $filename = $image[$i-1];
	    				//$this->Image('objects/displayphoto/'.$trimfilestring[2].'',$imageCol,$imagey0,35,35,''.strtoupper($ext[1]).''); 
	    				// $this->setXY($imageCol,$imagey0);
	    				// $filename = file_get_contents($image[$i-1]);
	    				$this->Image($image[$i-1],$imageCol,$imagey0,35,35);
	    				// curl_close($curlHandler);
	    			}
	    		else 
	    		 	{ $this->Image('objects/Logo/InitProfile.png',$imageCol,$imagey0,35,35); }

    		 if((($i+2)%2)==0){
				$col=20;
				$imageCol=23;
				$textCol=60;
				$y0 += 52;
				$imagey0+=52;
				$texty0+=52;
			}
			else{
				$col=($x);
				$imageCol=($x)+3;
				$textCol=(($x)+40);
			}

			if(($i%8)==0){
				$this->AddPage();
				$col=20;
		    	$y0=55;
		    	$imageCol=23;
		    	$imagey0=60;
		    	$textCol=60;
		    	$texty0=65;
			}
			
			$i++;
    	}		

	}

}

class PDF_MemImage extends FPDF
{
	function __construct($orientation='P', $unit='mm', $format='A4')
	{
		parent::__construct($orientation, $unit, $format);
		// Register var stream protocol
		stream_wrapper_register('var', 'VariableStream');
	}

	function MemImage($data, $x=null, $y=null, $w=0, $h=0, $link='')
	{
		// Display the image contained in $data
		$v = 'img'.md5($data);
		$GLOBALS[$v] = $data;
		$a = getimagesize('var://'.$v);
		if(!$a)
			$this->Error('Invalid image data');
		$type = substr(strstr($a['mime'],'/'),1);
		$this->Image('var://'.$v, $x, $y, $w, $h, $type, $link);
		unset($GLOBALS[$v]);
	}

	function GDImage($im, $x=null, $y=null, $w=0, $h=0, $link='')
	{
		// Display the GD image associated with $im
		ob_start();
		imagepng($im);
		$data = ob_get_clean();
		$this->MemImage($data, $x, $y, $w, $h, $link);
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
