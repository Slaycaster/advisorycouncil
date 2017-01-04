//FORM VALIDATIONS

$('#form')
	.form({
		fields: {
			categcode: {
				rules: [{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 ]{1,10}$/

				}]
			},

			categname: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 ]{3,35}$/
				}]
			},

			sub_code: {
				rules: [{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 ]{1,10}$/

				}]

			},

			sub_name: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 ]{3,35}$/
				}]
			},

			category: {
				rules: [{
					type : "empty"
				}]
			},

			positioncode: {
				rules: [{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 ]{1,10}$/

				}]
			},

			positionname: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 ]{3,35}$/
				}]
			},

			acpositioncode: {
				rules: [{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 ]{1,10}$/

				}]
			},

			acpositionname: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 ]{3,35}$/
				}]
			},

			acsectorCode: {
				rules: [{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 ]{1,10}$/

				}]
			},

			acsectorName: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 ]{3,35}$/
				}]
			},

			code: {
				rules: [{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 ]{1,10}$/

				}]
			},

			name: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9 ]{3,35}$/
				}]
			},

			address: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9#-'. ,]{1,60}$/

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
					value : /^(?=.*(\d|\w))[A-Za-z0-9#-'. ,]{1,35}$/

				}]
			},

			barangay: {
				rules: [{
					type : "empty"
				},
				{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9-'. ]{1,35}$/

				}]
			},

			city: {
				rules: [{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9-'. ]{1,35}$/

				}]
			},

			province: {
				rules: [{
					type : "regExp",
					value : /^(?=.*(\d|\w))[A-Za-z0-9-'. ]{1,35}$/

				}]
			}
		}
	});