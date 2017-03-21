@extends('baseform')

@section('maincontent')

	<div class = "homecon">
		<div class = "ui grid">

			<div class = "row">
				
				
				
				@yield('homesection')

				


				
				
			</div>


		</div>
		
	</div>


	<script type="text/javascript">
		$('#tab1').attr('class', 'mlink item active');

	</script>
@stop