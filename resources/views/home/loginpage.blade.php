@extends('baseformv2')

@section('publicpagesection')


	<br>
	<br>
	<br>
	<div class = "ui white raised very padded text container segment">
		<div class="ui container">
			<div class = "loghead2">
				<i class = "inverted circular user icon"></i>
					Sign in

				<hr class = "hr2">
			</div>

			<form action="{{url('validatelogin')}}" method="POST" class = "ui form">
				<input type="hidden" name="_token" id="csrf-token" value="{{Session::token()}}" type="text">
												
					<div class = "logcontent">

						<span class ="message" id="message">{{session('message')}}</span>

						<div class ="twelve wide column  bspacing8">
							<div class="ui input logfield2">
								<input type="text" name = "username" placeholder="Username">
							</div>
												
						</div>

						<div class ="twelve wide column  bspacing8">
							<div class="ui input logfield2">
								<input type="password" name = "password" placeholder="Password">
							</div>
														
						</div>

						<br>
						<br>
						<div class ="ten wide column  bspacing8">
							<center><button type="submit" name="submit" onclick='myfunc()' class="ui big button">
								Sign in
							</button></center>
						</div>


														
					</div>
			</form>
		</div>
	</div>



@stop