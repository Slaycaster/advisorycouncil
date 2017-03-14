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
				{ $query = $query->where('city','=',$city); }
		
			if($province != null || $province != "")
				{ $query = $query->where('province','=',$province); }

			if($req->civposition != 0)
				{ $query = $query->where('advisory_position_id','=',$req->civposition); }
		
			$res = $query->get();

			return $res;
			
		}//civillian advisory

		if($callid == 2){
			
			$query = Police_Advisory::query();

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
					$query = $query->where('city','=',$city);
				}
		
			if($province != null || $province != "")
				{//array_add($whereclause, "province",$province);
					$query = $query->where('province','=',$province);
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
		
			$res = $query->get();
			//var_dump($req->all(),$query->toSql());
			return $res;
		}//police advisory

	}

    public function createPDF(Request $req)
    {
    	$data = $res;
    	$col= 10;
    	$y0=40;
    	$imageCol=12;
    	$imagey0=42;
    	$textCol=42;
    	$texty0=45;

    	$fpdf= new PDF;
    	$fpdf->AddPage(90);
    	$fpdf->SetFont('Arial','B',16);

    	for($i=1;$i <= count($data);$i++)
    	{	
			for($j=1;$j<=4;$j++){
				$fpdf->Rect($col,$y0,64,35);
				$fpdf->Image('images/Philippine-National-Police.png',$imageCol,$imagey0,23);
				$fpdf->SetFont('Arial','B',10);
				$fpdf->Text($textCol,"Name");
				$fpdf->Text($textCol,"Position");
				$fpdf->Text($textCol,"Address");
				$fpdf->Text($textCol,"Contact No");
				$fpdf->Text($textCol,"Email");
				if($j==2){
					$col+=75;
					$imageCol+=75;
					$textCol+=75;
				}
				else{
					$col+=70;
					$imageCol+=70;
					$textCol+=70;
				}

			}

			$pagebreaker = $i%4;
			if($pagebreaker == 0){
				$fpdf->AddPage(90);
				$y0 = 40;
				$imagey0=42;
				$texty0=45;
			}
			else{
				$y0 += 40;
				$imagey0+=40;
				$texty0+=40;
			}

			$col= 10;
			$imageCol=12;
			$textCol=42;

		}

    	$headers=['Content-Type' => 'application/pdf'];

    	return Response::make($fpdf->output('Advisory_Council.pdf','F'),200, $headers);

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
	    $this->Cell(-170);
	    $this->Cell(0,10,'Advisory Council',0,0,'C');
	    
	    $this->Image('images/Philippine-National-Police.png',165,6,15);
	    $this->Cell(-120);
	    $this->Cell(0,10,'Advisory Council',0,0,'C');
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
