@extends('module.search')


@section('searchsection')
	<div class ="advcardcon">
		<h4 class="h4result">Results for "search"</h4>

		<div class = "itemlist">
				
		</div>
		
	</div>

	<script type="text/javascript">
		$('{{$active}}').attr('class', 'mlink item active');

	</script>


@stop