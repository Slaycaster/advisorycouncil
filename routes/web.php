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
    	//return view('transaction.login');


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

Route::get('home', 'SearchController@dashboard')->middleware('auth');
//Route::get('home', 'AdvDirectoryController@getRecent')->middleware('auth'); //admin


Route::get('maintenance', function () {
	if(Auth::user()->admintype == 1) {
		return redirect('home');
	}//if

    return redirect('maintenance/primaryoffice');
})->middleware('auth');

Route::get('directory', 'AdvDirectoryController@getList')->middleware('auth');

//MAINTENANCE @author: Shie Eugenio
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
Route::get('directory/edit', 'AdvDirectoryController@readyedit')->middleware('auth');
Route::get('directory/filter', 'AdvDirectoryController@filterList')->middleware('auth');

//DROPDOWN @author: Shie Eugenio
Route::post('dropdown/getsubcateg', 'AdvDirectoryController@getSubCateg');
Route::post('dropdown/getsecoffice', 'AdvDirectoryController@getSecOffice');
Route::post('dropdown/getteroffice', 'AdvDirectoryController@getTerOffice');
Route::post('dropdown/getquaroffice', 'AdvDirectoryController@getQuarOffice');
Route::get('dropdown/getinitacd', 'AdvDirectoryController@getInitACD');
Route::get('dropdown/getinittpd', 'AdvDirectoryController@getInitTPD');



//ADMIN @author: Shie Eugenio
Route::get('admin', 'RegistrationController@index')->middleware('auth');

//SMART SEARCH @author: Ren Buluran
Route::get('loadsuggestion', 'SearchController@index'); //predictive
Route::get('search', 'SearchController@AdvancedSearch');
Route::get('search/civilian/{sq}', 'SearchController@findAC'); //get ac
Route::get('search/police/{sq}', 'SearchController@findPA'); //get tp

//--------------------------------------------------------------------------------------------
//BACK-END

//MAINTENANCE

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

//--------------------------------------------------------------------------------------------

//MISC

//AUDIT TRAIL @autho: Ren Buluran
Route::get('AuditTrail', 'AuditTrailController@index');
Route::get('AuditTrailFilter', 'AuditTrailController@filter');

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

//RETRIEVE DATA
Route::post('getdata', 'AdvDirectoryController@readyModal');

//SEARCH
Route::get('home/search', function() {
	return view('search.search_result')->with('active', '#tab1');
});

Route::get('directory/search', function() {
	return view('search.search_result')->with('active', '#tab3');
});

/*Route::get('search', function() {
	return view('search.psearch_result');
});*/



///-------------------------------------------------------------------------------------------------------------------------------



//dashboard for offices[ren]
Route::get('Dashboard/primary', 'SearchController@getUnitOffice');
Route::get('Dashboard/secondary', 'SearchController@getSecondOffice');
Route::get('Dashboard/tertiary', 'SearchController@getTertiaryOffice');
Route::get('Dashboard/Quarternary', 'SearchController@getQuarternaryOffice');

//PDF LESTER hihi
Route::get('/welcome', 'PDFController@index');
Route::post('Advisory_Council', 'PDFController@Advisory_Council');
Route::post('load-pdf-data', 'PDFController@loaddata');


//ren routes for redirection of search
Route::post('home/search2', 'SearchController@view');


//dynamic graphs
Route::get('Dashboard/Linegraph/ACPosition', 'SearchController@getLineChartACPosition');
Route::get('user/edit', function() {
	return view('home.edituserpage');
});

Route::post('checknewusername', 'RegistrationController@checknewusername');
Route::post('checkoldpassword', 'RegistrationController@checkoldpassword');
Route::post('edituser', 'RegistrationController@edituser');
Route::post('adduser', 'RegistrationController@adduser');



//birthdays[ren]
Route::get('upcomings', 'SearchController@upcomings');
Route::get('birthdays', 'SearchController@birthdays');


