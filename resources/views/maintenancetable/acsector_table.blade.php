@extends('module.maintenance')

@section('mfillformsection')
	<form class = "ui form" id = "form" action="javascript:loadCModal()">	
					
		<div class = "labelpane">

			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Name
					<span class = "asterisk">*</span>
				</label>
			</div>

			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Description
				</label>
			</div>
													
								
		</div>

						
		<div class = "fieldpane">
			<input name="acsectorID" id="acsectorID" type="hidden" value="">					

			<div class = "twelve wide column bspacing2">
				<div class="ui input field formfield">
					<input type="text" name="acsectorName"  id="acsectorName" placeholder="Enter AC Sector Name e.g. LGU">
				</div>
			</div>

			<div class = "twelve wide column bspacing2">
				<div class="field">
					<textarea id="Desc" name = "Desc" class = "areastyle" rows = "4" placeholder="Type here..."></textarea>
				</div>
			</div>												

			<div class = "twelve wide column bspacing2">
				<center>
					<button class="ui tiny button submit savebtnstyle"
							id="dualbutton"
							type="submit"
							name="submit" 
							value = '1'>
									
							Save
					</button>

					<button class="ui tiny button"  
							type="button" onclick = "$('#cancelmodal').modal('show');" >
							Cancel
					</button>					
				</center>
			</div>								
		</div>
								
	</form>

@endsection

@section('mtablesection')
	<div class = "mtitle">Advisory Council Sector</div>

	<div class = "tablecon">
		<table id="datatable" class="ui celled table" cellspacing="0" width="100%">
		    <thead>
		    	<tr>
		            <th><center>Name</center></th>
		            <th><center>Description</center></th> 
		        </tr>	
		    </thead>
				                   
		    <tbody>
			    @foreach ($sector as $sec) 
			       	<tr class = "trow" onclick = "CRUD({{$sec->ID}},2)" id = "{{$sec->ID}}">
			    		<td><center>{{$sec->sectorname}}</center></td>
			    		<td><center>{{$sec->desc}}</center></td>
			    	</tr>  
					                               
			   @endforeach 
		    </tbody>
		</table>						
	</div>

<script type="text/javascript">
	$('#m6').attr('class', 'item active');
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
				'secname' : document.getElementsByName('acsectorName')[0].value,
				'secdesc' : document.getElementsByName('Desc')[0].value,
				'submit': document.getElementsByName("submit")[0].value,
				'callId' : 1,
				'_token' : '{{ Session::token() }}'
				};

			exec(data, func);
		}//add

		if(func == 2)
		{
			data = {
			'id' : id,
			'callId' : 2,
			'_token' : '{{ Session::token() }}'};
			document.getElementById('dualbutton').value = 3;
			flag = 1;

			exec(data, func);
			

		}//view

		if(func == 3)
		{
			data = {
				'id' : document.getElementById('acsectorID').value,
				'secname' : document.getElementsByName('acsectorName')[0].value,
				'secdesc' : document.getElementsByName('Desc')[0].value,
				'submit': document.getElementsByName("submit")[0].value,
				'callId' : 3,
				'_token' : '{{ Session::token() }}'
				};

			exec(data, func);

		}//update

			
	}

	function exec(data, func) {
		$.ajax({

			type: "POST",
			url: "{{url('maintenancetable/acsectorCRUD')}}",
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
					$('#' + data['ID']).attr('class', 'activerow');
					$('tr').not("[id = '" + data['ID'] + "']").attr('class', 'trow');

					document.getElementById('acsectorID').value = data['ID'];
					document.getElementsByName('acsectorName')[0].value = data['sectorname'];
					document.getElementsByName('Desc')[0].value = data['desc'];
				}
			} 

		});
	}//function exec() {

</script>
	
@stop