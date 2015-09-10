// JavaScript Document
var cpMenuToggle;
var cpMenuToggleName;
var cpMenuDropdown;
var cpMenuDropdownArrow;
var cpMenuDropdownItem;
var cpOptionListItem;
var cpOptionList;
var cpSettingArea;
var currentSettingPanelMenu;
var cpOptionListSelectedClassName;

$(document).ready(function(e) {
	cpMenuToggle = $('#control_panel_card_menu_toggle');
	cpMenuToggleName = $('#control_panel_card_menu_toggle_name');
	cpMenuDropdown = $('#control_panel_card_menu_dropdown');
	cpMenuDropdownArrow = $('#control_panel_card_menu_toggle_arrow');
	cpMenuDropdownItem = $('#control_panel_card_menu_dropdown li');
	cpOptionListItem = $('#control_panel_card_option_list div');
	cpSettingArea = $('#control_panel_card_setting_area');
	cpOptionList = $('#control_panel_card_option_list');
	cpOptionListSelectedClassName = 'control_panel_card_option_list_selected';
	
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

function switchSideNavigation(fileName) {
	var filePath = 'html/' + fileName;
	
	$.ajax({
		url: filePath,
		cache: false,
		success: function(data) {
			cpOptionList.html(data);
			switchSettingPanelMenu(cpOptionList.children('div').first());
			udpateOptionListControls();
		},
		error: function() {
			cpOptionList.html('ERROR');
		}
	});
}

function switchSettingPanelMenu(element) {
	var fileName = element.data('file');
	var filePath = 'html/' + fileName;
	
	$.ajax({
		url: filePath,
		cache: false,
		success: function(data) {
			cpSettingArea.html(data);
			currentSettingPanelMenu = element;
			updateSettingPanelOptionListControls();
		},
		error: function() {
			cpSettingArea.html('ERROR');
		},
		complete: function() {
			cpOptionListItem.removeClass(cpOptionListSelectedClassName);
			element.addClass(cpOptionListSelectedClassName);
		}
	});
}

function switchSettingPanel(element) {
	var fileName = element.data('file');
	var filePath = 'html/' + fileName;
	
	$.ajax({
		url: filePath,
		cache: false,
		success: function(data) {
			cpSettingArea.html(data);
			updateBackButtonControl();
		},
		error: function() {
			cpSettingArea.html('ERROR');
		}
	});
}

function udpateOptionListControls() {
	cpOptionListItem = $('#control_panel_card_option_list div');
	
	cpOptionListItem.on('click', function() {
		switchSettingPanelMenu($(this));
	});
}

function updateSettingPanelOptionListControls() {
	var spOptionListItems = $('.control_panel_card_sub_option_list div');
	
	spOptionListItems.on('click', function() {
		switchSettingPanel($(this));
	});
}

function updateBackButtonControl() {
	var backButton = $('.control_panel_card_title_back_button');
	
	backButton.on('click', function() {
		switchSettingPanelMenu(currentSettingPanelMenu);
	});
}