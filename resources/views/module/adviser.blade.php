@extends('baseform')

	@section('maincontent')

	<div class = "advcon">
		<div class = "ui grid">
			<div class = "row">
				<div class = "four wide column">
					<div class = "ui segment filcon" id="summary">
						<div class = "ui rail">
							<div class = "ui con">
								<div class="ui container ">
									<div class = "summhead">
										<i class = "filter icon"></i>
											Filter
									</div>

										
											<label class="formlabel">Stakeholder Category</label>
											
								<div class = "twelve wide column bspacing2">
										<div class = "one field">
											<label class="formlabel">Stakeholder Category</label>
											<div class="field">
												<select onchange = "fieldcontrol();" class="ui fluid selection dropdown " name = "filadvcateg">
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
											<label class="formlabel">PNP Position</label>
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
												<select class="ui selection dropdown filselect" onchange="getsecoffice(this.value)" name = "filprimary">
													<option value="disitem" selected>Primary Unit/Office</option>
													@foreach ($unitoffice as $puo)
								                        <option value="{{$puo->id}}">{{$puo->UnitOfficeName}}</option>
								                    @endforeach

												</select>
											</div>

											<div class="field bspacing1">
												<select onchange = "getteroffice(this.value); loaddata()" class="ui selection dropdown filselect" name = "filsecondary">
													<option value="disitem" selected>Secondary Unit/Office</option>
													

												</select>
											</div>

											<div class="field bspacing1">
												<select onchange = "getquaroffice(this.value); loaddata()" class="ui selection dropdown filselect" name = "filtertiary">
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
													<input type="checkbox" onselect="loaddata()" name="filgender" value="0"  tabindex="0" class="hidden">
													<label>Male</label>
														
												</div>
												<div class = "ui checkbox field">
													<input type="checkbox" onselect="loaddata()" name="filgender" value="1"  tabindex="0" class="hidden">
													<label>Female</label>
													
														
												</div>
												
											</div>
										</div>
										
									</div>

									<div class = "twelve wide column bspacing2">
										<div class = "one field">
											<label class="formlabel">Location</label>

											<div class="ui input field filtext">
												<input type="text" onchange = "loaddata()" name = "filcityloc" placeholder="City">
											</div>

											<div class="ui input field bspacing1 filtext">
												<input type="text" onchange = "loaddata()" name = "filprovloc" placeholder="Province">
											</div>
										</div>
										
									</div>

									<div class = "twelve wide column bspacing2">
										<div class = "one field">
											<label class="formlabel">Age</label>
											<div class = "inline fields">
												<div class = "ui input field">
													<label class="agelbl">From</label>
													<input type="number" onchange="checkageinput()" class = "filspnr" step="1" min="0" max="75" name="filage1" value="0">
													
														
												</div>
												<div class = "ui input field">
													<label class="agelbl">to</label>
													<input type="number" onchange="checkageinput()" class = "filspnr" step="1" min = "0" max="75" name="filage2" value="0">
													
													
														
												</div>
												
											</div>
										</div>
										
									</div>
									
									<div class ="twelve wide column  bspacing8 centerbtn2">
										<button type="submit" name="submit" class="ui medium button">
											Generate PDF
										</button>
									</div>



									
														
								</div>
											
							</div>
										
						</div>
											
									
					</div>
					
				</div>

				<div class = "twelve wide column">
					<div class = "hcontent">
						<div class="dcon">
							<div class = "tablepane">
								<div class = "mtitle">Stakeholder(s)</div>
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
		$('#tab3').attr('class', 'mlink item active');

		
		function checkageinput() {
			var age1 = document.getElementsByName('filage1')[0].value;
			var age2 = document.getElementsByName('filage2')[0].value;

			if(age1 != 0 && age2 != 0) {
				if(age1 >= 10 && age2 > age1) {
					//call loaddata function
					//loaddata();

					console.log('hello');
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

		
	</script>
	
@include('home.directory_modal')

@stop