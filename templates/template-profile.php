<?php if ($user = $this->getVar('user')) include_once 'template-header.php'; else include_once 'template-header-guest.php'; ?>
<style>
body {
	background: rgba(236,236,236,1.00);
}
#main {
	margin-top: 180px;
	margin-bottom: 25px;
}
#main_frame {
	margin: 0 10px 0 8px;
}
#profile_card .card_top {
	background: #4CAF50;
}
#profile_card .card_content {
	color: #4F4F4F;
	font-size: 16px;
	padding: 25px;
}
.profile_card_attribute_title {
	color: #4CAF50;
	display: block;
	margin-bottom: 15px;
	font-size: 18px;
}
.profile_card_attribute_content {
	font-size: 18.5px;
	display: block;
	line-height: 180%;
	text-align: justify;
	margin-bottom: 50px;
}
#profile_card_user_full_name {
	font-size: 22.5px;
	margin-bottom: 8px;
}
.profile_card_edit_button {
	font-size: 15px;
	font-weight: normal;
}
.profile_card_textbox {
	width: 100%;
}
.profile_card_edit_form_area {
	display: none;
}
.profile_card_edit_form_area input {
	margin-bottom: 20px;
}
.profile_card_edit_form_change_button:hover {
	background: #F1F1F1;
}
.profile_card_edit_form_cancel_button:hover {
	background: #F1F1F1;
}
.profile_card_edit_form_change_button {
	padding: 5px 15px 5px 15px;
	font-size: 14px;
}
.profile_card_edit_form_cancel_button {
	padding: 5px 15px 5px 15px;
	font-size: 14px;
}
#profile_card_edit_email_form_button_area {
	float:right;
}
#profile_card_edit_password_form_button_area {
	float:right;
}
</style>
<script>
var editEmailButton;
var editPasswordButton;
var editEmailArea;
var editPasswordArea;
var editEmailCancelButton;
var editPasswordCancelButton;
var editEmailForm;
var editPasswordForm;
var currentPasswordArea;
var currentEmailArea;
var editEmailFormButtonArea;
var editPasswordFormButtonArea;

$(document).ready(function(e) {
    editEmailButton = $('#profile_card_edit_email_button');
	editPasswordButton = $('#profile_card_edit_password_button');
	editEmailArea = $('#profile_card_edit_email_area');
	editPasswordArea = $('#profile_card_edit_password_area');
	editEmailCancelButton = $('#profile_card_edit_email_cancel_button');
	editPasswordCancelButton = $('#profile_card_edit_password_cancel_button');
	editEmailForm = $('#profile_card_edit_email_form');
	editPasswordForm = $('#profile_card_edit_password_form');
	currentEmailArea = $('#profile_card_email_address');
	currentPasswordArea = $('#profile_card_password');
	editEmailFormButtonArea = $('#profile_card_edit_email_form_button_area');
	editPasswordFormButtonArea = $('#profile_card_edit_password_form_button_area');
	
	editEmailButton.on('click', function() {
		editEmailArea.show();
		currentEmailArea.hide();
	});
	
	editPasswordButton.on('click', function() {
		editPasswordArea.show();
		currentPasswordArea.hide();
	});
	
	editEmailCancelButton.on('click', function() {
		editEmailArea.hide();
		editEmailForm[0].reset();
		currentEmailArea.show();
	});
	
	editPasswordCancelButton.on('click', function() {
		editPasswordArea.hide();
		editPasswordForm[0].reset();
		currentPasswordArea.show();
	});
	
	editEmailForm.on('submit', function(e) {
		e.preventDefault();
	});
	
	editPasswordForm.on('submit', function(e) {
		e.preventDefault();
	});
});

function updateEmail() {
	$.ajax({
		type: 'POST',
		url: 'request.php?module=user&do=change-password',
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

function updatePassword() {
}
</script>
<div id="main">
  <div class="container-fluid" id="main_frame">
    <div class="row">
      <div class="col-lg-12">
        <div class="card" id="profile_card">
          <div class="card_top"> <span class="card_title"><i class="fa fa-info-circle"></i> YOUR PROFILE </span> </div>
          <div class="card_content">
            <div id="profile_card_user_full_name"><i class="fa fa-user"></i> Man Pio Lei</div>
            <div style="color:#7D7D7D; font-size:15px;">Your User Identifier is 1</div>
            <hr>
            <div style="padding:20px 15px 0 15px;"> <span class="profile_card_attribute_title"><i class="fa fa-male"></i> USERNAME</span> <span class="profile_card_attribute_content">Tommy</span>
              <hr>
              <span class="profile_card_attribute_title"><i class="fa fa-envelope-o"></i> EMAIL ADDRESS</span>
              <div class="profile_card_attribute_content">
                <div id="profile_card_email_address">mpl989@uowmail.edu.au
                  <button class="text_button color_blue profile_card_edit_button" id="profile_card_edit_email_button">(EDIT)</button>
                </div>
                <div id="profile_card_edit_email_area" class="profile_card_edit_form_area">
                  <form id="profile_card_edit_email_form">
                    <input type="email" class="profile_card_textbox" placeholder="New Email Address">
                    <br>
                    <div id="profile_card_edit_email_form_button_area">
                      <input type="button" value="CANCEL" class="text_button color_red profile_card_edit_form_cancel_button" id="profile_card_edit_email_cancel_button">
                      <input type="submit" value="CHANGE" class="text_button color_blue profile_card_edit_form_change_button">
                    </div>
                    <div style="clear:both;"></div>
                  </form>
                </div>
              </div>
              <hr>
              <span class="profile_card_attribute_title"><i class="fa fa-key"></i> PASSWORD</span>
              <div class="profile_card_attribute_content">
                <div id="profile_card_password">********
                  <button class="text_button color_blue profile_card_edit_button" id="profile_card_edit_password_button">(EDIT)</button>
                </div>
                <div id="profile_card_edit_password_area" class="profile_card_edit_form_area">
                  <form id="profile_card_edit_password_form">
                    <input type="password" class="profile_card_textbox" placeholder="Old Password">
                    <br>
                    <input type="password" class="profile_card_textbox" placeholder="New Password">
                    <br>
                    <input type="password" class="profile_card_textbox" placeholder="Confirm New Password">
                    <br>
                    <div id="profile_card_edit_password_form_button_area">
                      <input type="button" value="CANCEL" class="text_button color_red profile_card_edit_form_cancel_button" id="profile_card_edit_password_cancel_button">
                      <input type="submit" value="CHANGE" class="text_button color_blue profile_card_edit_form_change_button">
                    </div>
                    <div style="clear:both;"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
