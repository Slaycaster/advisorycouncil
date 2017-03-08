<!DOCTYPE html>

<html>
	<head>
		<title>PNP Advisory Council</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=yes">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="shortcut icon" type="image/png" href="{{URL::asset('images/Philippine-National-Police.png')}}"> <!--LOGO-->

		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/semantic.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/stylev1.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/icon.css')}}">

		<!-- JS -->
		<script type="text/javascript" src="{{ URL::asset('js/jquery-2.1.4.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/semantic.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/initialization.js') }}"></script>
	</head>

	<body onload = "init()" class = "phbdy">
		<header class = "banner1">
			<div class = "ui relaxed grid">
				<div class = "six wide column" onclick="window.location='{{url('/')}}'">
					<image class = "acname1" src="{{URL::asset('objects/Logo/ACName2.png')}}"/>
				</div>		
			</div>
				
		</header>

		<div class = "mainbody">
			
			@yield('publicpagesection')
			
		</div>

	</body>

</html>