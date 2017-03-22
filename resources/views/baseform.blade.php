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


		<link href="{{ URL::asset('selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet">
		<script type="text/javascript" src='{{ URL::asset("selectize/js/standalone/selectize.min.js") }}'></script>

	</head>
	<body onload = "init()">
	
		<header class = "banner">
			<div class = "ui relaxed grid">
				<div class = "six wide column">
					<image class = "acname" src="{{URL::asset('objects/Logo/ACName.png')}}"/>
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
						<div class = "nine wide column colheight">
							<select id="searchbox" name="q" placeholder="Search Advisers or category" ></select>
							<!-- 
							<div class="ui icon input big search">
								<i class="search icon"></i>
								<input type="text" placeholder="Search...">
							</div>
							-->

							@if(isset($showcontrol))
								<!--<div class = "ui icon addbtn button medium" 
									onclick = "window.location='{{url('directory/add')}}'" 
									title = "Add AC Member">
									<i class="plus icon topmargin"></i>
									
								</div>-->

								<button type="button" class="ui right labeled icon button">
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
		<script>
		    
				    var root = '{{url("/")}}';
				    $(document).ready(function(){
				   
				    $('#searchbox').selectize({
				        valueField: 'url',
				        labelField: 'fname',
				        searchField: ['fname','mname','lname'],
				        maxOptions: 20,
				        options: [],
				        create: function(input){
				            window.location = "search?sq=" + input;


				        },
				        createOnBlur: false,
				        render: {
				            option_create: function(data, escape) {
				              return '<div class="create">Typing <strong>' + escape(data.input) + '</strong>&hellip;</div>';
				            },
				            option: function(item, escape) {
				                if (item.imagepath == '') {
				                    return '<div><img style="width:30px;height:30px;" src="'+ '{{URL::asset("objects/Logo/InitProfile.png")}}' +'"> ' +escape(item.fname) + " " + escape(item.imagepath)+ " " + escape(item.lname)+'</div>';    
				                }else{
				                    return '<div><img style="width:30px;height:30px;" src="'+ item.imagepath +'"> ' +escape(item.fname) + " " + escape(item.mname)+ " " + escape(item.lname)+'</div>';
				                };
				                
				            }
				        },
				        optgroups: [
				            {value: 'AdvisoryCouncil', label: 'Advisory Council'},
				            {value: 'police', label: 'Police Advisory'}
				        ],
				        optgroupField: 'class',
				        optgroupOrder: ['AdvisoryCouncil','police'],
				        load: function(query, callback) {
				            if (!query.length) return callback();
				            $.ajax({
				                url: 'loadsuggestion',
				                type: 'GET',
				                dataType: 'json',
				                data: {
				                    q: query
				                },
				                error: function() {
				                    callback();
				                },
				                success: function(res) {
				                    callback(res.data);
				                }
				            });
				        },
				        onChange: function(){

				            window.location = this.items[0];
				        }
				    });
				});

				function reset(){
				    $('#searchbox').first().selectize()[0].selectize.setValue('‌​');
				}

		</script>

		<footer class = "footer">
			<center>Advisory Council | 2016</center>
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