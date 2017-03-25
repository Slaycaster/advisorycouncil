<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\AC_Sector;
use DB;
use App\Http\Controllers\Controller;

class acsectorController extends Controller
{
   
    public function index_acsectors(Request $req){
      $req->session()->put('tabtitle', '#tab2');
      
      $sector = DB::table('AC_Sector')
      ->orderBy('AC_Sector.ID','DESC')
      ->get();
      return view('maintenancetable.acsector_table')
      ->with('sector', $sector);
      
    }

 
    public function acsectorCRUD(Request $request)
    {

        $callId = $request->callId;

        if($callId==1)
        {
            $acsec = new AC_Sector;
              $acsec->sectorname = $request->secname;
              $acsec->desc = $request->secdesc;
            $acsec->save();

        }

        if($callId==2)
        {
            $id = $request->id;
            $acsec = AC_Sector::find($id);

            return $acsec;

        }

        if($callId==3)
        {
            $id = $request->id;
            $acsec= AC_Sector::find($id);
            $acsec->sectorname = $request->secname;
            $acsec->desc = $request->secdesc;
            $acsec->save();
        }
    }



}//ENDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD 
