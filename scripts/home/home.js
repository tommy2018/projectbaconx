// JavaScript Document
var eventCardDropdownMenuToggle;
var eventCardDropdownMenuCurrentItem;
var eventCardDropdownMenu;
var eventCardDropdownMenuList;
var eventCardDropdownMenuListItem;
var eventCardDropdownMenuToggleArrow;
var eventCardHeaderTitle;
var eventCardHeaderLocation;
var eventCardHeaderDate;
var eventCardContentFrame;

$(document).ready(function(e) {
	initControls();
	setListeners();
	getEventInfo(1);
});

function initControls() {
	eventCardDropdownMenuToggle = $('#event_card_dropdown_menu_toggle');
	eventCardDropdownMenuCurrentItem = $('#event_card_dropdown_menu_toggle span');
	eventCardDropdownMenu = $('#event_card_dropdown_menu');
	eventCardDropdownMenuList = $('#event_card_dropdown_menu ul');
	eventCardDropdownMenuListItem = $('#event_card_dropdown_menu li');
	eventCardDropdownMenuToggleArrow = $('#event_card_dropdown_menu_toggle_arrow');
	eventCardHeaderTitle = $('#event_card_header_title');
	eventCardHeaderLocation = $('#event_card_header_location');
	eventCardHeaderDate = $('#event_card_header_date');
	eventCardContentFrame = $('#event_card_content_frame');
}

function setListeners() {
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
	
	$('#event_card_dropdown_menu li').on('click', function() {
		alert('a');
	});
}

function getEventInfo(id) {
	var formData = new FormData();
	
	formData.append('id', id);
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
				eventCardHeaderDate.html(data.result.startDate + ' - ' + data.result.endDate);
				
				if (data.result.entityGroups.length > 0) {
					eventCardDropdownMenuCurrentItem.html(data.result.entityGroups[0].name);
					getEntities(data.result.entityGroups[0].id);
					
					for (var i = 0; i < data.result.entityGroups.length; i++)
						eventCardDropdownMenuList.append('<li data-id="'  + data.result.entityGroups[i].id + '">' + data.result.entityGroups[i].name + '</li>');
				}
			} else {
				alert(data.errorMessage);
			}
		},
		error: function(data) {
			alert('error');
		}
	});
}

function getEntities(id) {
	var formData = new FormData();
	
	formData.append('id', id);
	$.ajax({
		url: 'request.php?module=event&do=getEntities',
		dataType: 'json',
		cache: false,
		type: 'POST',
		processData: false,
		contentType: false,
		data: formData,
		success: function(data) {
			if (data.success) {
				if (data.result.length > 0) {
					var colorCodeIndex = 1;
					var result = '';
					
					for (var i = 0 ; i < data.result.length && i < 6; i++) {
						if ((i + 1) % 2 == 0)
							result = result + createNewEntityCard(colorCodeIndex++, data.result[i].id, data.result[i].name, data.result[i].description) + '</div>';
						else
							result = result + '<div class="row">' + createNewEntityCard(colorCodeIndex++, data.result[i].id, data.result[i].name, data.result[i].description);
					}
					
					eventCardContentFrame.append(result);
				}
			} else {
				alert(data.errorMessage);
			}
		},
		error: function(data) {
			alert('error');
		}
	});
}

function createNewEntityCard(colorCodeID, id, name, description) {
	var element;
	
	if (description == null) description = 'No description available at the moment.';
	
	element = '<div class="col-lg-6"> <div class="card"> <div class="event_card_content_entity_card_title event_card_content_bg_color_' + colorCodeID + '">' + name + '</div>';
	element = element + '<div class="event_card_content_entity_card_description_area"> <div class="event_card_content_text_color_' + colorCodeID + '">DESCRIPTION</div> <hr>';
	element = element + '<div>' + description  + '</div> </div> <div class="event_card_content_entity_card_buttons_area">';
	element = element + '<button class="text_button event_card_content_text_color_' + colorCodeID + '">MORE</button> </div> <div class="event_card_content_entity_card_clear"></div> </div> </div>';
	
	return element;
}