<?php include_once 'template-header.php' ?>
<script>
$(document).ready(function(e) {
	sideMenuOptions = [];
	
	sideMenuOptions.push(['#control_panel_option_dashboard', 'control-panel/project-group/dashboard.html']);
	sideMenuOptions.push(['#control_panel_option_basic', 'control-panel/project-group/basic.html']);
	sideMenuOptions.push(['#control_panel_option_project', 'control-panel/project-group/create-new-project.html']);
	sideMenuOptions.push(['#control_panel_option_user', 'control-panel/project-group/create-new-user.html']);
	sideMenuOptions.push(['#control_panel_option_role', 'control-panel/project-group/role.html']);
	sideMenuOptions.push(['#control_panel_option_advance', 'control-panel/project-group/advance.html']);
	
	for (var i = 0; i < sideMenuOptions.length; i++) $(sideMenuOptions[i][0]).on('click', processSideMenuOption(sideMenuOptions[i][1]));
});

function processSideMenuOption(fileName) {
	return function() {
		var filePath = 'html/' + fileName;
		$.ajax({
			url: filePath,
			success: function(data) {
				$('#control_panel_setting_area').html(data);
			}
		});
	}
}
</script>
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
                  <div id="control_panel_options_list">
                    <ul>
                      <li id="control_panel_option_dashboard"><i class="fa fa-tachometer control_panel_options_list_icon"></i> Dashboard</li>
                      <li id="control_panel_option_basic"><i class="fa fa-cog control_panel_options_list_icon"></i> Basic</li>
                      <li id="control_panel_option_project" class="control_panel_options_list_selected"><i class="fa fa-leaf control_panel_options_list_icon"></i> Project</li>
                      <li id="control_panel_option_user"><i class="fa fa-user control_panel_options_list_icon"></i> User</li>
                      <li id="control_panel_option_role"><i class="fa fa-users control_panel_options_list_icon"></i> Role</li>
                      <li id="control_panel_option_advance"><i class="fa fa-user-secret control_panel_options_list_icon"></i> Advance</li>
                    </ul>
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