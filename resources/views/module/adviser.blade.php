@extends('baseform')

	@section('maincontent')

	<div class = "advcon">
		<div class = "ui grid">
			<div class = "row">
				<div class = "four wide column ">
					<div class = "ui segment filcon " id="summary">
						
							<div class = "ui con">
								<div class="ui container ">
									<div class = "summhead">
										<i class = "filter icon"></i>
											Filter
									</div>

											
								<div class = "twelve wide column bspacing2">
										<div class = "one field">
											<label class="formlabel">Stakeholder Category</label>
											<div class="field">

												<select onchange = "fieldcontrol(),loaddata()" class="ui selection dropdown filselect" name = "filadvcateg">

													<option value="4" selected>All</option>
													<option value="1">Advisory Council (AC)</option>
													<option value="2">Technical Working Group (TWG)</option>
													<option value="3">Police Strategy Management Unit (PSMU)</option>

												</select>
											</div>
										</div>
										
									</div>

									
										

									<div class = "twelve wide column bspacing2">
										<div class = "one field">
											<label class="formlabel">AC Position</label>
											<div class="field">
												<select onchange = "loaddata()" class="ui selection dropdown filselect" name = "filacposition">
													<option value="disitem" selected>Select One</option>

													@foreach ($acposition as $acp)
								                        <option value="{{$acp->ID}}">{{$acp->acpositionname}}</option>
								                    @endforeach

													

												</select>
											</div>
										</div>
										
									</div>

									<div class = "twelve wide column bspacing2">
										<div class = "one field">
											<label class="formlabel">Rank</label>
											<div class="field">
												<select onchange = "loaddata()" class="ui selection dropdown filselect" name = "filpnpposition">
													<option value="disitem" selected>Select One</option>
													
													@foreach ($pnpposition as $pnpp)
								                        <option value="{{$pnpp->id}}">{{$pnpp->PositionName}}</option>
								                    @endforeach

												</select>
											</div>
										</div>
										
									</div>


									<div class = "twelve wide column bspacing2">
										<div class = "one field">
											<label class="formlabel">Unit/Offices</label>
											<div class="field">
												<select class="ui selection dropdown filselect" onchange="getsecoffice(this.value),loaddata()" name = "filprimary">
													<option value="disitem" selected>Primary Unit/Office</option>
													@foreach ($unitoffice as $puo)
								                        <option value="{{$puo->id}}">{{$puo->UnitOfficeName}}</option>
								                    @endforeach

												</select>
											</div>

											<div class="field bspacing1">
												<select onchange = "getteroffice(this.value), loaddata()" class="ui selection dropdown filselect" name = "filsecondary">
													<option value="disitem" selected>Secondary Unit/Office</option>
													

												</select>
											</div>

											<div class="field bspacing1">
												<select onchange = "getquaroffice(this.value), loaddata()" class="ui selection dropdown filselect" name = "filtertiary">
													<option value="disitem" selected>Tertiary Unit/Office</option>
													

												</select>
											</div>

											<div class="field bspacing1">
												<select onchange = "loaddata()" class="ui selection dropdown filselect" name = "filquaternary">
													<option value="disitem" selected>Quaternary Unit/Office</option>
													

												</select>
											</div>
										</div>
										
									</div>

									<div class = "twelve wide column bspacing2">
										<div class = "one field">
											<label class="formlabel">AC Sector</label>
											<div class="field">
												<select onchange = "loaddata()" class="ui selection dropdown filselect" name = "filacsector">
													<option value="disitem" selected>Select One</option>
													@foreach ($acsector as $acs)
								                        <option value="{{$acs->ID}}">{{$acs->sectorname}}</option>
								                    @endforeach

												</select>
											</div>
										</div>
										
									</div>

									<div class = "twelve wide column bspacing2">
										<div class = "one field">
											<label class="formlabel">Gender</label>
											<div class = "inline fields">
												<div class = "ui checkbox field">
													<input type="checkbox" onchange="loaddata()" id="filgenderm" value="0"  tabindex="0" class="hidden">
													<label>Male</label>
														
												</div>
												<div class = "ui checkbox field">
													<input type="checkbox" onchange="loaddata()" id="filgenderf" value="1"  tabindex="0" class="hidden">
													<label>Female</label>
													
														
												</div>
												
											</div>
										</div>
										
									</div>

									<div class = "twelve wide column bspacing2">
										<div class = "one field">
											<label class="formlabel">Location</label>

											<div class="ui input field filtext">
												<input type="text" onkeyup="loaddata()" id = "filcityloc" placeholder="City">
											</div>

											<div class="ui input field bspacing1 filtext">
												<input type="text" onkeyup="loaddata()" id = "filprovloc" placeholder="Province">
											</div>
										</div>
										
									</div>

									<div class = "twelve wide column bspacing2">
										<div class = "one field">
											<label class="formlabel">Age</label>
											<div class = "inline fields">
												<div class = "ui input field">
													<label class="agelbl">From</label>
													<input type="number" onkeyup="checkageinput()" class = "filspnr" step="1" min="0" max="75" id="filage1" value="0">
													
														
												</div>
												<div class = "ui input field">
													<label class="agelbl">to</label>
													<input type="number" onkeyup="checkageinput()" class = "filspnr" step="1" min = "0" max="75" id="filage2" value="0">
													
													
														
												</div>
												
											</div>
										</div>
										
									</div>
									
									<div class ="twelve wide column  bspacing8 centerbtn2">
										<form method="post" action="Advisory_Council" target="_blank"> 
											<input type="hidden" name="_token" value="{{csrf_token()}}">
							                <input type="hidden" name="fname" value="">
							                <input type="hidden" name="mname" value="">
							                <input type="hidden" name="lname" value="">
							                <input type="hidden" name="position" value="">
							                <input type="hidden" name="office2" value="">
							                <input type="hidden" name="office3" value="">
							                <input type="hidden" name="office4" value="">
							                <input type="hidden" name="poltype" value="">
							                <input type="hidden" name="landline" value="">
							                <input type="hidden" name="address" value="">
							                <input type="hidden" name="contact" value="">
							                <input type="hidden" name="email" value="">
							                <input type="hidden" name="gender" value="">
							                <input type="hidden" name="sector" value="">
							                <input type="hidden" name="imageurl" value="">
							                <input type="hidden" name="startdate" value="">

											<button type="submit" name="submit" id="pdf-loader" class="rwdbutton ui medium button ">
												Generate PDF
											</button>
										</form>
									</div>



									
														
								</div>
											
							</div>
										
					
											
									
					</div>
					
				</div>

				 <div>
		            
	            </div>

				<div class = "twelve wide column">
					<div class = "hcontent rwdDhcontent">
						<div class="dcon">
							<div class = "tablepane">
								<div class = "mtitle rwdFmtitle">Stakeholder(s)</div>
								<div class= "ui grid">
									<div class = "column">
										@yield('advisercontent')
									</div>
								</div>
							</div>

						</div>
					</div>
					
				</div>
				
			</div>
			
		</div>

		
		
	</div>
	

	<script type="text/javascript">

		$(document).ready(function() {
            // var tab = $('#datatables').DataTable({
            //     responsive: true
            loaddata();
         });

            
		$('#tab3').attr('class', 'mlink item active');

		var pdfid=[];
        var pdffname = [];
        var pdfmname = [];
        var pdflname = [];
        var pdfsecondoff = [];
        var pdftertiaryoff = [];
        var pdfquaternaryoff = [];
        var pdfsector = [];
        var pdfaddress = [];
        var pdfposition = [];
        var pdfpoltype = [];
        var pdflandline = [];
        var pdfemail = [];
        var pdfgender = [];
        var pdfbday = [];
        var pdfcontact = [];
        var pdfimage = [];
        var pdfsdate = [];

		
		function checkageinput() {
			var age1 = document.getElementById('filage1').value;
			var age2 = document.getElementById('filage2').value;

			if(age1 != 0 && age2 != 0) {
				if(age1 >= 10 && age2 > age1) {
					//call loaddata function
					//loaddata();
					loaddata();
					//console.log('hello');
				}//if
			}//if
			

		}//checkageinput

		function fieldcontrol() {
			var advcateg = $("select[name='filadvcateg']").val();

			if(advcateg == 1) {
				$("select[name='filacposition']").dropdown().removeClass('disabled');
				$("select[name='filacsector']").dropdown().removeClass('disabled');
				$("select[name='filpnpposition']").dropdown().addClass('disabled');


			} else if(advcateg == 2 || advcateg == 3) {
				$("select[name='filacposition']").dropdown().addClass('disabled');
				$("select[name='filacsector']").dropdown().addClass('disabled');
				$("select[name='filpnpposition']").dropdown().removeClass('disabled');

			} else if(advcateg == 4) {
				$("select[name='filacposition']").dropdown().removeClass('disabled');
				$("select[name='filacsector']").dropdown().removeClass('disabled');
				$("select[name='filpnpposition']").dropdown().removeClass('disabled');
			}

		}//changefieldstate


		//------------------------
		function getsecoffice(val) {

			var data = {
					'poID' : val,
					'_token' : '{{ Session::token() }}'

				};


			$.ajax({
				type: "POST",
				url: "{{url('dropdown/getsecoffice')}}",
				data: data,
				dataType: 'json',
			   	success : function(secoffice) {

			   		$("select[name='filsecondary'] option").not("[value='disitem']").remove();

			   		for (var ctr = 0 ; ctr < secoffice.length ; ctr++) {
			   			populatedropdown(secoffice[ctr]['id'], 'filsecondary', secoffice[ctr]['UnitOfficeSecondaryName']);
			   			
			   		};


			   		
			   	},
				error:function() {
					$('#errormodal').modal('show');
				} 
			});

		}//function getsecoffice() {

		function getteroffice(val) {
			var data = {
				'soID' : val,
				'_token' : '{{ Session::token() }}'

			};

			$.ajax({
				type: "POST",
				url: "{{url('dropdown/getteroffice')}}",
				data: data,
				dataType: 'json',
			   	success : function(teroffice) {

			   		$("select[name='filtertiary'] option").not("[value='disitem']").remove();

			   		for (var ctr = 0 ; ctr < teroffice.length ; ctr++) {
			   			populatedropdown(teroffice[ctr]['id'], 'filtertiary', teroffice[ctr]['UnitOfficeTertiaryName']);
			   			
			   		};

			   		
			   	},
				error:function() {
					$('#errormodal').modal('show');
				} 
			});
		}//function getteroffice() {

		function getquaroffice(val) {
			var data = {
				'toID' : val,
				'_token' : '{{ Session::token() }}'

			};

			$.ajax({
				type: "POST",
				url: "{{url('dropdown/getquaroffice')}}",
				data: data,
				dataType: 'json',
			   	success : function(quaroffice) {

			   		$("select[name='filquaternary'] option").not("[value='disitem']").remove();

			   		for (var ctr = 0 ; ctr < quaroffice.length ; ctr++) {
			   			populatedropdown(quaroffice[ctr]['id'], 'filquaternary', quaroffice[ctr]['UnitOfficeQuaternaryName']);
			   			
			   		};

			   		
			   	},
				error:function() {
					$('#errormodal').modal('show');
				} 
			});
		}//function getteroffice() {

		 function loaddata(){
            
            pdfid=[];
            pdffname = [];
            pdfmname = [];
            pdflname = [];
            pdfsecondoff = [];
            pdftertiaryoff = [];
            pdfquaternaryoff = [];
            pdfsector = [];
            pdfaddress = [];
            pdfposition = [];
            pdfpoltype = [];
            pdflandline = [];
            pdfemail = [];
            pdfgender = [];
            pdfbday = [];
            pdfcontact = [];
            pdfimage = [];
            pdfsdate = [];
    
            var advisory = document.getElementsByName('filadvcateg')[0].value;
            var data;
            var gender;
            ageFrom = document.getElementById('filage1').value;
            ageTo = document.getElementById('filage2').value;
            city = document.getElementById('filcityloc').value;
            province = document.getElementById('filprovloc').value;
            unitofficesecond = document.getElementsByName('filsecondary')[0].value;
            unitofficeprimary = document.getElementsByName('filprimary')[0].value;

            if(document.getElementById('filgenderm').checked == true && document.getElementById('filgenderf').checked == true)
                { gender = 0;}
            else if(document.getElementById('filgenderm').checked == true && document.getElementById('filgenderf').checked == false)
                { gender = 1; }
            else if(document.getElementById('filgenderm').checked == false && document.getElementById('filgenderf').checked == true) 
                { gender = 2; }
            else { gender = 0; }

            if(advisory==1)
            {
                data = {
                    'callid' : 1,
                    'office' : unitofficeprimary,   
                    'office2' : unitofficesecond,
                    'sector' : document.getElementsByName('filacsector')[0].value,
                    'civposition' : document.getElementsByName('filacposition')[0].value,
                    'ageFrom' : ageFrom,
                    'ageTo' : ageTo,
                    'city' : city,
                    'province' : province,
                    'gender' : gender,
                    '_token' : '{{ Session::token() }}'
                };    
            }

            else if(advisory==2 || advisory==3)
            {   
                data = {
                    'callid' : 2,
                    'advisory' : advisory-1,
                    'office' : unitofficeprimary,
                    'office2' : unitofficesecond,
                    'office3' : document.getElementsByName('filtertiary')[0].value,
                    'office4' : document.getElementsByName('filquaternary')[0].value,
                    'polposition' : document.getElementsByName('filpnpposition')[0].value,
                    'ageFrom' : ageFrom,
                    'ageTo' : ageTo,
                    'city' : city,
                    'province' : province,
                    'gender' : gender,
                    '_token' : '{{ Session::token() }}'
                };
            }

            else if(advisory==4)
            {
                data = {
                    'callid' : 3,
                    'office' : unitofficeprimary,
                    'office2' : unitofficesecond,
                    'advisory' : 0,
                    'office3' : document.getElementsByName('filtertiary')[0].value,
                    'office4' : document.getElementsByName('filquaternary')[0].value,
                    'ageFrom' : ageFrom,
                    'ageTo' : ageTo,
                    'city' : city,
                    'province' : province,
                    'gender' : gender,
                    '_token' : '{{ Session::token() }}'
                };   
            }
            //console.log(data);

            $.ajax({
                type: "POST",
                data: data,
                url: "{{url('load-pdf-data')}}",
                datatype: "JSON",
                success: function(data){
                    
                    //document.getElementById('clearRow').click();

                    //console.log(data);
          
                    if(advisory==1)
                    {
                        loadAC(data);      
                    }

                    if(advisory==2 || advisory==3)
                    {
                        loadPolAd(data);
                    }

                    if(advisory==4)
                    {

                        if(data[0]!='' && data[0]!=null && data[0]!=0)
                        {
                            loadAC(data[0]);
                        }

                        if(data[1]!='' && data[1]!=null && data[1]!=0)
                        {
                            loadPolAd(data[1]);
                        }

                     }   
                            document.getElementsByName('fname')[0].value = pdffname;
                            document.getElementsByName('mname')[0].value = pdfmname;
                            document.getElementsByName('lname')[0].value = pdflname;
                            document.getElementsByName('office2')[0].value = pdfsecondoff;
                            document.getElementsByName('office3')[0].value = pdftertiaryoff;
                            document.getElementsByName('office4')[0].value = pdfquaternaryoff;
                            document.getElementsByName('poltype')[0].value = pdfpoltype;
                            document.getElementsByName('landline')[0].value = pdflandline;
                            document.getElementsByName('gender')[0].value = pdfgender;
                            document.getElementsByName('position')[0].value = pdfposition;
                            document.getElementsByName('email')[0].value = pdfemail;
                            document.getElementsByName('contact')[0].value = pdfcontact;
                            document.getElementsByName('address')[0].value = pdfaddress;
                            document.getElementsByName('sector')[0].value = pdfsector;
                            document.getElementsByName('imageurl')[0].value = pdfimage; 
                            document.getElementsByName('startdate')[0].value = pdfsdate;

                }

            });//AJAX
        }// LOAD DATA

        function loadAC(data)
        {
            responseArray = data.split("|");
                        numOfRow = responseArray[0];
                        num = 1;

                        for(i=0; i < numOfRow; i++)
                        {
                            cell1 = responseArray[num];num++;
                            
                            if(responseArray[num+2]!="" && responseArray[num+2]!=null)
                                { cell2 = responseArray[num] + ", " + responseArray[num+1] +" "+responseArray[num+2] ; }
                            else { cell2 = responseArray[num] + ", " + responseArray[num+1]; }

                            pdffname.push(responseArray[num+1]);
                            pdfmname.push(responseArray[num+2]);
                            pdflname.push(responseArray[num]);

                            num+=3;
                            
                            if(responseArray[num+1]!='' && responseArray[num+2]!='')
                            {
                                //$office = $office4name." - ".$office3name." - ".$office2name;
                                cell3 = responseArray[num+2] +' - ' + responseArray[num+1] +' - '+ responseArray[num];
                                pdftertiaryoff.push(responseArray[num+1]);
                                pdfquaternaryoff.push(responseArray[num+2]);
                            }

                            if(responseArray[num+1]!='' && responseArray[num+2]=='')
                            {
                                //$office = $office3name." - ".$office2name;
                                //cell3 = responseArray[num];num+=3;
                                cell3 = responseArray[num+1] +' - '+ responseArray[num];
                                pdftertiaryoff.push(responseArray[num+1]);
                                pdfquaternaryoff.push("");
                            }

                            if(responseArray[num+1]=='' && responseArray[num+2]=='')
                            {
                              //  $office = $office2name;
                                cell3 = responseArray[num];
                                pdftertiaryoff.push("");
                                pdfquaternaryoff.push("");
                            
                            }

                            pdfsecondoff.push(responseArray[num]);

                            num+=3;

                            //cell3 = responseArray[num];num+=3;
                            
                            cell4 = responseArray[num];num++;
                            cell5 = responseArray[num];num++;
                            cell6 = "AC";
                            cell7 = responseArray[num];num++;
                            cell8 = responseArray[num];num++;
                            cell9 = responseArray[num];num++;
                            cell10 = responseArray[num];num++;
                            cell11 = responseArray[num];num++;
                            cell12 = responseArray[num];num++;
                            cell13 = responseArray[num];num++;

                            val = cell1 + "|" + cell2 + "|" + cell3 + "|" + cell4 + "|" +
                                  cell5 + "|" + cell6 + "|" + cell7 + "|" + cell8 + "|" +
                                  cell9 + "|" + cell10 + "|" + cell11 + "|" + cell12 + "|" + cell13;

                            pdfid.push(cell1);
                            pdfsector.push(cell4); 
                            pdfposition.push(cell5);
                            pdfpoltype.push(cell6);
                            pdfgender.push(cell7);
                            pdfaddress.push(cell8);
                            pdfimage.push(cell9);
                            pdfcontact.push(cell10);
                            pdflandline.push(cell11);
                            pdfemail.push(cell12);
                            pdfsdate.push(cell13);
                            // document.getElementById('addRow').value = val;
                            // document.getElementById('addRow').click();
                            
                        }
        }

        function loadPolAd(data)
        {
            responseArray = data.split("|");
                        numOfRow = responseArray[0];
                        num = 1;

                        for(i=0; i < numOfRow; i++)
                        {
                            cell1 = responseArray[num];num++;
                            
                            if(responseArray[num+2]!="" && responseArray[num+2]!=null)
                                { 
                                    cell2 = responseArray[num] + ", " + responseArray[num+1] +" "+responseArray[num+2] ; 
                                }
                            else { cell2 = responseArray[num] + ", " + responseArray[num+1]; }
                                
                                pdffname.push(responseArray[num+1]);
                                pdfmname.push(responseArray[num+2]);
                                pdflname.push(responseArray[num]);

                            num+=3;

                            if(responseArray[num+1]!='' && responseArray[num+2]!='')
                            {
                                //$office = $office4name." - ".$office3name." - ".$office2name;
                                cell3 = responseArray[num+2] +' - ' + responseArray[num+1] +' - '+ responseArray[num];
                                pdftertiaryoff.push(responseArray[num+1]);
                                pdfquaternaryoff.push(responseArray[num+2]);
                            
                            }

                            if(responseArray[num+1]!='' && responseArray[num+2]=='')
                            {
                                //$office = $office3name." - ".$office2name;
                                //cell3 = responseArray[num];num+=3;
                                cell3 = responseArray[num+1] +' - '+ responseArray[num];
                                pdftertiaryoff.push(responseArray[num+1]);
                                pdfquaternaryoff.push("");
                            }

                            if(responseArray[num+1]=='' && responseArray[num+2]=='')
                            {
                              //  $office = $office2name;
                              cell3 = responseArray[num];
                              pdftertiaryoff.push("");
                              pdfquaternaryoff.push("");
                            
                            }

                            pdfsecondoff.push(responseArray[num]);
                            pdftertiaryoff.push(responseArray[num+1]);
                            pdfquaternaryoff.push(responseArray[num+2]);

                            num+=3;

                            //cell3 = responseArray[num];num+=3;
                            cell4 = "PNP";
                            cell5 = responseArray[num];num++;
                            cell6 = responseArray[num];num++;
                            cell7 = responseArray[num];num++;
                            cell8 = responseArray[num];num++;
                            cell9 = responseArray[num];num++;
                            cell10 = responseArray[num];num++;
                            cell11 = responseArray[num];num++;
                            cell12 = responseArray[num];num++;
                            cell13 = responseArray[num];num++;


                            val = cell1 + "|" + cell2 + "|" + cell3 + "|" + cell4 + "|" +
                                  cell5 + "|" + cell6 + "|" + cell7 + "|" + cell8 + "|" +
                                  cell9 + "|" + cell10 + "|" + cell11 + "|" + cell12 + "|" + cell13;

                            pdfid.push(cell1);
                            pdfsector.push(""); 
                            pdfposition.push(cell5);
                            if(cell6==1)
                                { pdfpoltype.push("TWG"); }
                            else { pdfpoltype.push("PSMU"); }
                            pdfgender.push(cell7);
                            pdfaddress.push(cell8);
                            pdfimage.push(cell9);
                            pdfcontact.push(cell10);
                            pdflandline.push(cell11);
                            pdfemail.push(cell12);
                            pdfsdate.push(cell13);

                            // document.getElementById('addRow').value = val;
                            // document.getElementById('addRow').click();

                            
                        }
        }


		
	</script>
	
@include('home.directory_modal')

@stop