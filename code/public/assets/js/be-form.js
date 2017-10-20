$(document).ready(function() {
	
	$('.ui.form').form({

		fields : {
			firstname : {

				identifier : 'firstname',
				rules : [{
					type : 'empty',
					prompt : 'Please enter your firstname'
				}]
			},
			lastname : {

				identifier : 'lastname',
				rules : [{
					type : 'empty',
					prompt : 'Please enter your lastname'
				}]
			},
			mobile_no : {

				identifier : 'mobile_no',
				rules : [{
					type : 'empty',
					prompt : 'Please enter your mobile number'
				},
				{
					type : 'number',
					prompt : 'Please enter only number'
				}]
			},
			email : {

				identifier : 'email',
				rules : [{
					type : 'empty',
					prompt : 'Please enter your e-mail'
				},
				{
					type : 'email',
					prompt : 'Please enter a valid e-mail'
				}]
			},
			student_id : {

				identifier : 'student_id',
				rules : [{
					type : 'empty',
					prompt : 'Please enter your student ID'
				}]
			},
			student_class : {

				identifier : 'student_class',
				rules : [{
					type : 'empty',
					prompt : 'Please enter your student class'
				}]
			},
			user_role : {

				identifier : 'user_role',
				rules : [{
					type : 'empty',
					prompt : 'Please choose your role'
				}]
			},
			password : {

				identifier : 'password',
				rules : [{
					type : 'empty',
					prompt : 'Please enter your password'
				},
				{
					type : 'length[8]',
					prompt : 'Your password must be at least 8 characters'
				}]
			},
			password_confirmation : {

				identifier : 'password_confirmation',
				rules : [{
					type : 'empty',
					prompt : 'Please re-enter your password'
				},
				{
					type : 'match[password]',
					prompt : 'Your password does not match'
				}]
			},
			old_password : {

				identifier : 'old_password',
				rules : [{
					type : 'empty',
					prompt : 'Please enter your old password to confirm'
				}]
			}	
		},
		on : 'blur'
	});
});