<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<script type="text/javascript" src="{{ URL::asset('js/jquery-2.1.4.js') }}"></script>

	</head>
	<body>
		<img style="width:200px; height:200px; object-fit: cover;" class = "profpic" id = "profpic" src="{{URL::asset('objects/Logo/InitProfile.png')}}">

		<img style="width:200px; height:200px; object-fit: cover;" class = "profpic2" id = "profpic2" src="">

		<span class ="message" id="message">{{session('message')}}</span>

		<input type = "file" onchange = "previewphoto();" accept="image/*" name = "upphoto"/>

		<button onclick = "uploadphoto()">Upload</button>


		<script type="text/javascript">
			function validatefiletype(photo) {
				var upext = photo['type'];
				var upsize = photo['size'];
				var maxsize = 1048576;
				var message = "false";
				var error;
				var validext = ['image/pjpeg', 'image/jpeg', 'image/jpg', 'image/JPEG', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/GIF', 'image/gif'];
				
				
				for (var ctr = 0 ; ctr < validext.length ; ctr++) {
					if(upext == validext[ctr]) {
						message = "true";
						break;
					}//if(data['type'] == validext[ctr]) {
				};


				if(message === "true" && upsize <= maxsize) {
					return message;

				} else if(message === "true" && upsize > maxsize) {
					return "IMAGE TOO LARGE";

				} else {
					return "INVALID FILE TYPE";

				}//if

			}//function validatefiletype() {

			function previewphoto() {

				var upphoto = document.getElementsByName('upphoto')[0].files;
				var result;

				if (upphoto.length == 1) {
					result = validatefiletype(upphoto[0]);

					if( result === "true") {
						var reader = new FileReader();

				        reader.onload = function (e) {
				            document.getElementById('profpic').src = e.target.result;

				        }//reader.onload

			        	reader.readAsDataURL(upphoto[0]);

			        	document.getElementById('message').innerHTML = "";

				    } else {
				    	document.getElementById('message').innerHTML = result;
				    }//if
				}//if

			}//previewphoto

			function uploadphoto() {
				var upphoto = document.getElementsByName('upphoto')[0].files;
				var blob = new Blob(document.getElementsByName('upphoto')[0].files, 
									{type: document.getElementsByName('upphoto')[0].files[0]['type']});

				var blobreader = new FileReader();

				blobreader.onload = function(event){

					var data = {
						'upphoto' : event.target.result,
						'_token' : '{{ Session::token() }}'
					};

					$.ajax({
			            type: 'POST',
			            url: "{{url('testupload')}}",
			            data: data

			            
			        }).done(function(data) {
			           document.getElementById('profpic2').src = data;
			            console.log(data);
			        });

					
       			
       			};     
   
				blobreader.readAsDataURL(blob);

			}//uploadphoto
		</script>

	</body>
</html>