// JavaScript Document
$(document).ready(function(e) {
	var signInWindow = $('#signin');
	var signInErrorMessageBox = $('#signin_error_message');
	var signInErrorMessageText = $('#signin_error_message span');
	var signInForm = $('#signin_form');
	var signInWindowCloseButton = $('#signin_closs_button');
	var signInWindowToggle = $('#header_user_account_toggle_area');
	var signInFormUsernameTextBox = $('#signin_form input[name="username"]');
	var signInFormPasswordTextBox = $('#signin_form input[name="password"]');
	
	signInWindowToggle.on('click', function() {
		signInWindow.show();
		signInFormUsernameTextBox.focus();
	});
	
	signInWindowCloseButton.on('click', function() {
		signInWindow.hide();
		signInErrorMessageBox.hide();
		signInForm[0].reset();
	});
	
	signInForm.on('submit', function() {
		if (signInFormUsernameTextBox.val().length == 0 || signInFormPasswordTextBox.val().length == 0) {
			signInErrorMessageText.html('Username and password can\'t be empty.');
			signInErrorMessageBox.show();
			signInForm[0].reset();
			signInFormUsernameTextBox.focus();
		} else {
			$.ajax({
				type: 'POST',
				url: 'request.php?module=user&do=signin',
				dataType: 'json',
				data: $(this).serialize(),
				success: function(data) {
					if (data.success)
						window.location.replace('home');
					else {
						signInErrorMessageText.html(data.errorMessage);
						signInErrorMessageBox.show();
						signInFormPasswordTextBox.val('');
						signInForm[0].reset();
						signInFormUsernameTextBox.focus();
					}
				},
				error: function() {
					signInErrorMessageText.html('Communication error.');
					signInErrorMessageBox.show();
				}
			});
		}
		
		return false;
	});
});

function isEmpty(control) {
	return (control.val().length == 0);
}