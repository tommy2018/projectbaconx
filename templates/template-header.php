<div id="header">
  <div id="header_user_account">
    <div id="header_user_account_toggle_area"><img src="images/account.png" alt=""><br>
      <span id="header_user_account_username"><?php echo($this->getVar('username'))?><i class="fa fa-chevron-down"></i></span></div>
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
