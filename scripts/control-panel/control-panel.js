// JavaScript Document
var currentSettingGroup = '';
var currentSettingPanel = '';


$(document).ready(function(e) {
    
});

function switchSettingPanel(fileName) {
	return function() {
		var filePath = 'html/' + fileName;
		$.ajax({
			url: filePath,
			cache: false,
			success: function(data) {
				currentSettingPanel = fileName;
				$('#control_panel_setting_area').html(data);
			},
			error: function() {
				$('#control_panel_setting_area').html('ERROR');
			}
		});
	}
}

function switchSettingGroup(fileName) {
}