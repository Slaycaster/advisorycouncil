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
		    	<div onclick = "document.getElementById('form').reset(); loadtoast('Cancelled!');" class="ui basic ok inverted button">
		      		Yes
		    	</div>
		  	</div>
		</div>



	</div>

	<script type="text/javascript">

		function loadCModal() {
			var message = "";

			if ("{{$action}}" === '1') {
				message = "Save Changes?";

			} else if ("{{$action}}" === '0') {
				message = "Save Adviser?";

			}//if (flag == 1) {

			document.getElementsByName('modalmessage')[0].innerHTML = message;
			$('#confirmmodal').modal('show');

		}//load Modal
	</script>