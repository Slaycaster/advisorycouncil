@extends('baseform')
	
@section('maincontent')
	<div class = "advcon">
		<div class = "formattp tablepane">
			<div class = "mtitle">
				Add Adviser
				<div id="myToast" class="toast-popup"></div>			
			</div>

			<div class = "tablecon">
				<form action = "javascript:loadCModal()" class = "ui form" id = "form">

					<input type="hidden" value="" name="advid"/>


					<div class = "fborder tablepane">
						<div class = "minvtitle mtitle">
							Profile			
						</div>

						<div class = "tablecon">

							<div class = "ui grid">
								<div class = "thirteen wide column">
									<h4 class="ui dividing header">Basic Information</h4>

									<div class = "field">
										<label>Name <span class="asterisk">*</span></label>

										<div class = "four fields">
											<div class = "ui input field">
												<input type="text" name = "lname" placeholder="Last Name">
												
											</div>

											<div class = "ui input field">
												<input type="text" name = "fname" placeholder="First Name">

											</div>

											<div class = "ui input field">
												<input type="text" name = "mname" placeholder="Middle Name">
												
											</div>

											<div class = "ui input field">
												<input type="text" name = "qname" placeholder="Qualifier">
												
											</div>
											
										</div>
										
									</div>
									<div class = "four fields">
										<div class = "field">
											<label>Birthdate <span class="asterisk">*</span></label>

											<div class = "ui input field">
												<input type="date" name = "bdate">
													
											</div>
										</div>

										<div class = "field">
											<label>Gender <span class="asterisk">*</span></label>
											<div class = "inline fields">
												<div class = "ui radio field">
													<input type="radio" checked name="gender" value="0"  tabindex="0" class="hidden">
													<label>Male</label>
														
												</div>
												<div class = "ui radio field">
													<input type="radio" name="gender" value="1"  tabindex="0" class="hidden">
													<label>Female</label>
													
														
												</div>
												
											</div>
										</div>			
									</div>

									<div class = "field">
 										<label>Home Address</label>
 
 										<div class = "four fields">
 											<div class = "ui input field">
 												<input type="text" name = "street" placeholder="Street Address">
 												
 											</div>
 
 											<div class = "ui input field">
 												<input type="text" name = "barangay" placeholder="Barangay">
 
 											</div>
 
 											<div class = "ui input field">
 												<input type="text" name = "city" placeholder="City">
 												
 											</div>
 
 											<div class = "ui input field">
 												<input type="text" name = "province" placeholder="Province">
 												
 											</div>
 
 
 											
 										</div>
 										
 									</div>
								

									<h4 class="ui dividing header">Contact Information</h4>

									<div class = "four fields">

										<div class = "field">
											<label>Mobile Number <span class="asterisk">*</span></label>

										
											<div class = "ui input field">
												<input type="text" name = "mobile" placeholder="+639*********">
												
											</div>

										</div>

										<div class = "field">
											<label>Landline </label>

										
											<div class = "ui input field">
												<input type="text" name = "landline" placeholder="e.g. 4479049">
												
											</div>

										</div>
										
									</div>

									<div class = "four fields">
										<div class = "field">
											<label>Email Address <span class="asterisk">*</span></label>

											<div class = "ui input field">
												<input type="email" name = "email" placeholder="e.g. sample@yahoo.com">
												
											</div>
										</div>

										<div class = "field">
											<label>Facebook </label>
											<div class = "ui input field">
												<input type="text" name = "facebook" placeholder="e.g. sampleusername">
												
											</div>
										</div>

										<div class = "field">
											<label>Twitter </label>
											<div class = "ui input field">
												<input type="text" name = "twitter" placeholder="e.g. sampleusername">
												
											</div>
										</div>

										<div class = "field">
											<label>Instagram </label>
											<div class = "ui input field">
												<input type="text" name = "instagram" placeholder="e.g. sampleusername">
												
											</div>
										</div>		
									</div>
									

								</div>
								<div class = "three wide column">
									<div class = "fborder piccon">
										<div class = "ui medium image">
											<img class = "profpic" id = "profpic"  src="{{URL::asset('objects/Logo/InitProfile.png')}}">
										</div>

										<div class = "ui input sixteen wide field">
											<input type = "file" onchange = "previewphoto()" accept="image/*" name = "upphoto"/>
											
										</div>

									</div>

									<span class ="message" id="message">{{session('message')}}</span>


								</div>
								
							</div>

							<br>
						</div>

						<div class = "fbtop minvtitle mtitle">
							Advisory Council <!-- SUBJECT FOR CHANGE-->	
						</div>

						<div class = "tablecon">
							<div class = "field">
								<div class = "field">
									<label>Adviser Category <span class="asterisk">*</span></label>
									<div class = "inline fields">
										<div class = "ui radio field">
											<input type="radio" checked onchange = "changeform(this.value)" name="advcateg" value="0"  tabindex="0" class="hidden">
											<label>AC</label>
												
										</div>
										<div class = "ui radio field">
											<input type="radio" onchange = "changeform(this.value)" name="advcateg" value="1"  tabindex="0" class="hidden">
											<label>TWG</label>
											
												
										</div>

										<div class = "ui radio field">
											<input type="radio" onchange = "changeform(this.value)" name="advcateg" value="2"  tabindex="0" class="hidden">
											<label>PSMU</label>
											
												
										</div>
										
									</div>
								</div> <br>

								<div class = "field">
									<label>Duration </label>
									
								</div>

								<div class = "five fields">

									<div class = "field">
										<label>Start Date <span class="asterisk">*</span></label>


										<div class = "ui input field">
											<input type="date" name = "durationsdate">
												
										</div>
									</div>

									<div class = "field" id = "enddate" style="display:none">
										<label>End Date </label>

										<div class = "ui input field">
											<input type="date" name = "durationedate">
												
										</div>
									</div>	

								</div>

								<div id = "tempfields">
									
		
								</div>

								<br>

								
							</div>
									
						</div>

						<div id = "trainingcon" style="display:none">
							<div class = "fbtop minvtitle mtitle">
								Training							
							</div>

							<div class = "tablecon">
								<table class = "ui celled padding table" id = "traintable">
									<thead>
										<tr>
											<th><center>Title</center></th>
											<th><center>Training Category</center></th>
											<th><center>Location</center></th>
											<th><center>Start</center></th>
											<th><center>End</center></th>
											<th><center>Speaker(s)</center></th>
											<th><center>Organizer</center></th>
										</tr>
									</thead>

									<tbody>
										
									</tbody>

									<tfoot>
										<tr class = "addtr" onclick = "addrow()"><td colspan = "7"><center><i class = "add circle icon"></i> ADD </center></td></tr>
									</tfoot>
									
								</table>

							</div>
						</div>

						<br>
								
					</div>

					<br>

					<center>

						<button type = "submit" name="submit" 
								class="ui large button submit savebtnstyle">

							Save
						</button>
						<button type="button" onclick = "$('#cancelmodal').modal('show');" 
								class="ui large button">
							Cancel

						</button>
					</center>
				</form>


				
			</div>
							
		</div>
		
	</div>

	<script type="text/javascript" src="{{ URL::asset('js/formcontrol.js') }}"></script>

	<script type="text/javascript">
		$('#tab3').attr('class', 'mlink item active');
		var lecturers;
		var link;

		if('{{$action}}' === '0') {
			addT1Elements();
			getInitialACDropdown();
			link = "{{url('adviser/add')}}";

		} else if('{{$action}}' === '1') {

			document.getElementById('enddate').style.display = "block";
			link = "{{url('adviser/edit')}}";

			@if(isset($type))

				fillProfile()
				if('{{$type}}' === '0') {
					addT1Elements();
					getInitialACDropdown();
					fillAC();

				} else {
					addT2Elements();
					getInitialTPDropdown();
					controlelements("block");
					fillTP();

				}//if

			@endif





		}//if('{{$action}}' == '0') {

		function changeform(selcat) {
			if(selcat == 0) {
				removeElements();
				addT1Elements();
				getInitialACDropdown();

				controlelements("none");

				@if($action == 1 && isset($type))

					fillAC();

				@endif


			} else {
				lecturers = new Array();
				removeElements();
				addT2Elements();
				getInitialTPDropdown();


				rowcount = 0;
				controlelements("block");
				

				for (var ctr = rowcount ; ctr < 3 ; ctr++) {
					//rowcount = ctr;
					addrow();

				};

			}//if(selcat == 0) {

		}//function changeform() {

		function controlelements(displayvalue) {
			$("#traintable tbody").empty();
			document.getElementById('trainingcon').style.display = displayvalue;
				
		}//function controlelements() {

		@if(isset($type) && isset($recorddata))

			function fillProfile() {
				
				$("input[name='advcateg'][value='{{$type}}']").prop('checked', true);
				document.getElementsByName('advid')[0].value = "{{$type}}-{{$id}}";
				document.getElementsByName('lname')[0].value = "{{$recorddata[0][0]->lname}}";
				document.getElementsByName('fname')[0].value = "{{$recorddata[0][0]->fname}}";
				document.getElementsByName('mname')[0].value = "{{$recorddata[0][0]->mname}}";
				document.getElementsByName('qname')[0].value = "{{$recorddata[0][0]->qualifier}}";
				document.getElementsByName('bdate')[0].value = "{{date('Y-m-d', strtotime($recorddata[0][0]->birthdate))}}";
				$("input[name='gender'][value='{{$recorddata[0][0]->gender}}']").prop('checked', true);
				document.getElementsByName('mobile')[0].value = "{{$recorddata[0][0]->contactno}}";
				document.getElementsByName('landline')[0].value = "{{$recorddata[0][0]->landline}}";
				document.getElementsByName('email')[0].value = "{{$recorddata[0][0]->email}}";
				document.getElementsByName('facebook')[0].value = "{{$recorddata[0][0]->fbuser}}";
				document.getElementsByName('twitter')[0].value = "{{$recorddata[0][0]->twitteruser}}";
				document.getElementsByName('instagram')[0].value = "{{$recorddata[0][0]->iguser}}";
				document.getElementsByName('durationsdate')[0].value = "{{date('Y-m-d', strtotime($recorddata[0][0]->startdate))}}";

				if("{{$recorddata[0][0]->enddate}}" !== "") {
					document.getElementsByName('durationedate')[0].value = "{{date('Y-m-d', strtotime($recorddata[0][0]->enddate))}}";
				}//if



			}//function fillProfile() {

			function fillAC() {
				//NOT WORKING
				$("select[name='acposition'] option[value='{{$recorddata[0][0]->advisory_position_id}}']").prop('selected', true);
				$("#accateg").dropdown("set exactly", "{{$recorddata[0][0]->categoryId}}"); 
				getsubcateg();

				$("#acsubcateg").dropdown("set exactly", "{{$recorddata[0][0]->subcategoryId}}"); 

				@foreach($recorddata[1] as $sect)
					$("#acsector").val(["{{$sect->ac_sector_id}}"]);
				@endforeach

				//---------

				document.getElementsByName('officename')[0].value = "{{$recorddata[0][0]->officename}}";
				document.getElementsByName('officeadd')[0].value = "{{$recorddata[0][0]->officeaddress}}";
				

				

			}//function fillAC() {

			function fillTP() {
				document.getElementsByName('authorder')[0].value = '{{$recorddata[0][0]->authorityorder}}';
				$("select[name='position']").dropdown('set selected', '{{$recorddata[0][0]->authorityorder}}')

				
			}//function fillTP() {

		@endif

		function showfield() {

			var categsel = document.getElementsByName('traincateg');

			for(var find = 0 ; find < categsel.length ; find++) {
				if(categsel[find].value == 7) {
					document.getElementsByName('othercon')[find].style.display = "block";

				} else {
					document.getElementsByName('othercon')[find].style.display = "none";

				}//if

			};

		}//function showfield(value) {

		function addarritem(index) {
			var text = document.getElementsByName('inputlecturer')[index].value;
			var pattern = new RegExp("^(?=.*(\d|\w))[A-Za-z0-9 .,'-]{3,}$");
			var flag = 0;

			//if(pattern.test(text) == true) {
				for (var count = 0 ; count < lecturers.length ; count++) {
					if(text === lecturers[count][0] && index == lecturers[count][1]) {
						flag = 1;
						break;
					}//if
				};//for

				if(flag == 0) {
					additem(text, index);
					lecturers.push(new Array(text, index));


				}//if(flag == 0) {]
				//alert(lecturers);
			//}//pattern

			console.log(lecturers);

		}//add item to array

		function deletearritem(index, rowindex) {
			var ulist = document.getElementsByName('lecturer')[rowindex];
			var text = ulist.getElementsByTagName('li')[index].firstChild.innerHTML;

			deleteitem(index, rowindex, ulist);

			for (var count = 0 ; count < lecturers.length ; count++) {
				if(text === lecturers[count][0] && rowindex == lecturers[count][1]) {
					lecturers.splice(count, 1);
					break;
				}//if
					
			};//for

			//console.log(lecturers);


		}//delete from array


		function controlaction() {
			var slctdtype = $("input[name='advcateg']:checked").val();
			var traintitle = new Array();
			var traincateg = new Array();
			var location = new Array();
			var sdate = new Array();
			var edate = new Array();
			var stime = new Array();
			var etime = new Array();
			var speaker = new Array();
			var org = new Array();
			var photo = "";
			var upphoto = document.getElementsByName('upphoto')[0].files;
			var blob = new Blob();
			var blobreader = new FileReader();

			if(upphoto.length == 1) {
				blob = new Blob(document.getElementsByName('upphoto')[0].files, 
								{type: document.getElementsByName('upphoto')[0].files[0]['type']});

			}//upphoto

			var blobsize = blob.size;

			

			blobreader.onload = function(event){

				if(blobsize == 0) {
					photo = "";
				} else {
					photo = event.target.result;
				}//if

				if (slctdtype == 0) {
					var data = {
						'ID' : document.getElementsByName('advid')[0].value,
						'lname' : document.getElementsByName('lname')[0].value,
						'fname' : document.getElementsByName('fname')[0].value,
						'mname' : document.getElementsByName('mname')[0].value,
						'qname' : document.getElementsByName('qname')[0].value,
						'bdate' : document.getElementsByName('bdate')[0].value,
						'street' : document.getElementsByName('street')[0].value,
						'barangay' : document.getElementsByName('barangay')[0].value,
						'city' : document.getElementsByName('city')[0].value,
						'province' : document.getElementsByName('province')[0].value,
						'gender' : $("input[name='gender']:checked").val(),
						'mobile' : document.getElementsByName('mobile')[0].value,
						'landline' : document.getElementsByName('landline')[0].value,
						'email' : document.getElementsByName('email')[0].value,
						'facebook' : document.getElementsByName('facebook')[0].value,
						'twitter' : document.getElementsByName('twitter')[0].value,
						'instagram' : document.getElementsByName('instagram')[0].value,
						'advcateg' : slctdtype,
						'durstart' : document.getElementsByName('durationsdate')[0].value,
						'acposition' : document.getElementsByName('acposition')[0].value,
						'officename' : document.getElementsByName('officename')[0].value,
						'officeadd' : document.getElementsByName('officeadd')[0].value,
						'acsubcateg' : document.getElementsByName('acsubcateg')[0].value,
						'acsector' : $("select[name='acsector']").val(),
						'upphoto' : photo,
						'submit' : 'save',
						'_token' : '{{ Session::token() }}'
					};
					
				} else if(slctdtype == 1 || slctdtype == 2) {
					//TRAINING
					for(var count = 0 ; count < rowcount ; count++) {
						var initspk = new Array();

						if(document.getElementsByName('traintitle')[count].value !== "") {
							traintitle.push(document.getElementsByName('traintitle')[count].value);

							if(document.getElementsByName('traincateg')[count].value == 7) {
								traincateg.push(document.getElementsByName('othercat')[count].value);

							} else {
								traincateg.push(document.getElementsByName('traincateg')[count].value);

							}//if

							location.push(document.getElementsByName('location')[count].value);
							sdate.push(document.getElementsByName('trainsdate')[count].value);
							edate.push(document.getElementsByName('trainedate')[count].value);
							stime.push(document.getElementsByName('trainstime')[count].value);
							etime.push(document.getElementsByName('trainetime')[count].value);
							
							for(var ctrspk = 0 ; ctrspk < lecturers.length ; ctrspk++) {
								if(lecturers[ctrspk][1] == count) {
									initspk.push(lecturers[ctrspk][0]);
								}//if
							}//for

							speaker.push(initspk);

							org.push(document.getElementsByName('trainorg')[count].value);

						}//if
					}
					
					var data = {
						'ID' : document.getElementsByName('advid')[0].value,
						'lname' : document.getElementsByName('lname')[0].value,
						'fname' : document.getElementsByName('fname')[0].value,
						'mname' : document.getElementsByName('mname')[0].value,
						'qname' : document.getElementsByName('qname')[0].value,
						'bdate' : document.getElementsByName('bdate')[0].value,
						'gender' : $("input[name='gender']:checked").val(),
						'street' : document.getElementsByName('street')[0].value,
						'barangay' : document.getElementsByName('barangay')[0].value,
						'city' : document.getElementsByName('city')[0].value,
						'province' : document.getElementsByName('province')[0].value,
						'mobile' : document.getElementsByName('mobile')[0].value,
						'landline' : document.getElementsByName('landline')[0].value,
						'email' : document.getElementsByName('email')[0].value,
						'facebook' : document.getElementsByName('facebook')[0].value,
						'twitter' : document.getElementsByName('twitter')[0].value,
						'instagram' : document.getElementsByName('instagram')[0].value,
						'advcateg' : slctdtype,
						'durstart' : document.getElementsByName('durationsdate')[0].value,
						'authorder' : document.getElementsByName('authorder')[0].value,
						'pnppost' : document.getElementsByName('position')[0].value,
						'rank' : document.getElementsByName('rank')[0].value,
						'primary' : document.getElementsByName('primary')[0].value,
						'secondary' : document.getElementsByName('secondary')[0].value,
						'tertiary' : document.getElementsByName('tertiary')[0].value,
						'quaternary' : document.getElementsByName('quaternary')[0].value,
						'upphoto' : photo,
						'traintitle' : traintitle,
						'traincateg' : traincateg,
						'location' : location,
						'sdate' : sdate,
						'stime' : stime,
						'etime' : etime,
						'edate' : edate,
						'speaker' : speaker,
						'org' : org,
						'submit' : 'save',
						'_token' : '{{ Session::token() }}'
					};


				}//if (slctdtype == 0) {
				
				$.ajax({
					type: "POST",
					url: link,
					data: data,
				   	success : function() {

				   		loadtoast("Saved");
				   	
				   	}//success : function() {
				});

				setTimeout(function(){
					window.location = "{{URL('directory')}}";
				}, 2600);

					
       			
    		};     
   
   			blobreader.readAsDataURL(blob);
				
			
		}//function controlaction() {
		
		function loadtoast(msg) {

			$("#myToast").showToast({
				message: msg,
				timeout: 2500
			});

		}//function resetflag() {


		//DROPDOWN

		function getInitialACDropdown() {
			$.ajax({
				type: "GET",
				url: "{{url('dropdown/getinitacd')}}",
				dataType: 'json',
			   	success : function(data) {

			   		$("select[name='acposition'] option").not("[value='disitem']").remove();
			   		$("select[name='accateg'] option").not("[value='disitem']").remove();
			   		$("select[name='acsector'] option").not("[value='disitem']").remove();

			   		for (var ctr = 0 ; ctr < data[0].length ; ctr++) {
			   			populatedropdown(data[0][ctr]['ID'], 'acposition', data[0][ctr]['acpositionname']);
			   			
			   		};

			   		for (var ctr = 0 ; ctr < data[1].length ; ctr++) {
			   			populatedropdown(data[1][ctr]['ID'], 'accateg', data[1][ctr]['categoryname']);
			   			
			   		};

			   		for (var ctr = 0 ; ctr < data[2].length ; ctr++) {
			   			populatedropdown(data[2][ctr]['ID'], 'acsector', data[2][ctr]['sectorname']);
			   			
			   		};

			   	}//success : function() {
			});
		}//function getInitialACDropdown() {

		function getInitialTPDropdown() {
			$.ajax({
				type: "GET",
				url: "{{url('dropdown/getinittpd')}}",
				dataType: 'json',
			   	success : function(data) {

			   		$("select[name='position'] option").not("[value='disitem']").remove();
			   		$("select[name='rank'] option").not("[value='disitem']").remove();
			   		$("select[name='primary'] option").not("[value='disitem']").remove();

			   		for (var ctr = 0 ; ctr < data[0].length ; ctr++) {
			   			populatedropdown(data[0][ctr]['id'], 'position', data[0][ctr]['PositionName']);
			   			
			   		};

			   		for (var ctr = 0 ; ctr < data[1].length ; ctr++) {
			   			populatedropdown(data[1][ctr]['id'], 'rank', data[1][ctr]['RankName']);
			   			
			   		};

			   		for (var ctr = 0 ; ctr < data[2].length ; ctr++) {
			   			populatedropdown(data[2][ctr]['id'], 'primary', data[2][ctr]['UnitOfficeName']);
			   			
			   		};
			   	}//success : function() {
			});
		}//function getInitialTPDropdown() {

		function getsubcateg() {
			var data = {
				'categID' : document.getElementsByName('accateg')[0].value,
				'_token' : '{{ Session::token() }}'

			};

			$.ajax({
				type: "POST",
				url: "{{url('dropdown/getsubcateg')}}",
				data: data,
				dataType: 'json',
			   	success : function(subcategory) {

			   		$("select[name='acsubcateg'] option").not("[value='disitem']").remove();

			   		for (var ctr = 0 ; ctr < subcategory.length ; ctr++) {
			   			populatedropdown(subcategory[ctr]['ID'], 'acsubcateg', subcategory[ctr]['subcategoryname']);
			   			
			   		};

			   		
			   	}//success : function() {
			});


		}//function getsubcateg() {

		function getsecoffice() {
			var data = {
				'poID' : document.getElementsByName('primary')[0].value,
				'_token' : '{{ Session::token() }}'

			};

			$.ajax({
				type: "POST",
				url: "{{url('dropdown/getsecoffice')}}",
				data: data,
				dataType: 'json',
			   	success : function(secoffice) {

			   		$("select[name='secondary'] option").not("[value='disitem']").remove();

			   		for (var ctr = 0 ; ctr < secoffice.length ; ctr++) {
			   			populatedropdown(secoffice[ctr]['id'], 'secondary', secoffice[ctr]['UnitOfficeSecondaryName']);
			   			
			   		};


			   		
			   	}//success : function() {
			});

		}//function getsecoffice() {

		function getteroffice() {
			var data = {
				'soID' : document.getElementsByName('secondary')[0].value,
				'_token' : '{{ Session::token() }}'

			};

			$.ajax({
				type: "POST",
				url: "{{url('dropdown/getteroffice')}}",
				data: data,
				dataType: 'json',
			   	success : function(teroffice) {

			   		$("select[name='tertiary'] option").not("[value='disitem']").remove();

			   		for (var ctr = 0 ; ctr < teroffice.length ; ctr++) {
			   			populatedropdown(teroffice[ctr]['id'], 'tertiary', teroffice[ctr]['UnitOfficeTertiaryName']);
			   			
			   		};

			   		
			   	}//success : function() {
			});
		}//function getteroffice() {

		function getquaroffice() {
			var data = {
				'toID' : document.getElementsByName('tertiary')[0].value,
				'_token' : '{{ Session::token() }}'

			};

			$.ajax({
				type: "POST",
				url: "{{url('dropdown/getquaroffice')}}",
				data: data,
				dataType: 'json',
			   	success : function(quaroffice) {

			   		$("select[name='quaternary'] option").not("[value='disitem']").remove();

			   		for (var ctr = 0 ; ctr < quaroffice.length ; ctr++) {
			   			populatedropdown(quaroffice[ctr]['id'], 'quaternary', quaroffice[ctr]['UnitOfficeQuaternaryName']);
			   			
			   		};

			   		
			   	}//success : function() {
			});
		}//function getteroffice() {






		//PHOTO

		function validatefiletype(photo) {
			var upext = photo['type'];
			var upsize = photo['size'];
			var maxsize = 1048576;
			var message = "false";
			var error;
			var validext = ['image/pjpeg', 'image/jpeg', 'image/jpg', 'image/JPEG', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/GIF', 'image/gif'];
				
				
			for (var ctr = 0 ; ctr < validext.length ; ctr++) {
				if(upext == validext[ctr]) {
					message = "true";
					break;
				}//if(data['type'] == validext[ctr]) {
			};


			if(message === "true" && upsize <= maxsize) {
				return message;
			} else if(message === "true" && upsize > maxsize) {
				return "IMAGE TOO LARGE";

			} else {
				return "INVALID FILE TYPE";

			}//if

		}//function validatefiletype() {

		function previewphoto() {

			var upphoto = document.getElementsByName('upphoto')[0].files;
			var result;

			if (upphoto.length == 1) {
				result = validatefiletype(upphoto[0]);

				if( result === "true") {
					var reader = new FileReader();

			        reader.onload = function (e) {
		            document.getElementById('profpic').src = e.target.result;

		        }//reader.onload
	
	        	reader.readAsDataURL(upphoto[0]);
	        	document.getElementById('message').innerHTML = "";

			    } else {
			    	document.getElementById('message').innerHTML = result;
			    }//if
			}//if

		}//previewphoto

	</script>




@include('module.adviser_modal')

@stop