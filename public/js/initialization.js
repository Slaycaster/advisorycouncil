
function init(type) {
	
	$('.tabular.menu .item').tab();

	$('.ui.dropdown').dropdown();

	$('.ui.checkbox').checkbox();



	$(document).ready(function() {
		$('#datatable').DataTable();
	} );

	$('#select').dropdown();

	$('.ui.sticky')
	  .sticky({
	    context: '#summary'
	  });

	$('.ui.modal')
	  .modal();

	var bannervar = document.getElementById('banner')
	//bannervar.style.backgroundcolor='GREEN';
	
		if(type == 0){
			bannervar.style.backgroundColor='black';
		}
		else if (type == 1){
			bannervar.style.backgroundColor='red';
		}
		else if(type == 2){
			bannervar.style.backgroundColor='#00253a';
		}

	
}//function init() {
