@extends('baseform')

@section('maincontent')
	
	<br>
	<br>

	<div class = "ui white raised very padded text container segment">
		<div class="ui container">
			<div class = "loghead2">
				<i class = "large write square icon"></i>
					&nbsp;
					Edit Account

				<hr class = "hr2">
			</div>

			<form id = "form" method="POST" class = "ui form">
				<input type="hidden" name="_token" id="csrf-token" value="{{Session::token()}}" type="text">
				<input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}" type="text">

												
					<div class = "logcontent">

						<span class ="message" name="message"></span>
						<br>
						<span class ="message" name="message"></span>

						<div class ="twelve wide column  bspacing8">
							<div id = "fncon" class="ui input field logfield2">
								<input type="text" value = "{{Auth::user()->name}}" onchange = "validatefullname()" name = "fullname" placeholder="Full Name e.g. FN MI LN EXT (Required)">
							</div>
												
						</div>

						<div class ="twelve wide column  bspacing8">
							<div id = "ucon" class="ui input field logfield2">
								<input onchange = "checknewusername()" value= "{{Auth::user()->email}}" type="text" name = "username" placeholder="Username (Required)">
							</div>
												
						</div>

						<div class ="twelve wide column  bspacing8">
							<div id = "oldpasscon" class="ui input field logfield2">
								<input id = "oldpass" type="password" name = "oldpassword" onchange = "checkoldpass()" placeholder="Old Password (Required)">
							</div>
														
						</div>

						<div class ="twelve wide column  bspacing8">
							<div id = "passcon1" class="ui input field logfield2 disabled">
								<input id = "pass1" type="password" name = "password" onchange = "validatepass()" placeholder="New Password (Required)">
							</div>
														
						</div>

						<div class ="twelve wide column  bspacing8">
							<div id = "passcon2" class="ui input field logfield2 disabled">
								<input id = "pass2" type="password" onchange = "validatepass()" placeholder="Retype New Password (Required)">
							</div>
														
						</div>

						<br>
						<br>

						<div class ="ten wide column  bspacing8">
							<center>

								<button type="button" onclick = "checkinput()" name="submit" 
										class="ui large button submit savebtnstyle">

									Save
								</button>
								<button type="button" onclick = "$('#cancelmodal').modal('show');" 
										class="ui large button">
									Cancel
								</button>
							</center>
						</div>


														
					</div>
			</form>
		</div>

		<div class="ui basic modal" id = "confirmmodal">
			<div class="ui icon header">
				<i class="help circle icon"></i>
		    		<div name = "modalmessage">Edit Account?</div>
			</div>
			
			<div class="actions">
		    	<div class="ui basic cancel inverted button">
		      			No
		   		</div>
		    	<div onclick = "edituser()" class="ui basic ok inverted button">
		      		Yes
		    	</div>
		  	</div>
		</div>

		<div class="ui basic modal" id = "cancelmodal">
			<div class="ui icon header">
				<i class="help circle icon"></i>
		    		<div name = "modalmessage">Cancel?</div>
			</div>
			
			<div class="actions">
		    	<div class="ui basic cancel inverted button">
		      			No
		   		</div>
		    	<div onclick = "loadtoast('Cancelled!'); window.location='{{url('admin')}}" class="ui basic ok inverted button">
		      		Yes
		    	</div>
		  	</div>
		</div>

	</div>

	<br>
	<br>

	@include('admin.admin_script')

	<script type="text/javascript">
		checkpass = 0;
		checkuname = 0;
		checkfullname = 0;

		$('#tab4').attr('class', 'mlink2 item active');

		function loadCModal() {
			$('#confirmmodal').modal('show');
		}//function loadModal() {

		function loadtoast(msg) {

			$("#myToast").showToast({
				message: msg,
				timeout: 2500
			});

		}//function resetflag() {

		function checknewusername() {
			var regex = new RegExp('^(?=.*(\\d|\\w))[A-Za-z0-9 -_]{6,18}$');
			var username = $("input[name='username']").val();

			if(username !== "" && regex.test(username)) {

				var data = { 
						'id' : document.getElementsByName('userid')[0].value,
						'username' : username.trim(),
						'_token' : '{{ Session::token() }}'
					};

		 		$.ajax({
					type: "POST",
					url: "{{url('checknewusername')}}",
					data: data,
				   	dataType: "JSON",
		  		   	success : function(result) {
		  		   		
				   		if(result == 0) {
				   			//$('#ucon').attr('class', 'ui input field field logfield2');
				   			document.getElementById('ucon').classList.remove('error');
							document.getElementsByName('message')[0].innerHTML = "";
							checkuname = 0;
				   		} else {
				   			//$('#ucon').attr('class', 'ui input field field error logfield2');
				   			document.getElementById('ucon').classList.add('error');

							document.getElementsByName('message')[0].innerHTML = "USERNAME ALREADY EXISTS";
							checkuname = 1;
				   		}//if

				   		//console.log(result);
				   	},
					error:function() {
						$('#errormodal').modal('show');
					} 
				});
	 		} else {
	 			document.getElementById('ucon').classList.add('error');
	 			checkuname = 1;
	 		}//if

		}//function checkusername() {

		function checkoldpass() {
			var oldpass = $("input[name='oldpassword']").val();

			if(oldpass !== "") {

				var data = { 
						'id' : document.getElementsByName('userid')[0].value,
						'password' : oldpass,
						'_token' : '{{ Session::token() }}'
					};

		 		$.ajax({
					type: "POST",
					url: "{{url('checkoldpassword')}}",
					data: data,
				   	dataType: "JSON",
		  		   	success : function(result) {
		  		   		
				   		if(result != 0) {
				   			document.getElementById('oldpasscon').classList.remove('error');
							document.getElementsByName('message')[1].innerHTML = "";

							$("#passcon1").removeClass('disabled');
							$("#passcon2").removeClass('disabled');



				   		} else {
				   			document.getElementById('oldpasscon').classList.add('error');

							document.getElementsByName('message')[1].innerHTML = "WRONG PASSWORD";

							$("#passcon1").addClass('disabled');
							$("#passcon2").addClass('disabled');
				   		}//if

				   		console.log(result);
				   	},
					error:function() {
						$('#errormodal').modal('show');
					} 
				});
	 		}//if
		}//checkoldpass

		function edituser() {
			var data = {
				'id' : document.getElementsByName('userid')[0].value,
				'fullname' : document.getElementsByName('fullname')[0].value.trim(),
				'username' : document.getElementsByName('username')[0].value.trim(),
				'password' : document.getElementsByName('password')[0].value,
				'_token' : '{{ Session::token() }}'

			};

			$.ajax({

				type: "POST",
				url: "{{url('edituser')}}",
				data: data,
				success:function(data){
					loadtoast('Saved');

					setTimeout(function(){
						window.location = "{{url('admin')}}";
					}, 2600);
					
				},
				error:function() {
					$('#errormodal').modal('show');
				} 

			});
			}//edituser

	</script>



@stop