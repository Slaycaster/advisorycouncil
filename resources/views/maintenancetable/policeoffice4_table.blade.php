@extends('module.maintenance')

@section('mfillformsection')
	<form class = "ui form" id = "form" action="javascript:loadCModal()">
							
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
					<span class = "asterisk">*</span>
				</label>
			</div>

			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Quaternary Office
					<span class = "asterisk">*</span>
				</label>
			</div>

		</div>	

		<input type="hidden" value="" name="ID"/>
		<div class = "fieldpane2">

			<div class = "twelve wide column bspacing2">
				<div class = "field">
					<select onchange="populate(1,this.value)" class="modified ui selection dropdown selectstyle2" name="office" id = "select1">

						<option selected class="disabled" value="disitem" >Select One</option>
						@foreach ( $office as $office )
							<option value="{{$office->id}}">{{$office->UnitOfficeName}}</option>
						@endforeach
									  
					</select>
									
				</div>
								
			</div>

 
			<div class = "twelve wide column bspacing2">
				<div class = "field">
					<select  onchange="populate(2,this.value)" class="modified ui selection dropdown selectstyle2" name="office2" id = "select2">
						<option selected class="
						disabled" value="disitem">Select One</option>
						
					</select>
									
				</div>
								
			</div>

			<div class = "twelve wide column bspacing2">
				<div class = "field">
					<select class="modified ui selection dropdown selectstyle2" name="office3" id = "select3">

						<option selected class="disabled" value="disitem">Select One</option>			 
						
					</select>
									
				</div>
								
			</div>

			<div class = "twelve wide column bspacing2">
				<div class="ui input field formfield">
					<input type="text" id="name" name="name" placeholder="Enter Quaternary Office Name e.g. Bacnotan">
				</div>
			</div>


			<div class = "twelve wide column bspacing2">
				<center><button type = "submit" name="submit" 
								class="ui tiny button submit savebtnstyle">


									Save
								</button>
								<button type = "reset" onclick = "if(confirm('Cancel?')) { resetflag('Cancelled!')}" class="ui tiny button">
									Cancel

								</button></center>
			</div>
		</div>	
								
								
	</form>

@endsection

@section('mtablesection')

	<div class = "mtitle">Quaternary Unit/Office
						
	</div>

	<div class = "tablecon">
		<table id="datatable" class="ui celled table" cellspacing="0" width="100%">
		    <thead>
		    	<tr>
		            <th><center>Primary Office</center></th>
		            <th><center>Secondary Office</center></th>
		            <th><center>Tertiary Office</center></th>
		            <th><center>Quaternary Office</center></th>
						       
				</tr>	
		    </thead>
		    @foreach ($office4 as $offices)
		    	<tr class = "trow" onclick="loaddata({{$offices->id}})" id="{{$offices->id}}">
		    		
		    		<td><center>{{$offices->UnitOfficeName}}</center></td>
		    		<td><center>{{$offices->UnitOfficeSecondaryName}}</center></td>
		    		<td><center>{{$offices->UnitOfficeTertiaryName}}</center></td>
		    		<td><center>{{$offices->UnitOfficeQuaternaryName}}</center></td>
		    		
		    		
		    	</tr>
		    @endforeach                   
		    <tbody>
						    	

		    </tbody>
		</table>
					
	</div>

	<script type="text/javascript">
		$('#m4').attr('class', 'item active');
		$('.ui.dropdown').dropdown();

		var flag = 0;

		function populate(func,id){

			if(func == 1){

				//removeOption(document.getElementById('select2'));
				$("#select2 option").not("[value='disitem']").remove();
				$('#select2').dropdown('restore defaults');

				var data = {
					'id' : id,
					'callid' : 1,
					'_token' : '{{ Session::token() }}' 
				};
			}

			if(func == 2){

				//removeOption(document.getElementById('select3'));
				$("#select3 option").not("[value='disitem']").remove();
				$('#select3').dropdown('restore defaults');

				var data = {
					'id' : id,
					'callid' : 2,
					'_token' : '{{ Session::token() }}' 
				};

				console.log(id);
			}// if func

			
			$.ajax({
				type: "POST",
				url: "{{url('maintenance/populate')}}",
				data: data,
				success:function(data){
					
					if(func == 1){
						for(var i= 0 ; i < data.length; i++){
							populatedropdown(data[i]['id'], 'office2', data[i]['UnitOfficeSecondaryName']);
				
						}//for
					}//populate secondary

					if(func == 2){
						for(var i= 0 ; i < data.length; i++){
							populatedropdown(data[i]['id'], 'office3', data[i]['UnitOfficeTertiaryName']);
						}//for
						
					}//populate tertiary
				} //success : function
			});//ajax

		}//populatetertiary

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
			$('tr').not("[id = '" + id + "']").attr('class', 'trow');

			var data = {
				'id' : id,
				'_token' : '{{ Session::token() }}'
			};

			$.ajax({
				type: "POST",
				url: "{{url('maintenance/policefourview')}}",
				data: data,
				dataType: "JSON",
			   	success : function(data) {

			   		document.getElementsByName('ID')[0].value = data[0]['id'];
			   		document.getElementsByName('name')[0].value = data[0]['UnitOfficeQuaternaryName'];

			   		$('#select1').dropdown("set selected", data[1]['id']); //office 1
			   		
			   		setTimeout(function(){
					    changeValue('#select2',data[2]['id']);
					},2000);
					
					setTimeout(function(){
				   		changeValue('#select3',data[3]['id']);
					},4000);
			   		
			   	}//success : function() {
			});

		}//function loaddata() {

		function changeValue(dropdownID,value){
 			$('.ui.dropdown').has(dropdownID).dropdown('set selected',value);
		}

		function addData() {
			var data = {
				'name' : $('#name').val(),
				'office3' : $('#select3').val(),
				'submit': document.getElementsByName("submit")[0].value,
				'_token' : '{{ Session::token() }}'
			};
			
			$.ajax({
				type: "POST",
				url: "{{url('maintenance/add')}}",
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
				'subID' : document.getElementsByName('ID')[0].value,
				'office3' : $('#select3').val(),
				'name' : document.getElementsByName("name")[0].value,
				'submit': document.getElementsByName("submit")[0].value,
				'_token' : '{{ Session::token() }}'
			};

			$.ajax({
				type: "POST",
				url: "{{url('maintenance/editpolicefour')}}",
				data: data,
			   	success : function() {
			   		resetflag('Updated!');


			   	}//success : function() {
			});


			setTimeout(function(){
				location.reload();
			}, 2600);


		}// edit
	</script>
@stop
