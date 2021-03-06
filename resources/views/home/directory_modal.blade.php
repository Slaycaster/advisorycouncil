	<div class = "modal">
		<div id = "viewadv" class = "ui modal">
	        <div class = "header mtitle">

	        	<h3 class = "h3name" name = "name"></h3>
	        	<button class = "ui icon editbtn button tiny" name="editbtn" title = "Edit AC Member Record">
					<i class="edit icon topmargin"></i>
							
				</button>
				
	        </div>

	        <div class = "modalcontent">
		        <div class="ui top attached tabular menu rightrow">
					<div class="item" id = "tab1" data-tab="basicinfo">
						Profile
					</div>
					<div class="item" id = "tab2"  data-tab="work">
					    Stakeholder Information
					</div>
					<div class="item hidden" id = "tab3" name="traintab3" data-tab = "train">
					    Training
					</div>
				</div>

		        <div class = "tabbody ui bottom attached">
		        	<div class="ui tab active" data-tab="basicinfo">
		        		<div class = "ui grid">
		        			<div class = "thirteen wide column">
		        				<fieldset>
		        					<legend>Basic Information</legend>

			        				<div class = "ui grid row">
			        					<div class ="three wide column fbc labelpane">

											<div class = "twelve wide column bspacing">
												<label class = "formlabel">Birthdate</label>
														
											</div>

											<div class = "twelve wide column bspacing">
												<label class = "formlabel">Gender</label>
														
											</div>

											<div class = "twelve wide column bspacing">
												<label class = "formlabel">Home Address</label>
														
											</div>
															
										</div>

										<div class ="eleven wide column fieldpane">

											<div class = "twelve wide column bspacing9">
												<p name="bdatemod"><i name="bdayicon" class = "ui icon" title=""></i></p>
												
											</div>

											<div class = "twelve wide column bspacing9">
												<p name ="gendermod"></p>
														
											</div>

											<div class = "twelve wide column bspacing9">
												<p name = "homeaddressmod"></p>
														
											</div>
															
										</div>
										

			        				</div>

		        				</fieldset>

		        				<br>

		        				<fieldset>
		        					<legend>Contact Information</legend>
		        					
			        				<div class = "ui grid row">
			        					<div class ="three wide column fbc labelpane">

											<div class = "twelve wide column bspacing">
												<label class = "formlabel">Mobile No.</label>
														
											</div>

											<div class = "twelve wide column bspacing">
												<label class = "formlabel">Landline</label>
														
											</div>

											<div class = "twelve wide column bspacing">
												<label class = "formlabel">Email Address</label>
														
											</div>

											<div class = "twelve wide column bspacing">
												<label class = "formlabel">Facebook</label>
														
											</div>

											<div class = "twelve wide column bspacing">
												<label class = "formlabel">Twitter</label>
														
											</div>

											<div class = "twelve wide column bspacing">
												<label class = "formlabel">Instagram</label>
														
											</div>
															
										</div>

										<div class ="eleven wide column fieldpane">

											<div class = "twelve wide column bspacing9">
												<p name="contactnomod"></p>
														
											</div>

											<div class = "twelve wide column bspacing9">
												<p name="landlinemod"></p>
														
											</div>

											<div class = "twelve wide column bspacing9">
												<p name="emailmod"></p>
														
											</div>

											<div class = "twelve wide column bspacing9">
												<p name="fbmod"></p>
														
											</div>

											<div class = "twelve wide column bspacing9">
												<p name="twittermod"></p>
														
											</div>

											<div class = "twelve wide column bspacing9">
												<p name = "igmod"></p>
														
											</div>
															
										</div>
										

			        				</div>

		        				</fieldset>
			        			
		        			
		        			</div>
		        			<div class  = "three wide column">
		        				<div class = "ui small image">
									<img name="photo" class = "objfit" src="">
								</div>
		        				
		        			</div>
		        			
		        		</div>		        		

					</div>
					<div class="ui tab" data-tab="work">
						<div name = "acview" style = "display:none" >
							<div class = "ui grid row">
				        		<div class ="three wide column fbc labelpane">

				        			<!--<div class = "twelve wide column bspacing">
										<label class = "formlabel">Stakeholder Category</label>
													
									</div>-->

									<div class = "twelve wide column bspacing">
										<label class = "formlabel">Duration</label>
													
									</div>

									<div class = "twelve wide column bspacing">
										<label class = "formlabel">AC Position</label>
													
									</div>

									<div class = "twelve wide column bspacing">
										<label class = "formlabel">Office Name</label>
													
									</div>

									<div class = "twelve wide column bspacing">
										<label class = "formlabel">Office Address</label>
															
									</div>

									<div class = "twelve wide column bspacing">
										<label class = "formlabel">Designation</label>
															
									</div>

									<div class = "twelve wide column bspacing">
										<label class = "formlabel">AC Sector</label>
															
									</div>

									
																
								</div>

								<div class ="eleven wide column fieldpane">

									<!--<div class = "twelve wide column bspacing11">
										<p name="acadvcateg"></p>
														
									</div>-->

									<div class = "twelve wide column bspacing11">
										<p name="acduration"></p>
														
									</div>

									<div class = "twelve wide column bspacing11">
										<p name="acposition"></p>
														
									</div>

									<div class = "twelve wide column bspacing11">
										<p name="acofficename"></p>
															
									</div>

									<div class = "twelve wide column bspacing11">
										<p name="acofficeaddress"></p>
															
									</div>


									<div class = "twelve wide column bspacing11">
										<p name="acunitoffice"></p>
															
									</div>

									<div class = "twelve wide column bspacing11">
										<p name="acsector"></p>
															
									</div>

																
								</div>
											

				        	</div>
			        	</div>

			        	<div name = "tpview" style = "display:none" >
			        		<div class = "ui grid row">
				        		<div class ="three wide column fbc labelpane">

				        			<!--<div class = "twelve wide column bspacing">
										<label class = "formlabel">Stakeholder Category</label>
													
									</div>-->

									<div class = "twelve wide column bspacing">
										<label class = "formlabel">Duration</label>
													
									</div>

									<div class = "twelve wide column bspacing">
										<label class = "formlabel">Authority Order</label>
													
									</div>

									<div class = "twelve wide column bspacing">
										<label class = "formlabel">Position</label>
													
									</div>


									<div class = "twelve wide column bspacing">
										<label class = "formlabel">Designation</label>
													
									</div>
																
								</div>

								<div class ="eleven wide column fieldpane">

									<!--<div class = "twelve wide column bspacing11">
										<p name="tpadvcateg"></p>
														
									</div>-->

									<div class = "twelve wide column bspacing11">
										<p name="tpduration"></p>
														
									</div>

									<div class = "twelve wide column bspacing11">
										<p name="tpauthorder"></p>

									</div>

									<div class = "twelve wide column bspacing11">
										<p name="tpposition"></p>
														
									</div>


									<div class = "twelve wide column bspacing11">
										<p name="tpoffice"></p>
															
									</div>
																
								</div>
											

				        	</div>
			        	</div>

		        			

					</div>


					<div class="ui tab" data-tab="train">
						<div id = "trainingview" style="display:none" >
						<table id="trainviewtable" class = "viewtable ui celled padding table">
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
							
						</table></div>

					</div>
		        	
		        </div>
	        	
	        </div>
	      
	    </div>
		
	</div>

	<script type="text/javascript" src="{{ URL::asset('js/formcontrol.js') }}"></script>
	<script type="text/javascript">

		function showacview() {
			document.getElementsByName('acview')[0].style.display = "block";
			document.getElementsByName('tpview')[0].style.display = "none";
			document.getElementsByName('traintab3')[0].setAttribute('class', 'item hidden');
			document.getElementById('trainingview').style.display = "none";
		}//function showacview() {

		function showtpview() {
			document.getElementsByName('acview')[0].style.display = "none";
			document.getElementsByName('tpview')[0].style.display = "block";
			document.getElementsByName('traintab3')[0].setAttribute('class', 'item shown');
			document.getElementById('trainingview').style.display = "block";
		}//function showacview() {

		function fillprofile(recorddata) {
			document.getElementsByName('photo')[0].src = recorddata[1][0];

			document.getElementsByName('name')[0].innerHTML = recorddata[0][0]['fname'] + " " + 
															recorddata[0][0]['mname'] + " " + 
															recorddata[0][0]['lname'] + " " +
															recorddata[0][0]['qualifier'];
			if(recorddata[0][0]["birthdate"] != null) {
				document.getElementsByName('bdatemod')[0].innerHTML = recorddata[1][1];

				if(recorddata[0][0]["daysleft"] > 7 && recorddata[0][0]["daysleft"] <= 14) {
					document.getElementsByName('bdayicon')[0].addClass('green');
					document.getElementsByName('bdayicon')[0].removeClass('red');
					document.getElementsByName('bdayicon')[0].addClass('announcement');
					document.getElementsByName('bdayicon')[0].removeClass('birthday');
					document.getElementsByName('bdayicon')[0].setAttribute('title', 'Two (2) weeks before birthday');


				} else if(recorddata[0][0]["daysleft"] <= 7 && recorddata[0][0]["daysleft"] > 0) {
					document.getElementsByName('bdayicon')[0].addClass('green');
					document.getElementsByName('bdayicon')[0].removeClass('red');
					document.getElementsByName('bdayicon')[0].addClass('announcement');
					document.getElementsByName('bdayicon')[0].removeClass('birthday');
					document.getElementsByName('bdayicon')[0].setAttribute('title', recorddata[0][0]["daysleft"] + ' day(s) before birthday');

				} else if(recorddata[0][0]["daysleft"] == 0) {
					document.getElementsByName('bdayicon')[0].addClass('red');
					document.getElementsByName('bdayicon')[0].removeClass('green');
					document.getElementsByName('bdayicon')[0].addClass('birthday');
					document.getElementsByName('bdayicon')[0].removeClass('announcement');
					document.getElementsByName('bdayicon')[0].setAttribute('title', 'Happy Birthday');

				}//if

				
			} else {
				document.getElementsByName('bdatemod')[0].innerHTML = "N/A";

			}//if

			if(recorddata[0][0]["street"] !== "") {
				document.getElementsByName('homeaddressmod')[0].innerHTML = recorddata[0][0]['street'] + " " +
																	  recorddata[0][0]['barangay'] + " " +
																	  recorddata[0][0]['city'] + " " +
																	  recorddata[0][0]['province'];
			} else {
				document.getElementsByName('homeaddressmod')[0].innerHTML = "N/A";
			
			}//if

			var gender = "";

			if(recorddata[0][0]['gender'] == 0) {
				gender = "Male";

			} else {
				gender = "Female";

		   	}//if

		   	document.getElementsByName('gendermod')[0].innerHTML = gender;
		
		   	if(recorddata[0][0]['contactno'] !== "") {
		   		document.getElementsByName('contactnomod')[0].innerHTML = recorddata[0][0]['contactno'];

		   	} else {
		   		document.getElementsByName('contactnomod')[0].innerHTML = "N/A";	

		   	}//if

		   	if(recorddata[0][0]['landline'] !== "") {
		   		document.getElementsByName('landlinemod')[0].innerHTML = recorddata[0][0]['landline'];

		   	} else {
		   		document.getElementsByName('landlinemod')[0].innerHTML = "N/A";	

		   	}//if

		   	if(recorddata[0][0]['email'] !== "") {
		   		document.getElementsByName('emailmod')[0].innerHTML = recorddata[0][0]['email'];

		   	} else {
		   		document.getElementsByName('emailmod')[0].innerHTML = "N/A";	

		   	}//if

		   	if(recorddata[0][0]['fbuser'] !== "") {
		   		document.getElementsByName('fbmod')[0].innerHTML = recorddata[0][0]['fbuser'];

		   	} else {
		   		document.getElementsByName('fbmod')[0].innerHTML = "N/A";	

		   	}//if

		   	if(recorddata[0][0]['twitteruser'] !== "") {
		   		document.getElementsByName('twittermod')[0].innerHTML = recorddata[0][0]['twitteruser'];

		   	} else {
		   		document.getElementsByName('twittermod')[0].innerHTML = "N/A";	

		   	}//if

		   	if(recorddata[0][0]['iguser'] !== "") {
		   		document.getElementsByName('igmod')[0].innerHTML = recorddata[0][0]['iguser'];

		   	} else {
		   		document.getElementsByName('igmod')[0].innerHTML = "N/A";	

		   	}//if
		}//fillprofile

		function fillacdata(recorddata) {
			//document.getElementsByName('acadvcateg')[0].innerHTML = "Advisory Council (AC)";
			if(recorddata[0][0]['startdate'] != null) {
				document.getElementsByName('acduration')[0].innerHTML = recorddata[1][2] + " - " + recorddata[1][3];

			} else {
				document.getElementsByName('acduration')[0].innerHTML = "N/A";

			}//if
			document.getElementsByName('acposition')[0].innerHTML = recorddata[0][0]['acpositionname'];

			if(recorddata[0][0]['officename'] !== "") {
				document.getElementsByName('acofficename')[0].innerHTML = recorddata[0][0]['officename'];
			} else {
				document.getElementsByName('acofficename')[0].innerHTML = "N/A";
			}//if

			if(recorddata[0][0]['officeaddress'] !== "") {
				document.getElementsByName('acofficeaddress')[0].innerHTML = recorddata[0][0]['officeaddress'];
			} else {
				document.getElementsByName('acofficeaddress')[0].innerHTML = "N/A";
			}//if

			var unitoffice = "";

			if(recorddata[0][0]['UnitOfficeQuaternaryName'] != null) {
				unitoffice = unitoffice + recorddata[0][0]['UnitOfficeQuaternaryName'];
				if(recorddata[0][0]['UnitOfficeTertiaryName'] != null) {
					unitoffice = unitoffice + ", ";
				}//if

			}//if

			if(recorddata[0][0]['UnitOfficeTertiaryName'] != null) {
				unitoffice = unitoffice + recorddata[0][0]['UnitOfficeTertiaryName'] + ", ";

			}//if

			unitoffice = unitoffice + recorddata[0][0]['UnitOfficeSecondaryName'];
			
			document.getElementsByName('acunitoffice')[0].innerHTML = unitoffice;

			document.getElementsByName('acsector')[0].innerHTML = recorddata[0][0]['sectorname'];
		}//fillacdata

		function filltpdata(recorddata) {
			/*var type;

			if(recorddata[0][0]['policetype'] == 1) {
				type = "Technical Working Group (TWG)";

			} else if(recorddata[0][0]['policetype'] == 2) {
				type = "Police Strategy Management Unit (PSMU)";

			}//if

			document.getElementsByName('tpadvcateg')[0].innerHTML = type;*/

		if(recorddata[0][0]['startdate'] != null) {
				document.getElementsByName('tpduration')[0].innerHTML = recorddata[1][2] + " - " + recorddata[1][3];
				console.log(recorddata[2][2]);
			} else {
				document.getElementsByName('tpduration')[0].innerHTML = "N/A";

			}//iff

			document.getElementsByName('tpauthorder')[0].innerHTML = recorddata[0][0]["authorityorder"];

			document.getElementsByName('tpposition')[0].innerHTML = recorddata[0][0]["PositionName"];

			var unitoffice = "";

			if(recorddata[0][0]['UnitOfficeQuaternaryName'] != null) {
				unitoffice = unitoffice + recorddata[0][0]['UnitOfficeQuaternaryName'];
				if(recorddata[0][0]['UnitOfficeTertiaryName'] != null) {
					unitoffice = unitoffice + ", ";
				}//if

			}//if

			if(recorddata[0][0]['UnitOfficeTertiaryName'] != null) {
				unitoffice = unitoffice + recorddata[0][0]['UnitOfficeTertiaryName'] + ", ";

			}//if

			unitoffice = unitoffice + recorddata[0][0]['UnitOfficeSecondaryName'];

			document.getElementsByName('tpoffice')[0].innerHTML = unitoffice;

			$("#trainviewtable tbody").empty();

			for (var ctr = 0 ; ctr < recorddata[2][0].length ; ctr++) {
				filltable("trainviewtable", recorddata[2][0][ctr], recorddata[2][1][ctr], recorddata[2][2][ctr]);
			};
		}//filltpdata

		function loadModal(tid,choice) {

			if(choice==true){
				alert("123");
				$("button[name=editbtn]").attr("disabled", true);
			}

			var tiditems = tid.split("-");

			if(tiditems.length == 2) {
				var data = {
					'id' : parseInt(tiditems[1]),
					'type': parseInt(tiditems[0]),
					'_token' : '{{ Session::token() }}'
				};

				$.ajax({
					type: "POST",
					url: "{{url('getdata')}}",
					data: data,
					dataType: "JSON",
				   	success : function(recorddata) {

				   		document.getElementsByName('editbtn')[0].setAttribute("onclick","window.location='{!!url('directory/edit?c=" + tid + "')!!}'");

				   		fillprofile(recorddata);


				   		if(parseInt(tiditems[0]) == 0) {
				   			showacview();
				   			fillacdata(recorddata);

				   		}else if(parseInt(tiditems[0]) == 1 || parseInt(tiditems[0]) == 2){
				   			showtpview();
				   			filltpdata(recorddata);

				   		}//if
			
				   		$('.modalcontent .item').removeClass('active');
				   		$('.modalcontent .tab').removeClass('active');
				   		$('.modalcontent #tab1').addClass('active');
				   		$(".modalcontent .ui.tab[data-tab='basicinfo']").addClass('active');;
				   		$("#viewadv").modal("show");

				   		
				   	},
					error:function() {
						$('#errormodal').modal('show');
					} 

				});

				
			}//if

		}//function loadModal() {

	</script>