<script type="text/javascript">
	var checkuname = 1;
	var checkpass = 1;
	var checkfullname = 1;

	function checkinput() {
		if(checkuname == 0  && checkpass == 0 && checkfullname == 0) {

			//submit form
			loadCModal();
		}//if

	}//function checkinput() {

	function validatefullname() {
		var regex = new RegExp("^(?=.*(\\d|\\w))[A-Za-z0-9 -'.,]{3,50}$");
		var fullname = document.getElementsByName('fullname')[0].value;
		console.log(regex.test(fullname));

		if(fullname !== "" && regex.test(fullname)) {
			checkfullname = 0;
			document.getElementById('fncon').classList.remove('error');

		} else {
			checkfullname = 1;
			document.getElementById('fncon').classList.add('error');


		}//if
	}//function validatefullname() {

	function validatepass() {
		var pass1 = $('#pass1').val();
		var pass2 = $('#pass2').val();
		var regex = new RegExp("^(?=.*(\\d|\\w))[A-Za-z0-9 _-]{6,18}$");

		if(pass1 != "" && regex.test(pass1)) {
			if(pass2 !== "") {
				if(pass1 !== pass2) {
					//$('#passcon1').attr('class', 'ui input field error logfield2');
					//$('#passcon2').attr('class', 'ui input field error logfield2');
			   		document.getElementById('passcon1').classList.add('error');
			   		document.getElementById('passcon2').classList.add('error');

					document.getElementsByName('message')[1].innerHTML = "PASSWORDS DO NOT MATCH";

					checkpass = 1;

				} else if (pass1 === pass2){
					//$('#passcon1').attr('class', 'ui input field logfield2');
					//$('#passcon2').attr('class', 'ui input field logfield2');

					document.getElementById('passcon1').classList.remove('error');
			   		document.getElementById('passcon2').classList.remove('error');
					document.getElementsByName('message')[1].innerHTML = "";

					checkpass = 0;

				}//if(pass1 ==! pass2) {
			}//if
		} else {
			document.getElementById('passcon1').classList.add('error');
			checkpass = 1;
		}//if
	}//function validatepass() {

	function checkusername() {
		var regex = new RegExp('^(?=.*(\\d|\\w))[A-Za-z0-9 -_]{6,18}$');
		var username = $("input[name='username']").val();

		if(username !== "" && regex.test(username)) {

			var data = { 
					'username' : username,
					'_token' : '{{ Session::token() }}'
				};
	 		$.ajax({
				type: "POST",
				url: "{{url('checkusername')}}",
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
			   	}//success : function() {
			});
 		} else {
 			document.getElementById('ucon').classList.add('error');
 			checkuname = 1;
 		}//if

	}//function checkusername() {
</script>