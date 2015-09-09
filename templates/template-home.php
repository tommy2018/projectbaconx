<?php if ($user = $this->getVar('user')) require_once 'template-header.php'; else require_once 'template-header-guest.php'; ?>

<div id="main">
  <div class="container-fluid" id="main_frame">
    <div class="row">
      <div class="col-lg-12">
        <div class="card" id="event_card">
          <div id="event_card_header">
            <div id="event_card_header_content"> <span id="event_card_header_title"></span><br>
              <span id="event_card_header_location"></span><br>
              <span id="event_card_header_date"></span> </div>
          </div>
          <div id="event_card_dropdown_menu_area">
            <div id="event_card_dropdown_menu_toggle"><i class="fa fa-tags"></i>&nbsp;<span></span>&nbsp;<i class="fa fa-chevron-down" id="event_card_dropdown_menu_toggle_arrow"></i></div>
            <div id="event_card_dropdown_menu">
              <ul>
              </ul>
            </div>
          </div>
          <div id="event_card_content_area">
            <div class="container-fluid" id="event_card_content_frame"> </div>
          </div>
          <div style="text-align:center; color:rgba(125,125,125,0.75); padding:100px; display:none;" id="empty_list"> EMPTY LIST </div>
        </div>
      </div>
    </div>
  </div>
</div>
