//TRANSACTION
function reinst() {
	$('#form')
	.form({
		fields:{
			lname: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 ]{3,35}$/
				}]
			},

			fname: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 ]{3,35}$/
				}]
			},

			bdate: {
				rules: [{
					type : "empty"
				}]
			},

			durationsdate: {
				rules: [{
					type : "empty"
				}]
			},

			primary: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^[0-9]+$/
				}]
			},

			secondary: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^[0-9]+$/
				}]
			},

			acposition: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^[0-9]+$/
				}]
			},

			acsector: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^[0-9]+$/
				}]
			},

			authorder: {
				rules: [{
					type : "empty"
				}]
			},

			rank: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^[0-9]+$/
				}]
			}


		}
	});
}

function tablevalidate(id) {
	$('#form')
	.form({
		fields:{
			lname: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 ]{3,35}$/
				}]
			},

			fname: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 ]{3,35}$/
				}]
			},

			bdate: {
				rules: [{
					type : "empty"
				}]
			},

			durationsdate: {
				rules: [{
					type : "empty"
				}]
			},

			primary: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^[0-9]+$/
				}]
			},

			secondary: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^[0-9]+$/
				}]
			},

			authorder: {
				rules: [{
					type : "empty"
				}]
			},

			rank: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^[0-9]+$/
				}]
			},

			traintitle: {
				identifier: "traintitle-" + id,
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 \-'.,]{3,35}$/
				}]
			},

			traincateg: {
				identifier: "traincateg-" + id,
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^[A-Za-z0-9 ()]+$/
				}]
			},

			location: {
				identifier:  "location-" + id,
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 \-'.,]{3,35}$/
				}]
			},

			trainsdate: {
				identifier:  "trainsdate-" + id,
				rules: [{
					type : "empty"
				}]
			},

			trainedate: {
				identifier:  "trainedate-" + id,
				rules: [{
					type : "empty"
				}]
			},

			trainorg: {
				identifier:  "trainorg-" + id,
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 \-'.,]{3,35}$/
				}]
			}

		}

	});
}

function destroy() {
	$('#form').form('destroy');
}