<?php if ($user = $this->getVar('user')) require_once 'template-header.php'; else require_once 'template-header-guest.php'; ?>
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
	float: right;
}
#profile_card_edit_password_form_button_area {
	float: right;
}
#profile_card_edit_email_form_processing_message {
	float: right;
	display: none;
}
#profile_card_edit_password_form_processing_message {
	float: right;
	display: none;
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
var currentEmailText;
var editEmailFormEmailTextBox;
var editPasswordFormTextBox;
var editEmailFormProcessingMessage;
var editPasswordFormProcessingMessage;

$(document).ready(function(e) {
    editEmailButton = $('#profile_card_edit_email_button');
	editPasswordButton = $('#profile_card_edit_password_button');
	editEmailArea = $('#profile_card_edit_email_area');
	editPasswordArea = $('#profile_card_edit_password_area');
	editEmailCancelButton = $('#profile_card_edit_email_cancel_button');
	editPasswordCancelButton = $('#profile_card_edit_password_cancel_button');
	editEmailFormEmailTextBox = $('#profile_card_edit_email_form');
	editPasswordForm = $('#profile_card_edit_password_form');
	currentEmailArea = $('#profile_card_email_address');
	currentPasswordArea = $('#profile_card_password');
	editEmailFormButtonArea = $('#profile_card_edit_email_form_button_area');
	editEmailForm = $('#profile_card_edit_email_form');
	editPasswordFormButtonArea = $('#profile_card_edit_password_form_button_area');
	currentEmailText = $('#profile_card_email_address span');
	editEmailFormEmailTextBox = editEmailForm.children('input[name="email"]');
	editPasswordFormOldePasswordTextBox = editPasswordForm.children('input[name="oldPassword"]');
	editEmailFormProcessingMessage = $('#profile_card_edit_email_form_processing_message');
	editPasswordFormProcessingMessage = $('#profile_card_edit_password_form_processing_message');
	
	editEmailButton.on('click', function() {
		editEmailArea.show();
		currentEmailArea.hide();
		editEmailFormEmailTextBox.focus();
	});
	
	editPasswordButton.on('click', function() {
		editPasswordArea.show();
		currentPasswordArea.hide();
		editPasswordFormOldePasswordTextBox.focus();
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
		updateEmail(this);
	});
	
	editPasswordForm.on('submit', function(e) {
		e.preventDefault();
		updatePassword(this);
	});
});

function updateEmail(form) {
	var formData = $(form).serializeArray();
	
	$.ajax({
		type: 'POST',
		url: 'request.php?module=user&do=change-email',
		dataType: 'json',
		data: $(form).serialize(),
		beforeSend: function() {
			editEmailFormButtonArea.hide();
			editEmailFormProcessingMessage.show();
		},
		success: function(data) {
			if (data.success) {
				editEmailArea.hide();
				currentEmailText.html(formData[0].value);
				editEmailForm[0].reset();
				currentEmailArea.show();
			} else {
				alert(data.errorMessage);
			}
		},
		error: function() {
			alert('Unexpected error');
		},
		complete: function() {
			editEmailFormButtonArea.show();
			editEmailFormProcessingMessage.hide();
			editEmailFormEmailTextBox.focus();
		}
	});
}

function updatePassword(form) {
	$.ajax({
		type: 'POST',
		url: 'request.php?module=user&do=change-password',
		dataType: 'json',
		data: $(form).serialize(),
		beforeSend: function() {
			editPasswordFormButtonArea.hide();
			editPasswordFormProcessingMessage.show();
		},
		success: function(data) {
			if (data.success) {
				editPasswordArea.hide();
				currentPasswordArea.show();
			} else {
				alert(data.errorMessage);
			}
		},
		error: function() {
			alert('Unexpected error');
		},
		complete: function() {
			editPasswordForm[0].reset();
			editPasswordFormButtonArea.show();
			editPasswordFormProcessingMessage.hide();
			editPasswordFormOldePasswordTextBox.focus();
		}
	});
}
</script>
<div id="main">
  <div class="container-fluid" id="main_frame">
    <div class="row">
      <div class="col-lg-12">
        <div class="card" id="profile_card">
          <div class="card_top"> <span class="card_title"><i class="fa fa-info-circle"></i> YOUR PROFILE </span> </div>
          <div class="card_content">
            <div id="profile_card_user_full_name"><i class="fa fa-user"></i>
              <?php if ($user = $this->getVar('user')) echo($user->getfullName()); else echo('Not Available');?>
            </div>
            <div style="color:#7D7D7D; font-size:15px;">Your User Identifier is
              <?php if ($user = $this->getVar('user')) echo($user->getUID()); else echo('Not Available');?>
            </div>
            <hr>
            <div style="padding:20px 15px 0 15px;"> <span class="profile_card_attribute_title"><i class="fa fa-male"></i> USERNAME</span> <span class="profile_card_attribute_content">
              <?php if ($user = $this->getVar('user')) echo($user->getUsername()); else echo('Not Available');?>
              </span>
              <hr>
              <span class="profile_card_attribute_title"><i class="fa fa-envelope-o"></i> EMAIL ADDRESS</span>
              <div class="profile_card_attribute_content">
                <div id="profile_card_email_address"><span>
                  <?php if ($user = $this->getVar('user')) echo($user->getEmail()); else echo('Not Available');?>
                  </span>
                  <button class="text_button color_blue profile_card_edit_button" id="profile_card_edit_email_button">(EDIT)</button>
                </div>
                <div id="profile_card_edit_email_area" class="profile_card_edit_form_area">
                  <form id="profile_card_edit_email_form">
                    <input type="email" class="profile_card_textbox" placeholder="New Email Address" name="email">
                    <br>
                    <div id="profile_card_edit_email_form_button_area">
                      <input type="button" value="CANCEL" class="text_button color_red profile_card_edit_form_cancel_button" id="profile_card_edit_email_cancel_button">
                      <input type="submit" value="CHANGE" class="text_button color_blue profile_card_edit_form_change_button">
                    </div>
                    <div id="profile_card_edit_email_form_processing_message"> <i class="fa fa-spinner fa-pulse"></i> Changing your email </div>
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
                    <input type="password" class="profile_card_textbox" placeholder="Old Password" name="oldPassword">
                    <br>
                    <input type="password" class="profile_card_textbox" placeholder="New Password" name="newPassword">
                    <br>
                    <input type="password" class="profile_card_textbox" placeholder="Confirm New Password" name="confirmNewPassword">
                    <br>
                    <div id="profile_card_edit_password_form_button_area">
                      <input type="button" value="CANCEL" class="text_button color_red profile_card_edit_form_cancel_button" id="profile_card_edit_password_cancel_button">
                      <input type="submit" value="CHANGE" class="text_button color_blue profile_card_edit_form_change_button">
                    </div>
                    <div id="profile_card_edit_password_form_processing_message"> <i class="fa fa-spinner fa-pulse"></i> Changing your password </div>
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
