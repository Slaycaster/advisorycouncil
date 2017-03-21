@extends('module.search')


@section('searchsection')
	<div class ="advcardcon">
		<div class="ui grid">
			<div class = "row">
				<div class = "sixteen wide column">
					<div class = "hcontent1">
						<div class="dcon">
							<div class = "tablepane">
								<div class = "mtitle">Results for "search"</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>

			<div class = "row">
				<div class = "sixteen wide column">
					
					<div class = "itemlist">
						
					</div>
						
					
					
				</div>
			</div>
			
		</div>

		
		
	</div>

	<script type="text/javascript">
		$('{{$active}}').attr('class', 'mlink item active');

	</script>


@stop