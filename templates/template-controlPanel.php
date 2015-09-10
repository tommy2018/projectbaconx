<?php include_once 'template-header.php' ?>
<div id="main">
  <div class="container-fluid" id="main_frame">
    <div class="row">
      <div class="col-md-12">
        <div class="card" id="control_panel_card">
          <div id="control_panel_card_top">
            <div id="control_panel_card_top_title"> <span id="control_panel_card_menu_toggle"> <i class="fa fa-cogs"></i> <span id="control_panel_card_menu_toggle_name">APPLICATION SETTINGS</span> &nbsp;<i class="fa fa-chevron-down" id="control_panel_card_menu_toggle_arrow"></i></span>
              <div id="control_panel_card_menu_dropdown">
                <ul>
                  <li data-name="APPLICATION SETTINGS" data-file="control-panel/side-menu/application.html">- APPLICATION SETTINGS</li>
                  <li data-name="EVENT SETTINGS" data-file="control-panel/side-menu/event.html">- EVENT SETTINGS</li>
                  <li data-name="PROJECT GROUP SETTINGS" data-file="control-panel/side-menu/project-group.html">- PROJECT GROUP SETTINGS</li>
                </ul>
              </div>
            </div>
          </div>
          <div id="control_panel_card_content">
            <div class="container-fluid" id="control_panel_frame">
              <div class="row">
                <div class="col-lg-3">
                  <div id="control_panel_card_option_list_area">
                    <div id="control_panel_card_option_list"> </div>
                  </div>
                </div>
                <div class="col-lg-9">
                  <div id="control_panel_card_setting_area"> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
