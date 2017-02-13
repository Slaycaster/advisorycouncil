<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


//FRONT-END

//MENU @author: Shie Eugenio
Route::get('/', 'AdvDirectoryController@readyPHome'); //public

//LOGIN @author: Shie Eugenio
Route::get('login', function () {
	if (Auth::check()) {
    	return redirect('home');

	} else {
    	return view('home.loginpage');

	}//if (Auth::check()) {

});

//REGISTRATION @author: Shie Eugenio
Route::get('registration', function () {

	if (Auth::check()) {
    	return redirect('home');

	} else {
   		return view('home.registrationpage');

	}//if (Auth::check()) {

});

//--------------------------------------------------------------------------------------------

Route::get('home', function() {
	return view('home.defaulthome');

})->middleware('auth'); //admin

Route::get('home', 'AdvDirectoryController@getRecent')->middleware('auth'); //admin


Route::get('maintenance', function () {
    return redirect('maintenance/accategory');
})->middleware('auth');

Route::get('directory', 'AdvDirectoryController@getList')->middleware('auth');

//MAINTENANCE @author: Shie Eugenio
Route::get('maintenance/accategory', 'ACCategoryController@index')->middleware('auth');
Route::get('maintenance/acsubcategory','ACSubcategoryController@index')->middleware('auth');
Route::get('maintenance/acposition','ACPositionController@index_acposition')->middleware('auth');
Route::get('maintenance/acsector','acsectorController@index_acsectors')->middleware('auth');
Route::get('maintenance/primaryoffice', 'PoliceOfficesController@index')->middleware('auth');
Route::get('maintenance/secondaryoffice', 'PoliceOfficeTwoController@index')->middleware('auth');
Route::get('maintenance/tertiaryoffice', 'PoliceOfficeThreeController@index_PO3')->middleware('auth');
Route::get('maintenance/quarternaryoffice', 'PoliceOfficeFourController@index')->middleware('auth');
Route::get('maintenance/policeposition','PolicePositionController@index_policeposition')->middleware('auth');
/**Route::get('maintenance/rank', function() {
	 return View('maintenancetable.rank_table');
})->middleware('auth');**/

//TRANSACTION @author: Shie Eugenio
Route::get('directory/add', 'AdvDirectoryController@readyadd')->middleware('auth');
Route::resource('modalView', 'AdvDirectoryController@getRecordData');

//DROPDOWN @author: Shie Eugenio
Route::post('dropdown/getsubcateg', 'AdvDirectoryController@getSubCateg');
Route::post('dropdown/getsecoffice', 'AdvDirectoryController@getSecOffice');
Route::post('dropdown/getteroffice', 'AdvDirectoryController@getTerOffice');
Route::post('dropdown/getquaroffice', 'AdvDirectoryController@getQuarOffice');
Route::get('dropdown/getinitacd', 'AdvDirectoryController@getInitACD');
Route::get('dropdown/getinittpd', 'AdvDirectoryController@getInitTPD');



//ADMIN @author: Shie Eugenio
Route::get('admin', 'RegistrationController@index')->middleware('auth');

//--------------------------------------------------------------------------------------------
//BACK-END

//LOGIN @author: Ren Buluran
Route::post('validatelogin', array('uses' => 'HomeController@login'));
Route::get('logout', array('uses' => 'HomeController@logout'));

//REGISTRATION @author: Ren Buluran
Route::resource('register', 'RegistrationController@register');
Route::post('checkusername', 'RegistrationController@checkusername');
Route::post('getuser', 'RegistrationController@getuser');
Route::post('approval', 'RegistrationController@setstatus');

//CAPTCHA RELOADER @author: Ren Buluran
Route::get('reloadImageCaptcha', 'RegistrationController@reloadCaptcha');

//AC CATEGORY @author: Shie Eugenio
Route::post("accategory/add", 'ACCategoryController@confirm');
Route::post('accategory/view','ACCategoryController@edit');
Route::post("accategory/edit", "ACCategoryController@update");

