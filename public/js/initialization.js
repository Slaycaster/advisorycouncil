
function init(type) {
<<<<<<< HEAD
	//alert(type);
=======
	
>>>>>>> 45f213afb8078abe4bd98abc68409f9d947e7bef
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
<<<<<<< HEAD
	bannervar.style.backgroundcolor='GREEN';
	
	alert(type);
=======
	//bannervar.style.backgroundcolor='GREEN';
	
>>>>>>> 45f213afb8078abe4bd98abc68409f9d947e7bef
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
