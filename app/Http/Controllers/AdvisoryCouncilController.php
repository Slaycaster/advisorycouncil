<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Models;
use Carbon\Carbon;
use App\Models\Advisers;
use App\Models\AdvisoryCouncil;
use App\Models\AC_Subcategory;
use App\Models\AC_Category;
use App\Models\Advisory_Position;
use App\Models\Personnel_Sector;
use App\Http\Controllers\Controller;
use App\Models\AC_Sector;
use App\Http\Requests;
use DB;

class AdvisoryCouncilController extends Controller
{
    public function index(){
        try {
             $advisory = Advisory_Council::with('advisoryposition')->with('acsubcategory')->get();
            $subcat = AC_Subcategory::all();
            $category = AC_Category::orderBy('categoryname')->get();
            $position = Advisory_Position::all();
            $personnel = Personnel_Sector::all();
            $acsector = AC_Sector::all();    
          
            return view('transaction.Advisorycouncil')->with('council', $advisory)->with('subcat', $subcat)
                        ->with('cat', $category)->with('positions', $position)->with('sector', $personnel)
                        ->with('ac', $acsector);
           
        } catch(\Exception $e) {
            return view('errors.errorpage')->with('pass', 'true');
        }//

       

    }

    public function getID($tbl, $field){
          $stmt = DB::table($tbl)->select($field)->orderBy($field, 'desc')->first();

        if (is_null($stmt)) {
            $id = 1;

        } else {
            $id = $stmt->$field + 1;


        }//if (is_null($stmt)) {

        return $id;

    }
  
    public function acCRUD(Request $request)
    {

        $callId = $request->callId;

        if($callId==1)
            
        {

            $acID = $this->getID('Advisers','ID');

            $advisory = new Advisory_Council;
            $advisory->ID = $acID-1;
            $advisory->officename = $request->acofficenamE;
            $advisory->officeaddress = $request->acofficeadD;
            $advisory->advisory_position_id = $request->positioN;
            $advisory->subcategoryId = $request->subcaT;
            $advisory->save();
            $count = sizeof($request->sectoR);
            for($i=0;$i<$count;$i++){
                $personnel = new Personnel_Sector;
                $personnel->advisory_council_id = $acID-1;
                $personnel->ac_sector_id = $request->sectoR[$i];
                $personnel->save();
            }
        }

        if($callId==2)
        {
            $id = $request->id;

            $sector = Array();
            $acsec = Advisory_Council::find($id);
            $sector = DB::table('AC_Sector')
                        ->select('AC_Sector.ID','AC_Sector.sectorname')
                        ->join('Personnel_Sector','AC_Sector.ID','=','Personnel_Sector.ac_sector_id')
                        ->join('Advisory_Council','Personnel_Sector.advisory_council_id','=', 'Advisory_Council.ID')
                        ->where('Advisory_Council.ID','=', $id)
                        ->where('Personnel_Sector.advisory_council_id','=', $id)
                        ->get();

            $sub = DB::table('AC_Subcategory')
                    ->select('AC_Subcategory.ID','AC_Subcategory.subcategoryname')
                    ->join('Advisory_Council','AC_Subcategory.ID','=','Advisory_Council.subcategoryId')
                    ->where('Advisory_Council.ID','=', $id)
                    ->get();

            foreach($sub as $sub){


                $cat = DB::table('ACCategory')
                        ->select('ACCategory.ID','ACCategory.categoryname')
                        ->join('ACSubcategory','ACCategory.ID','=','ACSubcategory.categoryId')
                        ->join('AdvisoryCouncil','ACSubcategory.ID','=','AdvisoryCouncil.subcategoryId')
                        ->where('AdvisoryCouncil.ID','=', $id)
                        ->get();
            }

            $post = DB::table('Advisory_Position')
                        ->select('Advisory_Position.ID','Advisory_Position.acpositionname')
                        ->join('Advisory_Council','Advisory_Position.ID','=','Advisory_Council.advisory_position_id')
                        ->where('Advisory_Council.ID','=', $id)
                        ->get();

            return [$acsec,$sector,$post,$cat,$sub];

        }

        if($callId==3)
        {
             $acID = $request->id;

            $advisory = Advisory_Council::find($acID);
            $advisory->officename = $request->acofficenamE;
            $advisory->officeaddress = $request->acofficeadD;
            $advisory->advisory_position_id = $request->positioN;
            $advisory->subcategoryId = $request->subcaT;
            $advisory->save();
            $count = sizeof($request->sectoR);
            for($i=0;$i<$count;$i++){

                $personnel = new Personnel_Sector;
                $personnel->advisory_council_id = $acID;
                $personnel->ac_sector_id = $request->sectoR[$i];
                $personnel->save();
            }
        }
    }

                $personnels = DB::table('PersonnelSector')
                            ->select('ID')
                            ->where('advisory_council_id','=', $acID)
                            ->where('ac_sector_id','=', $request->sectoR[$i])
                            ->get();

                if(count($personnels) == 0) {
                    $personnel = new PersonnelSector;
                    $personnel->advisory_council_id = $acID;
                    $personnel->ac_sector_id = $request->sectoR[$i];
                    $personnel->save();   
                }
                else{
                    foreach ($personnels as $current){
                        $personnel = PersonnelSector::find($current->ID);
                        $personnel->ac_sector_id = $request->sectoR[$i];
                        $personnel->save();
                    }
                }
            }//for loop set personnelsector
            $unselected = DB::table('PersonnelSector')
                            ->select('ID')
                            ->where('advisory_council_id','=', $acID)
                            ->get();
            $countps = sizeof($unselected);
            $newcount = $countps - $count;
            for($i=0;$i<$countps;$i++){
                DB::table('PersonnelSector')
                            ->where('advisory_council_id','=', $acID)
                            ->where('ac_sector_id','<>', $request->sectoR[$newcount-$i])
                            ->delete();
                            
            }//for loop delete unselected
        }//callID == 3
    }//acCRUD


    public function getsub(Request $req){

        $id = $req->id;
        $subcat = DB::table('AC_Subcategory')->select('ID','subcategoryname')->where('categoryId','=',$id)->get();

        return $subcat;
    }


    /* public function subcatOptions(Request $request) {
         $catID = $request->subcat;

         $params = array($catID);

         $stmt = DB::select('select * from "accategory" as b
             left join "acsubcategory" as c on b.id = c.id' , $params);

         $array_Result = array();

         return json_encode($array_Result);

     }//End Of Select Unit 1    */


 
}
