@extends('module.maintenance')

@section('mfillformsection')

	<form class = "ui form" id = "form" action = "javascript:loadCModal()">

							
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

			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Tertiary Office
				</label>
				<span class = "asterisk">*</span>
			</div>

			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Description
				</label>
			</div>

		</div>	

		<input type="hidden" value="" name="ID" id='ID'/>
		<input type="hidden" name="_token" id="csrf-token" value="{{Session::token()}}">

			<div class = "fieldpane2">
				<div class = "twelve wide column bspacing2">
					<div class = "field">
						<select class="modified ui selection dropdown selectstyle2" name="select_office1" id = "office1"
						onchange="Select_Office(this.value)">
							<option value = "disitem" disabled>Select One</option>

							@foreach($poOne as $rs1)
					       		<option value="{{$rs1->id}}">{{$rs1->UnitOfficeName}}</option>
							@endforeach												 

						</select>
									
					</div>
								
				</div>

				<div class = "twelve wide column bspacing2">
					<div class = "field">

						<select class="modified ui selection dropdown selectstyle2" name="select_office2" id = "office2" >

							<option selected  value = "disitem">Select One</option>

						</select>
									
					</div>
								
				</div>

				<div class = "twelve wide column bspacing2">
					<div class="ui input field formfield">
						<input type="text" name="terName" id='terName' placeholder="Enter Tertiary Office Name e.g. La Union">
					</div>
				</div>

				<div class = "twelve wide column bspacing2">
					<div class="field">
						<textarea id="desc" name = "desc" class = "areastyle" rows = "4" placeholder="Type here..."></textarea>
					</div>
				</div>	

				<div class = "twelve wide column bspacing2">
					<div class="ui checkbox">
						<input type="checkbox" id='hasQuart' name='hasQuart' >
						<label class = "boollabel">Has Quaternary</label>
					</div>
				</div> <br>


				<div class = "twelve wide column bspacing2">
				<center><button class="ui tiny button submit savebtnstyle"
							id="dualbutton"
							type="submit"
							name="submit" 
							value = '1'>
									
							Save
					</button>

					<button class="ui tiny button"  
							type="button" onclick = "$('#cancelmodal').modal('show');">
							Cancel
					</button></center>
			</div>	
			</div>	
							
								
		</form>

