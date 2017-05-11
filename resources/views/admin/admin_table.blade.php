@extends('module.admin')
@section('mfillformsection')
	<form class = "ui form" id = "form">
							
		<div class = "labelpane">


			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Type</label>
				<span class = "asterisk">*</span>				
			</div>

			<div id="templpane">
								
			</div>

			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Full Name</label>
				<span class = "asterisk">*</span>
										
			</div>

			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Username</label>
				<span class = "asterisk">*</span>
										
			</div>

			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Password</label>
				<span class = "asterisk">*</span>
										
			</div>

			<div class = "twelve wide column bspacing">
				<label class = "formlabel">Retype Password</label>
				<span class = "asterisk">*</span>
										
			</div>


		</div>
									
		<input type="hidden" value="" name="categid"/>
		<div class = "fieldpane">

			<div class = "twelve wide column bspacing2">
				<div class="inline fields">
					<div class = "field">
						<div class = "ui radio checkbox">
							<input type="radio" value = '0' onchange="changeinput(this.value)" name = "admintype" checked/>
							<label>Superadmin</label>
							
						</div>
						
					</div>

					<div class = "field">
						<div class = "ui radio checkbox">
							<input type="radio" value = '1' onchange="changeinput(this.value)" name = "admintype"/>
							<label>Admin</label>
							
						</div>
					</div>

					<div class = "field">
						<div class = "ui radio checkbox">
							<input type="radio" value = '2' onchange="changeinput(this.value)" name = "admintype"/>
							<label>Viewer</label>
							
						</div>
					</div>
					

				</div>
			</div>

			<div id="tempddfield">
				
			</div>

			<div class = "twelve wide column bspacing2">
				<div  id = "fncon" class="ui input field formfield">
					<input type="text" onchange = "validatefullname()" name = "fullname" placeholder="e.g. Shiela Mae F. Eugenio">
				</div>
			</div>

			<div class = "twelve wide column bspacing2">
				<div id = "ucon" class="ui input field formfield">
					<input type="text" onchange = "checkusername()" name = "username" placeholder="e.g. bluishlemon (6-20 characters)">
				</div>
			</div>

			<div class = "twelve wide column bspacing2">
				<div id = "passcon1" class="ui input field formfield">
					<input id = "pass1" onchange = "validatepass()" type="password" name = "password" placeholder="e.g. bluishlemon (6-20 characters)">
				</div>
			</div>

			<div class = "twelve wide column bspacing2">
				<div id = "passcon2" class="ui input field formfield">
					<input id = "pass2"  onchange = "validatepass()" type="password" placeholder="Retype Password (Required)">
				</div>
			</div>

			<div class = "twelve wide column bspacing2">
				<center><button type = "button" name="submit"
						onclick="src = 0 ; checkinput()"
						class="ui tiny button submit savebtnstyle">
					Save
				</button>
		
				<button type="button" onclick = "$('#cancelmodal').modal('show');" class="ui tiny button">
					Cancel

				</button></center>
			</div>

			<div class = "twelve wide column bspacing2">
				<span class ="asterisk" name="message"></span>

				<span class ="asterisk" name="message"></span>
				
			</div>

								
		</div>
								
	</form>


@endsection

@section('mtablesection')
	<div class = "mtitle">Registration Request(s)</div>

	<div class = "tablecon rwdAdminTable">
		<table id="datatable" class="ui celled table" cellspacing="0" width="100%">
		    <thead>
		    	<tr>
		            <th><center>Full Name</center></th>
		            <th><center>Username</center></th>
		            <th><center>Type</center></th>
		            <th><center>Status</center></th>
		        </tr>
		    </thead>
					                   
		    <tbody>
		    	@foreach($users as $result)

		    		<!-- @if($result->status == 1) -->
		    			<tr class = "trow" onmouseover = "showpopup(this.rowIndex)" onclick = "activaterow(this.rowIndex, {{$result->id}})">
					    
			    	<!-- @else
			    		<tr>

			    	 -->@endif

			    		<td><center>{{$result->name}}</center></td>
			    		<td><center>{{$result->email}}</center></td>
			    		<td><center>
			    			@if($result->status == 0 || $result->status == 2)
					    		N/A


			    			@elseif($result->status == 1)
					    		

			    				@if($result->admintype == 0)

			    					Superadmin
			    				@elseif($result->admintype == 1)
			    					Admin
			    				@else
			    					Viewer
			    				@endif


			    			@endif
			    		</center></td>
			    		<td><center>
			    			@if($result->status == 0)
					    		<i class="ui yellow large wait icon"></i>

