<?php
include_once 'template-header.php';
if (!$info = $this->getVar('info')) fatalError('Unexpected error occurred when rendering the page.');
?>
<div id="main">
  <div class="container-fluid" id="main_frame">
    <div class="row">
      <div class="col-md-12">
        <div class="card" id="entity_edit_card">
          <div id="entity_edit_card_menu"><i class="fa fa-cubes"></i> <span id="entity_edit_card_menu_title"><?php echo $info['basicInfo']['name']; ?></span> </div>
          <div style="margin:0 20px 0 20px;">
            <div class="tab_panel">
              <div class="tab_panel_header">
                <div class="tab_panel_title">Entity Settings Panel</div>
                <div class="tab_panel_menu">
                  <ul>
                    <li class="tab_panel_menu_current_title"> <i class="fa fa-info-circle"></i>BASIC</li>
                    <li> <i class="fa fa-info-circle"></i>OTHER ATTRIBUTES</li>
                    <li> <i class="fa fa-film"></i>MEDIA</li>
                  </ul>
                </div>
              </div>
              <div class="tab_panel_content">
                <div class="tab_panel_content_tab" style="display:none;">
                  <form>
                    <div class="tab_panel_control"> <span class="tab_panel_control_title">Entity title</span>
                      <input type="text" class="form-control" name="entityTitle">
                    </div>
                    <div class="tab_panel_control"> <span class="tab_panel_control_title">Description</span>
                      <textarea class="form-control" name="entityDescription" rows="10"></textarea>
                    </div>
                    <hr>
                    <div class="tab_panel_content_tab_bottom_button_area">
                      <input type="submit" value="SAVE" class="text_button color_blue">
                    </div>
                    <div style="clear:both;"></div>
                  </form>
                </div>
                <div class="tab_panel_content_tab" style="display:none;">
                  <form>
                    <div class="tab_panel_control"> <span class="tab_panel_control_title">Technology</span>
                      <input type="text" class="form-control" name="entityTitle">
                    </div>
                    <div class="tab_panel_control"> <span class="tab_panel_control_title">Website</span>
                      <input type="text" class="form-control" name="entityTitle">
                    </div>
                    <div class="tab_panel_control"> <span class="tab_panel_control_title">Abstract</span>
                      <textarea class="form-control" rows="10"></textarea>
                    </div>
                    <hr>
                    <div class="tab_panel_content_tab_bottom_button_area">
                      <input type="submit" value="SAVE" class="text_button color_blue">
                    </div>
                    <div style="clear:both;"></div>
                  </form>
                </div>
                <div class="tab_panel_content_tab"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
