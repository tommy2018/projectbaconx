// JavaScript Document
var cpMenuToggle;
var cpMenuToggleName;
var cpMenuDropdown;
var cpMenuDropdownArrow;
var cpMenuDropdownItem;
var cpOptionListItem;

$(document).ready(function(e) {
	initControls();
	
	cpMenuDropdownItem.on('click', function() {
		switchSideNavigation($(this).data('file'));
		cpMenuToggleName.html($(this).data('name'));
	});
	
	cpMenuToggle.on('click', function() {
		if (cpMenuDropdown.is(":visible")) {
			cpMenuDropdown.hide();
			cpMenuDropdownArrow.removeClass('fa-chevron-up');
			cpMenuDropdownArrow.addClass('fa-chevron-down');
		} else {
			cpMenuDropdown.show();
			cpMenuDropdownArrow.removeClass('fa-chevron-down');
			cpMenuDropdownArrow.addClass('fa-chevron-up');
		}
	});
});

function switchSettingPanel(fileName) {
	var filePath = 'html/' + fileName;
	
	$.ajax({
		url: filePath,
		cache: false,
		success: function(data) {
			$('#control_panel_setting_area').html(data);
		},
		error: function() {
			$('#control_panel_setting_area').html('ERROR');
		}
	});
}

function switchSideNavigation(fileName) {
	var filePath = 'html/' + fileName;
	
	$.ajax({
		url: filePath,
		cache: false,
		success: function(data) {
			$('#control_panel_options_list').html(data);
			udpateOptionListControls();
		},
		error: function() {
			$('#control_panel_options_list').html('ERROR');
		}
	});
}

function initControls() {
	cpMenuToggle = $('#control_panel_menu_toggle');
	cpMenuToggleName = $('#control_panel_menu_toggle_name');
	cpMenuDropdown = $('#control_panel_menu_dropdown');
	cpMenuDropdownArrow = $('#control_panel_menu_toggle_arrow');
	cpMenuDropdownItem = $('#control_panel_menu_dropdown li');
	cpOptionListItem = $('#control_panel_options_list div');
}

function udpateOptionListControls() {
	cpOptionListItem = $('#control_panel_options_list div');
	
	cpOptionListItem.on('click', function() {
		switchSettingPanel($(this).data('file'));
		cpOptionListItem.removeClass('control_panel_options_list_selected');
		$(this).addClass('control_panel_options_list_selected');
	});
}