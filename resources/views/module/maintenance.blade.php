@extends('baseform')

@section('maincontent')

	<div class="maintecon">
		<div class = "ui grid gridcellh">
			<div class = "three wide column">
				<div class="ui vertical menu">
					<div class = "item grey">
						<div class="header">Advisory Council (AC)</div>
					</div>
					<div class="item">
		    			<div class="menu">

		    				<a class="item" id = "m1" href = "{{url('maintenance/accategory')}}">Advisory Council Category</a>
		    				<a class="item" id = "m2" href = "{{url('maintenance/acsubcategory')}}">Advisory Council Sub-category</a>
		    				<a class="item" id = "m3" href = "{{url('maintenance/acposition')}}">Advisory Council Position</a>
		    				<a class="item" id = "m4" href = "{{url('maintenance/acsector')}}">Advisory Council Sector</a>


		    			</div>
		  			</div>
		  			<div class = "item grey">
		  				<div class="header">PSMU & TWG</div>
					</div>

		  			<div class = "item">
		    			<div class="menu">
		    				<a class="item" id = "m5" href = "{{url('maintenance/primaryoffice')}}">Primary Unit/Office</a>
		    				<a class="item" id = "m6" href = "{{url('maintenance/secondaryoffice')}}" >Secondary Unit/Office</a>
		    				<a class="item" id = "m7" href = "{{url('maintenance/tertiaryoffice')}}" >Tertiary Unit/Office</a>
		    				<a class="item" id = "m8" href = "{{url('maintenance/quarternaryoffice')}}" >Quaternary Unit/Office</a>
		    				<a class="item" id = "m9" href = "{{url('maintenance/policeposition')}}">PNP Position</a>
		    				<!--<a class="item" id = "m10" href = "{{url('maintenance/rank')}}">Rank</a>-->


		    			</div>
		  				
		  			</div>

				</div>
				
			</div>

			<div class = "thirteen wide column">
				<div class = "mcontent">
					<div class = "ui grid">

						<div class = "six wide column">
							<div class = "formpane">
								<div class = "mhead">
									<div id="myToast" class="toast-popup"></div>
									<i class="write square big icon"></i>
								</div>

								@yield('mfillformsection')
								
							</div>
						</div>

						<div class = "ten wide column">
							<div class = "tablepane">
								@yield('mtablesection')
								
							</div>
						</div>
						
						
					</div>
					
				</div>
					
			</div>
			
		</div>
	</div>

	<div class = "modal">
		<div class="ui basic modal" id = "confirmmodal">
			<div class="ui icon header">
				<i class="help circle icon"></i>
		    		<div name = "modalmessage"></div>
			</div>
			
			<div class="actions">
		    	<div class="ui basic cancel inverted button">
		      			No
		   		</div>
		    	<div onclick = "controlaction()" class="ui basic ok inverted button">
		      		Yes
		    	</div>
		  	</div>
		</div>

		<div class="ui basic modal" id = "cancelmodal">
			<div class="ui icon header">
				<i class="help circle icon"></i>
		    		<div name = "modalmessage">Cancel?</div>
			</div>
			
			<div class="actions">
		    	<div class="ui basic cancel inverted button">
		      			No
		   		</div>
		    	<div onclick = "document.getElementById('form').reset(); resetflag('Cancelled!');" class="ui basic ok inverted button">
		      		Yes
		    	</div>
		  	</div>
		</div>



	</div>

	<script type="text/javascript">
		$('#tab2').attr('class', 'mlink item active');

		function loadCModal() {
			var message = "";

			if (flag == 1) {
				message = "Save Changes?";

			} else if (flag == 0) {
				message = "Save Record?";

			}//if (flag == 1) {

			document.getElementsByName('modalmessage')[0].innerHTML = message;
			$('#confirmmodal').modal('show');

		}//function loadCModal() {

	</script>

	<script type="text/javascript" src = "{{ URL::asset('js/formvalidation.js') }}"></script>
	<script type="text/javascript" src = "{{ URL::asset('js/formcontrol.js') }}"></script>







@stop