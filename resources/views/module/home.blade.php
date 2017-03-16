@extends('baseform')

@section('maincontent')

	<div class = "homecon">
		<div class = "ui grid">
			<!--<div class = "row">
				<div class = "nine wide column colheight">
					<div class="ui icon input medium search">
						<i class="search icon"></i>
						<input type="text" placeholder="Search...">
					</div>
				</div>
			
				<hr>
			</div>-->

			<div class = "row">
				
				
				
				@yield('homesection')

				


				
				
			</div>


		</div>
		
	</div>


	<script type="text/javascript">
		$('#tab1').attr('class', 'mlink item active');

	</script>
@stop