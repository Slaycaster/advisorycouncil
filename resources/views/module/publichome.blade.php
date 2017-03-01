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
							<div class="ui icon input big search2">
								<i class="search icon"></i>
								<input type="text" placeholder="Search...">
							</div>
						</div>
							
					</div>

					<div class = "hcontent">
					
						@yield('phomesection')
					</div>
				</div>
						
			</div>
					
		</div>
				
	</div>




@stop