@endsection
@section('mtablesection')
	<div class = "mtitle">Tertiary Unit/Office</div>

	<div class = "tablecon">
		<table id="datatable" class="ui celled table" cellspacing="0" width="100%">
		    <thead>
		    	<tr>
		            <th><center>Primary Office</center></th>
		            <th><center>Secondary Office</center></th>
		            <th><center>Tertiary Office</center></th>
		            <th><center>Description</center></th>
		            <th><center>Has Quaternary</center></th>
		        </tr>	
		    </thead>
					                   
		    <tbody>
		     @foreach ($pothree as $tri) 
			    <tr onclick = "loaddata({{$tri->id}})"  id = "{{$tri->id}}">

			       	<td><center>{{$tri->UnitOfficeName}}</center></td>
			       	<td><center>{{$tri->UnitOfficeSecondaryName}}</center></td>
			    	<td><center>{{$tri->UnitOfficeTertiaryName}}</center></td>
			    	<td><center>{{$tri->desc}}</center></td>
			    	<td><center>
			    		@if(strtolower($tri->UnitOfficeHasQuaternary) == "true")

				    		<i class="ui green large checkmark icon"></i>

				    	@elseif(strtolower($tri->UnitOfficeHasQuaternary) == "false")

				    		<i class="ui red large remove icon"></i>
				    			

				    	@endif

			    	</center></td>
			    </tr>  

					                               
			   @endforeach 
						    	
		    </tbody>

		</table>
						
	</div>

	<script type="text/javascript">

	$('#m3').attr('class', 'item active');
	$('.ui.dropdown').dropdown();
	var flag = 0;
		
	function resetflag(msg){

		document.getElementById('dualbutton').value = 1;

		$("#myToast").showToast({
			message: msg,
			timeout: 2500
		});
				
	}

	function controlaction() {
		var id = 0;
		var func = document.getElementById('dualbutton').value;

		CRUD(id, func);

	}//function controlaction() {



	function CRUD(id, func){

		var data;

		if(func == 1)
		{
			data = {
				'tername' : document.getElementsByName('terName')[0].value,
				'hasquart' : $('#hasQuart').is(":checked"),  
				'office2' : $('#office2').val(),
				'desc' : document.getElementsByName('desc')[0].value,
				'submit': document.getElementsByName("submit")[0].value,
				'callId' : 1,
				'_token' : '{{ Session::token() }}'
				};
				
				exec(data, func);
		}//add

		

		if(func == 3)
		{

			data = {
				'id' : document.getElementById('ID').value,
				'tername' : document.getElementsByName('terName')[0].value,
				'hasquart' : $('#hasQuart').is(":checked"), 
				'office2' : $('#office2').val(),
				'desc' : document.getElementsByName('desc')[0].value,
				'submit': document.getElementsByName("submit")[0].value,
				'callId' : 3,
				'_token' : '{{ Session::token() }}'
				};
				console.log(data);
				exec(data, func);

		
	  }//if(func == 3)
		
   }//end of CRUD

	function exec(data, func) {
		$.ajax({

			type: "POST",
			url: "{{url('maintenancetable/PO3CRUD')}}",
			data: data,
			dataype: "JSON",
			success:function(data){
				if(  func == 1 || func == 3){ 
					
					if(func == 1) {
						msg = "Saved!";
					} else {
						msg = "Updated!";
					}//if(func == 1) {

					resetflag(msg);
					setTimeout(function(){
						location.reload();
					}, 2600);

				}//if func
				else {
					$('#' + data['id']).attr('class', 'activerow');
					$('tr').not("[id = '" + data['id'] + "']").attr('class', 'trow');

					document.getElementById('ID').value = data['id'];
					document.getElementsByName('terName')[0].value = data['UnitOfficeTertiaryName'];
					document.getElementsByName('hasQuart')[0].value = data['UnitOfficeHasQuaternary'];
					document.getElementsByName('desc')[0].value = data['desc'];

					document.getElementById('office2').value = data['UnitOfficeSecondaryID'];
				}
			} 

		});
	}//function exec() {

	function Select_Office(id){
			$("#office2 option").not("[value='disitem']").remove();

			$('#office2').dropdown('restore defaults');

			var data = {
				'id' : id,
				'callid' : 1,
				'_token' : '{{ Session::token() }}' 
			};			

		
			$.ajax({
				type: "POST",
				url: "{{url('maintenance/selOffice')}}",
				data: data,
				dataType: "JSON",
				success:function(data){

					for(var i= 0 ; i < data.length; i++){
						populatedropdown(data[i]['id'], 'select_office2', data[i]['UnitOfficeSecondaryName']);
					}//for
				} //success : function
			});//ajax

		}//end
 
		function loaddata(id) {

			$('#' + id).attr('class', 'activerow');
			$('tr').not("[id = '" + id + "']").attr('class', 'trow');

			var data = {
				'id' : id,
				'_token' : '{{ Session::token() }}'
			};
			document.getElementById('dualbutton').value = 3;
			flag = 1;


			$.ajax({
				type: "POST",
				url: "{{url('maintenancetable/retrieveData')}}",
				data: data,
				dataType: "JSON",
			   	success : function(data) {	

			   		document.getElementById('ID').value = data[0]['id'];
			   		document.getElementsByName('terName')[0].value = data[0]['UnitOfficeTertiaryName'];  
			   

					   		if (data[0]['UnitOfficeHasQuaternary'] == 'true')
								{								
							      document.getElementById('hasQuart').checked = true;
								}
							else
								{
							      $('#hasQuart').prop('checked', false);
								}

			   		
			   	//	Select_Office(data[1]['id']); //display secondary office
					$('#office1').dropdown("set selected", data[2]['id']); //office 1
					console.log(document.getElementById('office2').options);
			   	//	$('#office2').dropdown('set selected', data[2]['id']); //office 2

			   		setTimeout(function(){
					    changeValue('#office2',data[1]['id']);
					},2000);

			   		//console.log($( "#office2 option:selected" ).text());
			   	}//success : function() {
			});


		}//function loaddata() 

		function changeValue(dropdownID,value){
 			$('.ui.dropdown').has(dropdownID).dropdown('set selected',value);
		}

		function validate(){

			if(document.getElementById('officE2').options[0].selected == true){

					alert('Select Office');
					return;
				}
		}

		


</script>


@stop

