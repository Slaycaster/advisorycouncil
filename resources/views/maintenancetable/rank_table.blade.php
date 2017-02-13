@extends('module.maintenance')
@section('mfillformsection')
	<form class = "ui form" id = "form" action = "javascript:loadCModal()">
							
		<div class = "labelpane">

			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Code</label>
				<span class = "asterisk">*</span>
										
			</div>

			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Name</label>
				<span class = "asterisk">*</span>
										
			</div>

			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Hierarchy</label>
										
			</div>
		</div>
									
		<input type="hidden" value="" name="rankid"/>
		<div class = "fieldpane">

			<div class = "twelve wide column bspacing2">
				<div class="ui input field formfield">
					<input type="text" name = "rankcode" placeholder="e.g. SPO1">
				</div>
			</div>

			<div class = "twelve wide column bspacing2">
				<div class="ui input field formfield">
					<input type="text" name = "rankname" placeholder="e.g. Senior Police Officer 1">
				</div>
			</div>

			<!--<div class = "twelve wide column bspacing2">
				<div class="field">
					<textarea  name = "description" class = "areastyle" rows = "4" placeholder="Type here..."></textarea>
				</div>
			</div>-->

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
	<div class = "mtitle">Rank</div>

	<div class = "tablecon">
		<table id="datatable" class="ui celled table" cellspacing="0" width="100%">
		    <thead>
		    	<tr>
		            <th><center>Code</center></th>
		            <th><center>Name</center></th>
		            <th><center>Hierarchy</center></th>
		        </tr>	
		    </thead>
					                   
		    <tbody>

		    </tbody>
		</table>						
	</div>

	<script type="text/javascript">

		$('#m10').attr('class', 'item active');
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
			$('tr').not("[id = '" + id + "']").attr('class', 'trow');

			var data = {
				'id' : id,
				'_token' : '{{ Session::token() }}'
			};

			$.ajax({
				type: "POST",
				url: "",
				data: data,
			   	dataType: "JSON",
			   	success : function(data) {

			   		document.getElementsByName('rankid')[0].value = data['id'];
			   		document.getElementsByName('rankcode')[0].value = data['RankCode'];
			   		document.getElementsByName('rankname')[0].value = data['RankName'];

			   	}//success : function() {
			});


		}//function loaddata() {

		function addData() {
			var data = {
				'code' : document.getElementsByName("rankcode")[0].value,
				'name' : document.getElementsByName("rankname")[0].value,
				'submit': document.getElementsByName("submit")[0].value,
				'_token' : '{{ Session::token() }}'
			};

			$.ajax({
				type: "POST",
				url: "{{url('')}}", //insert url
				data: data,
			   	success : function(msg) {
			   		resetflag('Saved!');
			   	}
			});

			setTimeout(function(){
				location.reload();
			}, 2600);

		}//function addData(){

		function editData() {
			var data = {
				'rankid' : document.getElementsByName('rankid')[0].value,
				'code' : document.getElementsByName("rankcode")[0].value,
				'name' : document.getElementsByName("rankname")[0].value,
				'submit': document.getElementsByName("submit")[0].value,
				'_token' : '{{ Session::token() }}'
			};

			$.ajax({
				type: "POST",
				url: "{{url('')}}", //insert url
				data: data,
			   	success : function() {
			   		resetflag("Updated!");
			   	}//success : function() {
			});

			setTimeout(function(){
				location.reload();
			}, 2600);


		}//function editData() {
	</script>

@stop