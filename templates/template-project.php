<?php if ($user = $this->getVar('user')) include_once 'template-header.php'; else include_once 'template-header-guest.php';?>

<div id="main">
  <div class="container-fluid" id="main_frame">
    <div class="row">
      <div class="col-md-12">
        <div class="card" id="project_card">
          <div id="project_card_menu"><i class="fa fa-cubes"></i> <span id="project_card_menu_title">Tradeshow Management Toolkit</span>
            <div id="project_card_menu_buttons">
              <button type="button" id="project_edit_button" class="image_button"><i class="fa fa-pencil"></i></button>
              <button type="button" id="project_refresh_button" class="image_button"><i class="fa fa-refresh"></i></button>
            </div>
          </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-5">
                <div id="project_information_card" class="card">
                  <div class="card_top"> <span class="card_title"><i class="fa fa-leaf"></i> INFORMATION<br>
                    </span> </div>
                  <div class="card_content"> Supervisor: Luke <br>
                    Description: Something something and something......</div>
                  <div class="bottom"> </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div id="media_card" class="card">
                  <div class="card_top"> <span class="card_title"><i class="fa fa-film"></i> MEDIA</span> </div>
                  <div class="ccard_ontent"> </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div id="group_members_card" class="card">
                  <div class="card_top"> <span class="card_title"><i class="fa fa-users"></i> GROUP MEMBERS</span> </div>
                  <div class="card_content"> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
