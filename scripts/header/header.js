// JavaScript Document
var on = 0;

$(document).ready(function(e) {
    $('#header_user_account_toggle_area').on('click', function() {
		if (on == 0) {
			$('#header_user_account_dropdown').show();
			on = 1;
		} else {
			$('#header_user_account_dropdown').hide();
			on = 0;
		}
	});
});