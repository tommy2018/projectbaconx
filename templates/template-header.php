<script>
$(document).ready(function(e) {
    $('#header_user_account_dropdown_signout_button').on('click', function() {
		$.ajax({
			type: 'GET',
			url: 'request.php?module=user&do=signout',
			dataType: 'json',
			success: function(data) {
				if (data.success)
					window.location.replace('home');
			}
		});
	});
});
</script>

<div id="header">
  <div id="header_user_account">
    <div id="header_user_account_toggle_area"><img src="images/account.png" alt=""><br>
      <span id="header_user_account_username"><?php if ($user = $this->getVar('user')) echo($user->getUsername()); else echo('NULL');?>&nbsp;<i class="fa fa-chevron-down"></i></span></div>
    <div id="header_user_account_dropdown">
      <button type="button" id="header_user_account_dropdown_signout_button" class="image_button"><img src="images/signout.png" alt=""></button>
    </div>
  </div>
  <div id="header_title"><?php echo($this->getVar('applicationTitle'))?></div>
  <br>
  <div id="header_menu"><span id="header_menu_current_selection"><?php echo($this->getVar('navPageTitle'))?></span>
    <ul>
      <li>PROFILE</li>
      <li>CONTROL PANEL</li>
      <li>DASHBOARD</li>
    </ul>
  </div>
</div>
