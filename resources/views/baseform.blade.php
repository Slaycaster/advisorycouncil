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
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/wideScreenMonitor.css')}}">	
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/largeMonitor2.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/largeMonitor1.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/largeMonitor.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/computerMonitor.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tabletMonitor.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tabletMonitor1.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mobileMonitor3.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mobileMonitor2.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mobileMonitor2.1.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mobileMonitor1.1s.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mobileMonitor1.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mobileMonitor.css')}}">


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

		<!--Smart Search-->
		<link href="{{ URL::asset('selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet">
		<script type="text/javascript" src='{{ URL::asset("selectize/js/standalone/selectize.min.js") }}'></script>

	</head>
	<body onload = "init({{ Auth::user()->admintype }})">
	
		<header id='banner' class = "banner">
			<div class = "ui grid">
				<div class = "six wide column">
					<image class = "acname" src="{{URL::asset('objects/Logo/ACName.png')}}"/>
				</div>

				<div class = "ten wide column">
					<div class = "ui two row grid colcon">
						<div class = "row rightrow">
							<div class = "ucon">
								<img class="ui avatar image profile" src="{{URL::asset('objects/Logo/InitProfile.png')}}">
									<a class="utitle" href="{{url('user/edit')}}" title="Edit Account">{{ Auth::user()->email }}</a>&nbsp;<a class = "outlink" href="{{url('logout')}}">(LOG OUT)</a>
							</div>
						</div>
							
						<div class = "row rightrow rwdrightrow">
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

									<i class = "inverted circular icon user format"></i>
								</div>
							</div>
								
						</div>
								

					</div>
								
				</div>
							
			</div>
				
		</header>

		<div class = "mainbody">

			<div class = "content1">

				<div class = "ui grid">
					<div class = "row">
						<div class = "nine wide column">
							<select id="searchbox" name="q" placeholder="Search Stakeholder(s)" ></select>

							@if(isset($showcontrol))
								<button type="button" class="ui right labeled icon button"
									onclick = "window.location = '{{url('directory/add')}}'" 
									title = "Add AC Member">
									<i class="plus icon"></i>
									ADD
								</button>
							@endif
						</div>

						
					
						
					</div>

					<div class = "row">
						<hr>
						
					</div>
					
				</div>

				@yield('maincontent')
				
			</div>
			
		</div>

		<div class = "modalcontainer">
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
		
		<footer class = "footer">
			<center>Stakeholder Information System  | 2016</center>
		</footer>
		
	</body>

	<!--<script type="text/javascript">

	/*window.onscroll = function(ev) {
		    if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight) {
		      // you're at the bottom of the page
		      console.log("Bottom of page");
		    }
		};*/
	</script>-->



</html>

@include('home.search_script')