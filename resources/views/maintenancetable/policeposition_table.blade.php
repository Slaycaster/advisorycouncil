@extends('module.maintenance')

@section('mfillformsection')
	<form class = "ui form" id = "form" action="javascript:loadCModal()">
							
		<div class = "labelpane">
			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Name</label>
				<span class = "asterisk">*</span>		
			</div>

			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Description</label>	
			</div>
									
								
		</div>
		
		<div class = "fieldpane">
			<input type="hidden" id="ID" value=""/>

			<div class = "twelve wide column bspacing2">
				<div class="ui input field formfield">
					<input type="text" name="positionname" value = "" placeholder="Enter PNP Position e.g. Deputy Director"/>
				</div>
			</div>

			<div class = "twelve wide column bspacing2">
				<div class="field">
					<textarea  id = "description" name = "description" class = "areastyle" rows = "4" placeholder="Type here..."></textarea>
				</div>
			</div>

			<div class = "twelve wide column bspacing2">
				<center><button id="dualbutton"
							name="submit" 
							type="submit"
							class="ui tiny button submit savebtnstyle"
							value = '1'>

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
	<div class = "mtitle">PNP Position</div>

	<div class = "tablecon">
		<table id="datatable" class="ui celled table" cellspacing="0" width="100%">
		    <thead>
		    	<tr>
		            <th><center>Name</center></th>
		            <th><center>Description</center></th> 
		        </tr>	
		    </thead>
					                   
		    <tbody>
		    	@foreach ($positions as $position)
			    	<tr class = "trow" onclick="CRUD({{$position->id}},2)" id = "{{$position->id}}">
			    		<td><center>{{$position->PositionName}}</center></td>
			    		<td><center>{{$position->desc}}</center></td>
			    	</tr>
		    	@endforeach
		    </tbody>

		</table>
						
	</div>

	<script type="text/javascript">
		$('#m7').attr('class', 'item active');

		var flag = 0;

		function resetflag(msg)
		{
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


		function CRUD(id,func)
		{

			
			var data;
			if(func == 1)
			{
				data = {
						'ppname' : document.getElementsByName('positionname')[0].value,
						'ppdesc' : document.getElementsByName('description')[0].value,
						'callId' : 1,
						'submit' : document.getElementsByName('submit')[0].value,
						'_token' : '{{ Session::token()}}'
				  };
					
				exec(data, func);

			}

			if(func == 2)
			{
				data = {
						'id' : id,
						'callId' : 2,
						'_token' : '{{ Session::token()}}'
						};
						   
				document.getElementById('dualbutton').value = 3;
				flag = 1;

				exec(data, func);

			}

			if(func == 3)
			{
				data = {
						'id' : document.getElementById('ID').value,
						'ppname' : document.getElementsByName('positionname')[0].value,
						'ppdesc' : document.getElementsByName('description')[0].value,
						'callId' : 3,
						'submit' : document.getElementsByName('submit')[0].value,
						'_token' : '{{ Session::token()}}'
					   };
				exec(data, func);

			}

		}

		function exec(data, func) {
			$.ajax({

					type: "POST",
					url : "{{url('maintenance/policepositioncrud')}}",
					data: data,
					datatype : "JSON",
					success: function(data){

						if( func == 1 || func == 3)
						{
							if(func == 1) {
								msg = "Saved!";
							} else if(func == 3) {
								msg = "Updated!";
							}//if(func == 1) {

							resetflag(msg);
							setTimeout(function(){
								location.reload();
							}, 2600);
						}

						else
						{
							$('#' + data['ID']).attr('class', 'activerow');
							$('tr').not("[id = '" + data['ID'] + "']").attr('class', 'trow');;

							document.getElementById('ID').value = data['id'];
							document.getElementsByName('positionname')[0].value = data['PositionName'];
							document.getElementsByName('description')[0].value = data['desc'];
							
							console.log(data);
						}

					}

				});
		}//

	</script>

@stop