u
			    			@elseif($result->status == 1)
					    		<i class="ui green large checkmark icon"></i>

			    			@elseif($result->status == 2)
					    		<i class="ui red large remove icon"></i>


			    			@endif




			    		</center></td>
		    		</tr>




		    	@endforeach

		    </tbody>
		</table>						
	</div>

	<script type="text/javascript" src="{{ URL::asset('js/formcontrol.js') }}"></script>

	<script type="text/javascript">
		var src = 0;

		function loadtoast(msg) {
			$("#myToast").showToast({
				message: msg,
				timeout: 2500
			});

		}//loadtoast

		function addUser() {
			var admintype = $("input[name='admintype']:checked").val();

			if(admintype == 0)
			{
				var data = {
					'fullname' : document.getElementsByName('fullname')[0].value,
					'username' : document.getElementsByName('username')[0].value,
					'status' : 1,
					'admintype' : admintype,
					'password' : document.getElementsByName('password')[0].value,
					'source' : 0,
					'_token' : '{{ Session::token() }}'
				};

			}
			else if (admintype == 1 || admintype == 2)
			{
				var data = {
					'fullname' : document.getElementsByName('fullname')[0].value,
					'username' : document.getElementsByName('username')[0].value,
					'status' : 1,
					'admintype' : admintype,
					'password' : document.getElementsByName('password')[0].value,
					'primary' : document.getElementById('primary').value,
					'secondary' : document.getElementById('secondary').value,
					'tertiary' : document.getElementById('tertiary').value,
					'quaternary' : document.getElementById('quaternary').value,
					'source' : 0,
					'_token' : '{{ Session::token() }}'
				};
				
			}

			$.ajax({
				type: "POST",
				url: "{{url('adduser')}}",
				data: data,
				datatype: "JSON",
			   	success : function(data) {

			   		console.log(data);

					loadtoast('Saved');
					
					setTimeout(function(){
						location.reload();
					}, 2600);
			   		
			   	}
				// error:function() {
				// 	$('#errormodal').modal('show');
				// } 
			});

		}//function addUser() {\

		function showpopup(slctrow) {
			$("#datatable tr:eq("+slctrow+")").attr('id', 'activate');
			$("#datatable tr").not(document.getElementById('datatable').getElementsByTagName('tr')[slctrow]).removeAttr('id');

			$('#activate')
	  		.popup({
			    on: 'click',
			    popup : $('.ui.popup'),
			    position: 'bottom right'
			  });
		}//function showpopup(slctrow) {

		function populatepopup(id) {
			var data = { 
					'id' : id,
					'_token' : '{{ Session::token() }}'
				};

	 		$.ajax({
				type: "POST",
				url: "{{url('getuser')}}",
				data: data,
			   	dataType: "JSON",
	  		   	success : function(userdata) {
	  		   		console.log(userdata);
	  		   		document.getElementsByName('namelabel')[0].innerHTML = userdata['name'] + " (" + userdata['email'] + ")";
	  		   		document.getElementsByName('appid')[0].value = id;

	  		   	},
				error:function() {
					$('#errormodal').modal('show');
				} 
	  		});
		}//function populatepopup(id) {

		function activaterow(slctrow, id) {
			$(".activerow").attr('class', 'trow');
			$("#datatable tr:eq("+slctrow+")").attr('class', 'activerow');

			populatepopup(id);
		}//function activaterow(slctrow) {

		function setstatus(stat) {
			var admintype = "";
			var message;
			

			if(stat == 1) {
				admintype = $("input[name='appadmintype']:checked").val();
				message = "Account Approved";
			} else {
				message = "Account Denied";

			}//if(stat == 1) {

			var data = { 
				'id' : document.getElementsByName('appid')[0].value,
				'admintype' : admintype,
				'status': stat,
				'_token' : '{{ Session::token() }}'
			};

			$.ajax({
				type: "POST",
				url: "{{url('approval')}}",
				data: data,
			   	success : function() {
					loadtoast(message);
					setTimeout(function(){
						location.reload();
					}, 2600);
			   		
			   	},
				error:function() {
					$('#errormodal').modal('show');
				} 
			});

			
		}//function setstatus(stat) {


		function changeinput(choice)
		{
			document.getElementById("templpane").innerHTML = "";
			document.getElementById("tempddfield").innerHTML = "";

			if(choice == 1 || choice == 2){
				adddropdown();
				getprioffice();
			}							
		}//changeinput 

		function getprioffice()
		{
			$.ajax({
				type: "GET",
				url: "{{url('dropdown/getprioffice')}}",
				dataType: 'json',
			   	success : function(data) {

			   		$("select[name='primary'] option").not("[value='disitem']").remove();

			   		for (var ctr = 0 ; ctr < data.length ; ctr++) {
			   			populatedropdown(data[ctr]['id'], 'primary', data[ctr]['UnitOfficeName']);
			   			
			   		};

			   	},
				error:function() {
					$('#errormodal').modal('show');
				} 
			});
		}

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
			   			populatedropdown(secoffice[ctr]['id'], 'secondary', secoffice[ctr]['UnitOfficeSecondaryName']);
			   			
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
			   			populatedropdown(teroffice[ctr]['id'], 'tertiary', teroffice[ctr]['UnitOfficeTertiaryName']);
			   			
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
			   			populatedropdown(quaroffice[ctr]['id'], 'quaternary', quaroffice[ctr]['UnitOfficeQuaternaryName']);
			   			
			   		};

			   		
			   	},
				error:function() {
					$('#errormodal').modal('show');
				} 
			});
		}//function getquaroffice() {


	</script>

@stop