<?php
if ($user = $this->getVar('user')) include_once 'template-header.php'; else include_once 'template-header-guest.php';
?>

<script>
$(document).ready(function(e) {
    var eventCardDropdownMenuToggle = $('#event_card_dropdown_menu_toggle');
	var eventCardDropdownMenuCurrentItem = $('#event_card_dropdown_menu_toggle span');
	var eventCardDropdownMenu = $('#event_card_dropdown_menu');
	var eventCardDropdownMenuToggleArrow = $('#event_card_dropdown_menu_toggle_arrow');
	var eventCardHeaderTitle = $('#event_card_header_title');
	var eventCardHeaderLocation = $('#event_card_header_location');
	var eventCardHeaderDate = $('#event_card_header_date');
	
	eventCardDropdownMenuToggle.on('click', function() {
		if (eventCardDropdownMenu.is(":visible")) {
			eventCardDropdownMenu.hide();
			
			eventCardDropdownMenuToggleArrow.removeClass('fa-chevron-up');
			eventCardDropdownMenuToggleArrow.addClass('fa-chevron-down');
		} else {
			eventCardDropdownMenu.show();
			eventCardDropdownMenuToggleArrow.removeClass('fa-chevron-down');
			eventCardDropdownMenuToggleArrow.addClass('fa-chevron-up');
		}
	});
	
	var formData = new FormData();
	
	formData.append('id', 1);
	
	$.ajax({
		url: 'request.php?module=event&do=getEventBriefInfo',
		dataType: 'json',
		cache: false,
		type: 'POST',
		processData: false,
		contentType: false,
		data: formData,
		success: function(data) {
			if (data.success) {
				eventCardHeaderTitle.html(data.result.name);
				eventCardHeaderLocation.html('Location not available at the moment');
				eventCardHeaderDate.html(data.result.startDate);
			} else {
				alert(data.errorMessage);
			}
		},
		error: function(data) {
			alert('error');
		}
	});
});

