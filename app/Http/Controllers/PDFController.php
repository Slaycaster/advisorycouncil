<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use App\Http\Requests;
USE Codedge\Fpdf\Fpdf\FPDF;
use App\Http\Controllers\Controller;
use App\Models\Advisory_Council;
use App\Models\Police_Advisory;

class PDFController extends Controller
{
    public function createPDF( Request $req)
    {
    	$col= 10;
    	$y0=40;
    	$imageCol=12;
    	$imagey0=42;
    	$textCol=42;
    	$texty0=45;

    	$fpdf= new PDF;
    	$fpdf->AddPage(90);
    	$fpdf->SetFont('Arial','B',16);

    	for($i=1;$i <= 6;$i++){
			for($j=1;$j<=4;$j++){
				$fpdf->Rect($col,$y0,64,35);
				$fpdf->Image('images/Philippine-National-Police.png',$imageCol,$imagey0,23);
				$fpdf->SetFont('Arial','B',0);
				$fpdf->Text($textCol,$texty0,'name');
				$fpdf->Text($textCol,$texty0+5,'Position');
				$fpdf->Text($textCol,$texty0+10,'Office');
				$fpdf->Text($textCol,$texty0+15,'Email');
				$fpdf->Text($textCol,$texty0+20,'Contact');
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

    	return Response::make($fpdf->output(),200, $headers);
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
