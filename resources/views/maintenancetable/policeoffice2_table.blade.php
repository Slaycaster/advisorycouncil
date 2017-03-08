@extends('module.maintenance')

@section('mfillformsection')
	<form class = "ui form" id = "form" action = "javascript:loadCModal()" onsubmit="validationCheckbox(this)">
							
		<div class = "labelpane2">
									
			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Primary Office
						<span class = "asterisk">*</span>
				</label>
			</div>

			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Secondary Office
					<span class = "asterisk">*</span>
				</label>
			</div>
							
		</div>	

		<input type="hidden" value="" name="subid"/>
			<div class = "fieldpane2">
				<div class = "twelve wide column bspacing2">
					<div class = "field">
						<select class="modified ui selection dropdown selectstyle2" name="office" id = "select">
							<option disabled selected>Select One</option>
									  
								@foreach($offices as $sitem)

									<option value = '{{$sitem->id}}'>{{$sitem->UnitOfficeName}}</option>

								@endforeach
									  	

						</select>
									
					</div>
								
				</div>

				<div class = "twelve wide column bspacing2">
					<div class="ui input field formfield">
						<input type="text" name="name" placeholder="Enter Secondary Office Name e.g. PRO1">
					</div>
				</div>
						
				<div class = "twelve wide column bspacing2">
					<div class="ui checkbox">
						<input type="checkbox" name="haster" id="has">
						<label class = "boollabel">Has Tertiary</label>
					</div>
				</div> <br>

				<div class = "twelve wide column bspacing2">
					<center><button type = "submit" name="submit" 
								class="ui tiny button submit savebtnstyle">

									Save
							</button>
							<button type="button" onclick = "$('#cancelmodal').modal('show');" class="ui tiny button">
									Cancel

							</button></center>
				</div>
			</div>	
								
								
		</form>

@endsection

@section('mtablesection')
	<div class = "mtitle">Secondary Unit/Office</div>

	<div class = "tablecon">
		<table id="datatable" class="ui celled table" cellspacing="0" width="100%">
		    <thead>
		    	<tr>
		            <th><center>Primary Office</center></th>
		            <th><center>Secondary Office</center></th>
		            <th><center>Has Tertiary</center></th>
		        </tr>	
		    </thead>
					                   
		    <tbody>
		    	@foreach($suboffices as $key)
		    		<tr class = "trow" onclick = "loaddata({{$key->id}})" id = "{{$key->ID}}">
		    			<td><center>{{$key->unitoffice->UnitOfficeName}}</center></td>
			    		<td><center>{{$key->UnitOfficeSecondaryName}}</center></td>
			    		<td><center>
			    			@if(strtolower($key->UnitOfficeHasTertiary) == "true")

				    			<i class="ui green large checkmark icon"></i>

				    		@elseif(strtolower($key->UnitOfficeHasTertiary) == "false")

				    			<i class="ui red large remove icon"></i>
				    			

				    		@endif




			    		</center></td>
			    			
			 	@endforeach

		    </tbody>

		</table>
						
	</div>

	<script type="text/javascript">
		$('#m2').attr('class', 'item active');
		var flag = 0;

		function controlaction() {
			if(flag == 1) {
				editData();

			} else if(flag == 0) {
				addData();

			}//if(flag == 1) {
		}//function controlaction() {

		function resetflag(msg) {
			flag = 0;

			$("#myToast").showToast({
				message: msg,
				timeout: 2500
			});

		}//function resetflag() {

		function loaddata(id) {

			flag = 1;
			$('#' + id).attr('class', 'activerow');
			$('tr').not("[id = '" + id + "']").attr('class', 'trow');;

			var data = {
				'id' : id,
				'_token' : '{{ Session::token() }}'
			};

			$.ajax({
				type: "POST",
				url: "{{url('maintenance/subpoliceview')}}",
				data: data,
			   	dataType: "JSON",
			   	success : function(data) {

			   		console.log(data);
			   		document.getElementsByName('subid')[0].value = data['id'];
			   		$('#select').dropdown('set selected', data['UnitOfficeID']);
			   		document.getElementsByName('name')[0].value = data['UnitOfficeSecondaryName'];
			   		// document.getElementsByName('haster')[0].value = data['UnitOfficeHasTertiary'];
			   		if(data['UnitOfficeHasTertiary'] == "True"){
			   			document.getElementById('has').checked = true;
			   		}
			   		else{
			   			$("#has").prop('checked', false);
			   		}

			   	}//success : function() {
			});


		}//function loaddata() {

		function addData() {
			var data = {
				'name' : document.getElementsByName("name")[0].value,
				'office' : document.getElementsByName("office")[0].value,
				'haster' : document.getElementsByName("haster")[0].value,
				'submit': document.getElementsByName("submit")[0].value,
				'_token' : '{{ Session::token() }}'
			};

			$.ajax({
				type: "POST",
				url: "{{url('confirmpolice')}}",
				data: data,
			   	success : function() {
			   		resetflag('Saved!');


			   	}
			});

			setTimeout(function(){
				location.reload();
			}, 2600);

		}//function addData(){

		function editData() {
			var data = {
				'subID' : document.getElementsByName('subid')[0].value,
				'office' : document.getElementsByName("office")[0].value,
				'name' : document.getElementsByName("name")[0].value,
				'haster' : document.getElementsByName("haster")[0].value,
				'submit': document.getElementsByName("submit")[0].value,
				'_token' : '{{ Session::token() }}'
			};

			$.ajax({
				type: "POST",
				url: "{{url('maintenance/editsubpolice')}}",
				data: data,
			   	success : function() {
			   		resetflag('Updated!');


			   	}//success : function() {
			});

			setTimeout(function(){
				location.reload();
			}, 2600);


		}//

		function validationCheckbox(check){
			if(check.haster.checked == true){
				document.getElementById('has').value = "True"
			}
			else{
				document.getElementById('has').value = "False"	
			}

		}

	</script>

@stop