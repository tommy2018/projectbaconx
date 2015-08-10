<div id="header">
  <div id="header_user_account">
    <div id="header_user_account_toggle_area"><img src="images/account.png" alt=""><br>
      <span id="header_user_account_username">SIGN-IN</span></div>
  </div>
  <div id="header_title"><?php echo($this->getVar('applicationTitle'))?></div>
  <br>
  <div id="header_menu"><span id="header_menu_current_selection"><?php if($navPageTitle = $this->getVar('navPageTitle')) echo($navPageTitle); else echo "WELCOME";?></span>
  </div>
</div>

<div id="signin">
  <div id="signin_window">
    <button type="button" id="signin_closs_button"><img src="images/cross.png" id="signin_window_close_button" alt=""></button>
    <div id="signin_error_message"><i class="fa fa-exclamation-circle"></i> <span>Incorrect credentials</span></div>
    <span id="signin_title">Sign in</span>
    <hr>
    <form method="post" id="signin_form">
      <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" placeholder="Username" name="username">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" placeholder="Password" name="password">
      </div>
      <button type="submit" class="btn btn-default">SIGN IN</button>
    </form>
    <hr>
    <a href="#" class="problem_link"><i class="fa fa-question-circle"></i> Having trouble to sign in</a> </div>
</div>
