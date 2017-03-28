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
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/res.css')}}">
<<<<<<< HEAD
		<link rel="stylesheet" type="text/css" media="only screen and (max-width: 767px) , only screen and (max-device-width: 767px)" href="{{ URL::asset('css/mobileDevice.css')}}" />
		<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px), only screen and  (min-device-width: 768px) and (max-device-width: 991px)" href="{{ URL::asset('css/tabletDevice.css')}}" />
		<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px), only screen and (min-device-width: 992px) and (max-device-width: 1199px)" href="{{ URL::asset('css/computerMonitor.css')}}" />
		<link rel="stylesheet" type="text/css" media="only screen and (max-width: 1920px) , only screen and (max-device-width: 1920px)" href="{{ URL::asset('css/wideScreenMonitor.css')}}" />
		<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px) and (max-width: 1919px) , only screen and and (min-device-width: 1200px) and (max-device-width: 1919px)" href="{{ URL::asset('css/largeMonitor.css')}}" />
=======
>>>>>>> ae598b1c120f31b6495691fb4aea8aa599a76c25

		<!-- JS -->
		<script type="text/javascript" src="{{ URL::asset('js/jquery-2.1.4.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/semantic.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/initialization.js') }}"></script>

		<!--Smart Search-->
		<link href="{{ URL::asset('selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet">
		<script type="text/javascript" src='{{ URL::asset("selectize/js/standalone/selectize.min.js") }}'></script>
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