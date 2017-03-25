@extends('baseformv2')

@section('publicpagesection')

	<div class = "ui grid">
		<div class = "row">
			<div class = "four wide column">
				<div class = "ui segment logcon" id="summary">
					<div class = "ui rail">
						<div class = "ui sticky">
							<div class="ui container">
								<div class = "loghead">
									<i class = "inverted circular user icon"></i>
										Sign in

									<hr class = "hr1">
								</div>
		
								<form action="{{url('validatelogin')}}" method="POST" class = "ui form">
									<input type="hidden" name="_token" id="csrf-token" value="{{Session::token()}}" type="text">
										
									<div class = "logcontent">

										<div class ="twelve wide column  bspacing8">
											<div class="ui input logfield">
												<input type="text" name = "username" placeholder="Username">
											</div>
											
										</div>

										<div class ="twelve wide column  bspacing8">
											<div class="ui input logfield">
												<input type="password" name = "password" placeholder="Password">
											</div>
												
										</div>

										<div class ="ten wide column  bspacing8 centerbtn">
											<button type="submit" name="submit" class="ui medium button">
												Sign in
											</button>
										</div>


												
									</div>
								</form>
												
							</div>
									
						</div>
								
					</div>
										
				</div>
						
			</div>

			<div class = "twelve wide column">
				<div class = "ui segment rightpane">
					<div class = "row">
						<div class = "nine wide column colheight">
							<!--
							<div class="ui icon input big search2 search">
								<i class="search icon"></i>
								<input type="text" placeholder="Search..."> 
							</div>
							-->
							<select id="searchbox" class="newmargin" name="q" placeholder="Search Stakeholder(s)" ></select>

						</div>
							
					</div>
					

					<div class="row">
						<br>
						<hr class="hr3">
					</div>

					<div class = "hcontent">
					
						@yield('phomesection')
					</div>
				</div>
						
			</div>
					
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

@stop