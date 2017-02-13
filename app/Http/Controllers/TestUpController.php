<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;

use URL;
class TestUpController extends Controller {

	public function loadphoto(Request $req) {

		$trimfilestring = explode(';', $req->upphoto);
		$ext = substr($trimfilestring[0], strpos($trimfilestring[0], "/") + 1);
		$base64string = substr($trimfilestring[1], strpos($trimfilestring[1], ",") + 1);

		$decodephoto = base64_decode($base64string);

		$filename =  "objects/displayphoto/" . str_random() . "." . $ext;

		file_put_contents($filename, $decodephoto);

		return asset($filename);
		//Storage::disk('public')->put($filename, $decodephoto);

		
		//return asset(Storage::disk('public')->url($filename));
	}//loadphoto
    
}//class
