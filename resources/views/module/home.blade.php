@extends('baseform')

@section('maincontent')

	<div class = "homecon">
		<div class = "ui grid">
			<div class = "row">
				<div class = "nine wide column colheight">
					<div class="ui icon input big search">
						<i class="search icon"></i>
						<input type="text" placeholder="Search...">
					</div>
				</div>
			
				
			</div>

			<div class = "row">
				<hr>
				
				
				@yield('homesection')

				


				
				
			</div>


		</div>
		
	</div>


	<script type="text/javascript">
		$('#tab1').attr('class', 'mlink item active');

	</script>
@stop