function newProjectCard(id, name, description, index) {
	var a = $('#');
	var projectCard = document.createElement('<div>');
	projectCard.setAttribute('class', 'card');
	
	var entityCardTitle = document.createElement('<div>');
	entityCardTitle.setAttribute('class', 'event_card_content_entity_card_title event_card_content_bg_color_1');
	var titleContent = document.createTextNode(name);
	entityCardTitle.appendChild(titleContent);
	
	var entityCardDescriptionArea = document.createElement('<div>');
	entityCardDescriptionArea.setAttribute('class', 'event_card_content_entity_card_description_area');
	
	var entityCardDescriptionText = document.createElement('<div>');
	entityCardDescriptionText.setAttribute('class', 'event_card_content_text_color_1');
	var entityCardDescriptionTextContent = document.createTextNode('DESCRIPTION');
	entityCardDescriptionText.appendChild(entityCardDescriptionTextContent);
	
	var horizontalLine = document.createElement('<hr>');
	
	var entityCardDescriptionContent = document.createElement('<div>');
	var entityCardDescriptionContentText = document.createTextNode(description);
	entityCardDescriptionContent.appendChild(entityCardDescriptionContentText);
	
	entityCardDescriptionArea.appendChild(entityCardDescriptionText);
	entityCardDescriptionArea.appendChild(horizontalLine);
	entityCardDescriptionArea.appendChild(entityCardDescriptionContent);
	
	var entityCardButtonArea = document.createElement('<div>');
	entityCardButtonArea.setAttribute('class', 'event_card_content_entity_card_buttons_area');
	
	var entityCardButton = document.createElement('<button>');
	entityCardButton.setAttribute('class', 'text_button event_card_content_text_color_1');
	var entityCardButtonText = document.createTextNode('MORE');
	entityCardButton.appendChild(entityCardButtonText);
	
	entityCardButtonArea.appendChild(entityCardButton);
	
	var entityCardClear = document.createElement('<div>');
	entityCardClear.setAttribute('class', 'event_card_content_entity_card_clear');
	
	projectCard.appendChild(entityCardTitle);
	projectCard.appendChild(entityCardDescriptionArea);
	projectCard.appendChild(entityCardButtonArea);
	projectCard.appendChild(entityCardClear);
}
</script>

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
          <div id="event_card_dropdown_menu_area"> <div id="event_card_dropdown_menu_toggle"><i class="fa fa-tags"></i>&nbsp;<span>Computer Science Undergraduate</span>&nbsp;<i class="fa fa-chevron-down" id="event_card_dropdown_menu_toggle_arrow"></i></div>
            <div id="event_card_dropdown_menu">
              <ul>
                <li>Information Technology Undergraduate</li>
                <li>Computer Science Postgraduate</li>
                <li>Information Technology Research</li>
              </ul>
            </div>
          </div>
          <div id="event_card_content_area">
            <div class="container-fluid" id="event_card_content_frame">
              <div class="row">
                <div class="col-lg-6">
                  <div class="card" >
                    <div class="event_card_content_entity_card_title event_card_content_bg_color_1">Tradeshow Management Toolkit</div>
                    <div class="event_card_content_entity_card_description_area">
                      <div class="event_card_content_text_color_1">DESCRIPTION</div>
                      <hr>
                      <div>Color in material design is inspired by bold hues juxtaposed with muted environments, deep shadows, and bright highlights. Material tak...</div>
                    </div>
                    <div class="event_card_content_entity_card_buttons_area">
                      <button class="text_button event_card_content_text_color_1">MORE</button>
                    </div>
                    <div class="event_card_content_entity_card_clear"></div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="card" >
                    <div class="event_card_content_entity_card_title event_card_content_bg_color_2">Tradeshow Management Toolkit</div>
                    <div class="event_card_content_entity_card_description_area">
                      <div class="event_card_content_text_color_2">DESCRIPTION</div>
                      <hr>
                      <div>Color in material design is inspired by bold hues juxtaposed with muted environments, deep shadows, and bright highlights. Material tak...</div>
                    </div>
                    <div class="event_card_content_entity_card_buttons_area">
                      <button class="text_button event_card_content_text_color_2">MORE</button>
                    </div>
                    <div class="event_card_content_entity_card_clear"></div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="card" >
                    <div class="event_card_content_entity_card_title event_card_content_bg_color_3">Tradeshow Management Toolkit</div>
                    <div class="event_card_content_entity_card_description_area">
                      <div class="event_card_content_text_color_3">DESCRIPTION</div>
                      <hr>
                      <div>Color in material design is inspired by bold hues juxtaposed with muted environments, deep shadows, and bright highlights. Material tak...</div>
                    </div>
                    <div class="event_card_content_entity_card_buttons_area">
                      <button class="text_button event_card_content_text_color_3">MORE</button>
                    </div>
                    <div class="event_card_content_entity_card_clear"></div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="card" >
                    <div class="event_card_content_entity_card_title event_card_content_bg_color_4">Tradeshow Management Toolkit</div>
                    <div class="event_card_content_entity_card_description_area">
                      <div class="event_card_content_text_color_4">DESCRIPTION</div>
                      <hr>
                      <div>Color in material design is inspired by bold hues juxtaposed with muted environments, deep shadows, and bright highlights. Material tak...</div>
                    </div>
                    <div class="event_card_content_entity_card_buttons_area">
                      <button class="text_button event_card_content_text_color_4">MORE</button>
                    </div>
                    <div class="event_card_content_entity_card_clear"></div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="card" >
                    <div class="event_card_content_entity_card_title event_card_content_bg_color_5">Tradeshow Management Toolkit</div>
                    <div class="event_card_content_entity_card_description_area">
                      <div class="event_card_content_text_color_5">DESCRIPTION</div>
                      <hr>
                      <div>Color in material design is inspired by bold hues juxtaposed with muted environments, deep shadows, and bright highlights. Material tak...</div>
                    </div>
                    <div class="event_card_content_entity_card_buttons_area">
                      <button class="text_button event_card_content_text_color_5">MORE</button>
                    </div>
                    <div class="event_card_content_entity_card_clear"></div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="card" >
                    <div class="event_card_content_entity_card_title event_card_content_bg_color_6">Tradeshow Management Toolkit</div>
                    <div class="event_card_content_entity_card_description_area">
                      <div class="event_card_content_text_color_6">DESCRIPTION</div>
                      <hr>
                      <div>Color in material design is inspired by bold hues juxtaposed with muted environments, deep shadows, and bright highlights. Material tak...</div>
                    </div>
                    <div class="event_card_content_entity_card_buttons_area">
                      <button class="text_button event_card_content_text_color_6">MORE</button>
                    </div>
                    <div class="event_card_content_entity_card_clear"></div>
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