//FORM VALIDATIONS

$('#form')
	.form({
		fields: {

			categname: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 \-'.,]{3,35}$/
				}]
			},

			sub_name: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 \-'.,]{3,35}$/
				}]
			},

			category: {
				rules: [{
					type : "empty"
				}]
			},


			positionname: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 \-'.,]{3,35}$/
				}]
			},

			acpositionname: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 \-'.,]{3,35}$/
				}]
			},

			acsectorName: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 \-'.,]{3,35}$/
				}]
			},

			name: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 \-'.,]{3,35}$/
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
				}]
			},

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
		}
	});