//AC SUBCATEGORY @author: Ren Buluran
Route::post('acsubcategory/add', 'ACSubcategoryController@confirm');
Route::post('acsubcategory/view','ACSubcategoryController@edit');
Route::post("acsubcategory/edit", "ACSubcategoryController@update");

//AC POSITION @author: Lester Acula
Route::post('maintenance/acpositioncrud','ACPositionController@acpositioncrud');

//AC SECTOR @author: Christine Amper
Route::post('maintenancetable/acsectorCRUD','acsectorController@acsectorCRUD');

//PRIMARY OFFICE @author: Joanne Dasig
Route::post('/buttonsPoliceOffice', 'PoliceOfficesController@add');
Route::post('maintenance/editpolice', 'PoliceOfficesController@edit');
Route::post('maintenance/editpoliceview', 'PoliceOfficesController@find');

//SECONDARY OFFICE @author: Joanne Dasig
Route::post('/confirmpolice', 'PoliceOfficeTwoController@add');
Route::post('maintenance/subpoliceview', 'PoliceOfficeTwoController@find');
Route::post('maintenance/editsubpolice', 'PoliceOfficeTwoController@edit');

//TERTIARY OFFICE @author: Christine Amper
Route::post('maintenancetable/PO3CRUD','PoliceOfficeThreeController@PO3CRUD');
Route::post('maintenance/selectOfficeSec','PoliceOfficeThreeController@selectOfficeSec');
Route::post('maintenance/selOffice','PoliceOfficeThreeController@selOffice');
Route::resource('maintenancetable/retrieveData','PoliceOfficeThreeController@retrieveData');

//QUATERNARY OFFICE OFFICE @author: Lester Acula
Route::post('maintenance/add', 'PoliceOfficeFourController@add');
Route::post('maintenance/policefourview', 'PoliceOfficeFourController@find');
Route::post('maintenance/editpolicefour', 'PoliceOfficeFourController@edit');
Route::post('maintenance/populate', 'PoliceOfficeFourController@populate');

//POLICE POSITION @author: Lester Acula
Route::post('maintenance/policepositioncrud','PolicePositionController@policepositioncrud');

//--------------------------------------------------------------------------------------------
//TRANSACTION

//ADD ADVISER @author: Shie Eugenio
Route::post('adviser/add', 'AdvDirectoryController@addadviser');
Route::post('adviser/edit', 'AdvDirectoryController@editadviser');















///-------------------------------------------------------------------------------------------------------------------------------
//advisory council transac Joanne
Route::get('advisorycouncil', 'AdvisoryCouncilController@index');
Route::post('transac/acCRUD', 'AdvisoryCouncilController@acCRUD');
Route::post('transac/getsub', 'AdvisoryCouncilController@getsub');

//Police Advisory transac Joanne
Route::get('policeadvisory', 'PoliceAdvisoryController@index');

Route::post('/addpolice', 'PoliceAdvisoryController@add');
Route::get('policeadv/{id}/edit', 'PoliceAdvisoryController@find');
Route::post('policeadv/{id}/editpolice', 'PoliceAdvisoryController@edit');

//profile [ren]
Route::get('transaction/adviser','ProfileController@index');
Route::post('transaction/addadvisers','ProfileController@store');
Route::get('transaction/advedt','ProfileController@edit');


//smart search [ren]
Route::get('search', 'SearchController@index');

/* admin type 1-Super Admin, 0-Regular Admin 
	approval 0 - default value , 1 - approved, 2-disapproved

*/

// Audit Trail Controller[ren]
Route::get('AuditTrail', 'AuditTrailController@index');
Route::get('AuditTrailFilter', 'AuditTrailController@filter');


Route::get('photoupload', function() {
	return view('photoupload');
});

Route::post('testupload', 'TestUpController@loadphoto');

/*
Filters for the directory. returning json values
[ren william lucas buluran]
*/
Route::get('FilterAC', 'FilterController@FilterAC');
Route::get('FilterAll', 'FilterController@FilterAll');
Route::get('FilterTWG', 'FilterController@FilterTWG');
Route::get('FilterPSMU', 'FilterController@FilterPSMU');


// relaoding captcha

