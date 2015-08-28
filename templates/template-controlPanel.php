<?php include_once 'template-header.php' ?>
<script>
$(document).ready(function(e) {
	sideMenuOptions = [];
	
	sideMenuOptions.push(['#control_panel_option_project', 'control-panel/project-group/project-menu.html']);
	sideMenuOptions.push(['#control_panel_option_user', 'control-panel/project-group/user-menu.html']);
	sideMenuOptions.push(['#control_panel_option_role', 'control-panel/project-group/role-menu.html']);
	
	for (var i = 0; i < sideMenuOptions.length; i++)
		$(sideMenuOptions[i][0]).on('click', function() {
			switchSettingPanel(sideMenuOptions[i][1]);
		
		});
});
</script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<div id="main">
  <div class="container-fluid" id="main_frame">
    <div class="row">
      <div class="col-md-12">
        <div class="card" id="control_panel_card">
          <div class="card_top">
            <div class="card_title"> <span class="control_panel_menu"><i class="fa fa-cogs"></i> PROJECT GROUP SETTINGS &nbsp;<i class="fa fa-chevron-down"></i></span>
              <div class="control_panel_menu_dropdown">
                <ul>
                  <li>APPLICATION SETTINGS</li>
                  <li>EVENT SETTINGS</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card_content">
            <div class="container-fluid" id="control_panel_frame">
              <div class="row">
                <div class="col-lg-3">
                  <div id="control_panel_options_list_area">
                    <div id="control_panel_options_list">
                      <div id="control_panel_option_project" class="control_panel_options_list_selected control_panel_options_list_item"> <span><i class="fa fa-leaf control_panel_options_list_icon"></i> Project</span> </div>
                      <div id="control_panel_option_user" class="control_panel_options_list_item"><i class="fa fa-user control_panel_options_list_icon"></i> User</div>
                      <div id="control_panel_option_role" class="control_panel_options_list_item"><i class="fa fa-users control_panel_options_list_icon"></i> Role</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-9">
                  <div id="control_panel_setting_area"> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
