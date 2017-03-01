<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PNP Advisory Council</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, maximum-scale=1,user-scalable=yes">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="shortcut icon" type="image/png" href="{{URL::asset('images/Philippine-National-Police.png')}}"> <!--LOGO-->

		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/semantic.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/stylev1.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/icon.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/toast.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/multipletextinput.css')}}">
		<!--<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/res.css')}}">-->

		<!-- JS -->
		<script type="text/javascript" src="{{ URL::asset('js/jquery-2.1.4.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/semantic.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/initialization.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/toast.js') }}"></script>


		<!--Data Table plugins and design-->
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/datatable/dataTables.semanticui.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/datatable/responsive.semanticui.min.css')}}">

		<script type="text/javascript" src="{{ URL::asset('js/datatable/jquery.dataTables.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/datatable/dataTables.semanticui.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/datatable/dataTables.responsive.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/datatable/responsive.semanticui.min.js') }}"></script>

	</head>
	<body onload = "init()">
		<header class = "banner">
			<div class = "ui relaxed grid">
				<div class = "six wide column">
					<image class = "acname" src="{{URL::asset('objects/Logo/ACName2.png')}}"/>
				</div>

				<div class = "ten wide column">
					<div class = "ui two row grid colcon">
						<div class = "row rightrow">
							<div class = "ucon">
								<img class="ui avatar image profile" src="{{URL::asset('objects/Logo/InitProfile.png')}}">
									<span>{{ Auth::user()->email }} &nbsp</span><a class = "outlink" href="{{url('logout')}}">(LOG OUT)</a>
							</div>
						</div>
							
						<div class = "row rightrow">
							<div class="ui top attached tabular menu">
								<div class="mlink item" id = "tab1" data-tab="home" onclick = "window.location='{{url('home')}}'">
								    Home
								</div>

								@if(Auth::user()->admintype == 0)

									<div class="mlink item" id = "tab2"  data-tab="maintenance" onclick = "window.location='{{url('maintenance')}}'">
								    
								@else
									<div class="mlink disabled item" id = "tab2"  data-tab="maintenance">
									<!--DISABLED-->
								@endif

									Maintenance
								</div>

								<div class="mlink item" id = "tab3" data-tab = "directory" onclick = "window.location='{{url('directory')}}'">
								    Directory
								</div>

								@if(Auth::user()->admintype == 0)
									<div class="mlink2 item" id = "tab4" data-tab = "admin" onclick = "window.location='{{url('admin')}}'">
								   
								@else
									<div class="mlink2 disabled item" id = "tab4" data-tab = "admin">
									<!--DISABLED-->
								@endif

									<i class = "inverted circular icon user"></i>
								</div>
							</div>
								
						</div>
								

					</div>
								
				</div>
							
			</div>
				
		</header>

		<div class = "mainbody">

			<div class = "content1">
				<!--<div class="ui tab" data-tab="home">
				</div>
				<div class="ui tab" data-tab="maintenance">
				</div>
				<div class="ui tab" data-tab="directory">
				</div>

				<div class="ui tab" data-tab="admin">
				</div>-->

				@yield('maincontent')
				
			</div>
			
		</div>

		<footer class = "footer">
			<center>Advisory Council | 2016</center>
		</footer>
		
	</body>
</html>