@extends('baseform')

@section('maincontent')

	<div class = "maintecon">
		
		<div class = "mcontent">
			<div class = "ui grid">

				<div class = "five wide column">
					<div class = "formpane">
						<div class = "mhead2">
							<span class = "headertext">Add Admin</span>
							<div id="myToast" class="toast-popup"></div>
							<i class="write square big icon"></i>
						</div>

						@yield('mfillformsection')
							
					</div>
				</div>

				<div class = "eleven wide column">
					<div class = "tablepane">
						@yield('mtablesection')
					
					</div>
				</div>
						
						
			</div>
					
		</div>
	</div>

	<div class = "modal">
		<div class="ui basic modal" id = "confirmmodal">
			<div class="ui icon header">
				<i class="help circle icon"></i>
		    		<div name = "modalmessage">Add Admin?</div>
			</div>
			
			<div class="actions">
		    	<div class="ui basic cancel inverted button">
		      			No
		   		</div>
		    	<div onclick = "addUser()" class="ui basic ok inverted button">
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
		    	<div onclick = "document.getElementById('form').reset(); loadtoast('Cancelled!');" class="ui basic ok inverted button">
		      		Yes
		    	</div>
		  	</div>
		</div>

		

	</div>

	<div class = "popupcon">
		<div class="ui popup hidden">
  			<label class="pophead" name="namelabel"></label>
  			<input type="hidden" name="appid" readonly>
     		<p><div class="inline fields">
					<div class = "field">
						<div class = "ui radio checkbox">
							<input type="radio" value = '0' name = "appadmintype" checked/>
							<label>Superadmin</label>
							
						</div>
						
					</div>

					<div class = "field">
						<div class = "ui radio checkbox">
							<input type="radio" value = '1' name = "appadmintype"/>
							<label>Admin</label>
							
						</div>
						
					</div>
				</div>
			</p>
    		<center><button type = "button"
						class="ui tiny button submit savebtnstyle"
						onclick = "setstatus(1)">
					Approve
				</button>
		
				<button type="button" 
						class="ui tiny button"
						onclick = "setstatus(2)">
					Disapprove

				</button></center>
		</div>
	</div>

	<script type="text/javascript">
		$('#tab4').attr('class', 'mlink2 item active');

		function loadCModal() {

			if(src == 0) {
				$('#confirmmodal').modal('show');

			} else if(src == 1) {
				//load modal for confirmation
			}//if
		}//function load CModal(src) {

	</script>

@include('admin.admin_script')

@stop