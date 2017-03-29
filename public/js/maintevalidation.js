//FORM VALIDATIONS

//MAINTENANCE
$('#form')
	.form({
		fields: {

			positionname: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 \-'.,]{1,35}$/
				}]
			},

			acpositionname: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 \-'.,]{1,35}$/
				}]
			},

			acsectorName: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 \-'.,]{1,35}$/
				}]
			},

			name: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 \-'.,]{1,35}$/
				}]
			},

			terName: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 \-'.,]{1,35}$/
				}]
			},

			contact: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^[+][6][3][9][0-9]{9}$/
				}]
			},

			office: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^[0-9]+$/
				}]
			},

			office2: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^[0-9]+$/
				}]
			},

			office3: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^[0-9]+$/
				}]
			},

			select_office1: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^[0-9]+$/
				}]
			},

			select_office2: {
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



/**

street: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9#\-'. ,]{1,35}$/

				}]
			},

			barangay: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9\-'. ]{1,35}$/

				}]
			},

			city: {
				rules: [{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9\-'. ]{1,35}$/

				}]
			},

			province: {
				rules: [{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9\-'. ]{1,35}$/

				}]
			}
			**/

