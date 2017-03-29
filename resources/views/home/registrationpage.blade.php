@extends('baseformv2')

@section('publicpagesection')
	
	<br>
	<br>
	<br>
	<link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">

	<div class = "ui white raised very padded text container segment">
		<div class="ui container">
			<div class = "loghead2">
				<i class = "small add user icon round"></i>
					 Sign up

				<hr class = "hr2">
			</div>

			<form id = "form" method="POST" class = "ui form">
				<input type="hidden" name="_token" id="csrf-token" value="{{Session::token()}}" type="text">
												
					<div class = "logcontent">

						<span class ="message" name="message"></span>
						<br>
						<span class ="message" name="message"></span>

						<div class ="twelve wide column  bspacing8">
							<div id = "fncon" class="ui input field logfield2">
								<input type="text" onchange = "validatefullname()" name = "fullname" placeholder="Full Name e.g. FN MI LN EXT (Required)">
							</div>
												
						</div>

						<div class ="twelve wide column  bspacing8">
							<div id = "ucon" class="ui input field logfield2">
								<input onchange = "checkusername()" type="text" name = "username" placeholder="Username (Required)">
							</div>
												
						</div>

						<div class ="twelve wide column  bspacing8">
							<div id = "passcon1" class="ui input field logfield2">
								<input id = "pass1" type="password" name = "password" onchange = "validatepass()" placeholder="Password (Required)">
							</div>
														
						</div>

						<div class ="twelve wide column  bspacing8">
							<div id = "passcon2" class="ui input field logfield2">
								<input id = "pass2" type="password" onchange = "validatepass()" placeholder="Retype Password (Required)">
							</div>
														
						</div>

						<br>
						<br>
						<div class ="ten wide column  bspacing8">
							<center>{!! captcha_image_html('ExampleCaptcha') !!}
							</center>
							<center>
							<div class="ui input field">
								<input type="text" style="width:15%;" id="CaptchaCode" placeholder="Enter Code" maxlength="4" name="CaptchaCode">
							</div>
							</center>
						</div>
						<div class ="ten wide column  bspacing8">
							<center><button type="button" onclick = "checkinput()" name="submit" class="ui big button">
								Sign up
							</button></center>
						</div>


														
					</div>
			</form>
		</div>

		<div class="ui basic modal" id = "confirmmodal">
			<div class="ui icon header">
				<i class="help circle icon"></i>
		    		<div name = "modalmessage">Proceed?</div>
			</div>
			
			<div class="actions">
		    	<div class="ui basic cancel inverted button">
		      			No
		   		</div>
		    	<div onclick = "registeruser()" class="ui basic ok inverted button">
		      		Yes
		    	</div>
		  	</div>
		</div>

		<div class="ui basic modal" id = "completemodal">
			<div class="ui icon header">
				<i class="help circle icon"></i>
		    	<div name = "modalmessage">Registration Complete</div>
			</div>

			<div class = "content">
				<p><center>Thanks for joining! Please wait for the confirmation.</center></p>
			</div>
			
			<div class="actions">
		    	<div onclick = "window.location= '{{url('login')}}'" class="ui basic ok inverted button">
		      		OK
		    	</div>
		  	</div>
		</div>

		<div class="ui basic modal" id = "errormodal">
			<div class="ui icon header">
				<i class="help circle icon"></i>
			   		<div name = "modalmessage">Sorry! Something went wrong. <br>
			   		Please try again later.</div>
			</div>
				
			<div class="actions">
			   	<div onclick = "location.reload();" class="ui basic ok inverted button">
			   		OK
			   	</div>
		 	</div>
		</div>


	</div>

	<script type="text/javascript">
		function loadCModal() {
			$('#confirmmodal').modal('show');
		}//function loadModal() {

		function reloadImageCaptcha(){
			$.ajax({
				url: "reloadImageCaptcha",
				type: 'get',
				  dataType: 'html',        
				  success: function(json) {
				    $('#ExampleCaptcha_CaptchaDiv').html(json);
				  },
				  error: function(data) {
				    //document.getElementsByName('message')[0].innerHTML = document.getElementsByName('message')[0].innerHTML + "<br>Try Manual Reloading";
					$('#errormodal').modal('show');
				  	
				  }
				});
		}	

		function registeruser() {
			
			$.ajax({
				type: "POST",
				url: "{{url('register')}}",
				data: $('form').serialize(),
			   	success : function(response) {
					if (response == 0) {
						document.getElementsByName('message')[0].innerHTML = "Registration Failed! Verification Code do not match!";
						reloadImageCaptcha();
					}else if (response == 1) {
						$('#completemodal').modal('show');
					}else{
						document.getElementsByName('message')[0].innerHTML = "Username Already Exist!";
					}
					
			   		
			   	},
				error:function() {
					$('#errormodal').modal('show');
				} 
			});


		}//function registeruser() {
	</script>


@include('admin.admin_script')

@stop