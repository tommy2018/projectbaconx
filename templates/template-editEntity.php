<script>
var cardTitle;
var basicPanel;
var otherAttributesPanel;
var mediaPanel;
var tabPanelMenuList;
var tabPanelTabs;
var switchWarning;
var basicInfoForm;
var basicInfoFormButtonArea;
var basicInfoFormProcessingMessage;
var otherAttributesForm;
var otherAttributesFormButtonArea;
var otherAttributesFromProcessingMessage;
var basicInfoFormErrorMsgArea;
var basicInfoFormInfoMsgArea;
var otherAttributesFormErrorMsgArea;
var otherAttributesFormInfoMsgArea;

$(document).ready(function(e) {
	cardTitle = $('#entity_edit_card_menu_title');
    basicPanel = $('#entity_edit_card_basic_panel');
	otherAttributesPanel = $('#entity_edit_card_other_attributes_panel');
	mediaPanel = $('#entity_edit_card_media_panel');
	tabPanelMenuList = $('#entity_edit_card_tab_panel_menu_list');
	tabPanelTabs = $('.tab_panel_content_tab');
	basicInfoForm = $('#entity_edit_card_basic_info_form');
	basicInfoFormButtonArea = $('#entity_edit_card_basic_info_form .tab_panel_content_tab_bottom_button_area');
	basicInfoFormProcessingMessage = $('#entity_edit_card_basic_info_form .tab_panel_content_tab_bottom_processing_message');
	otherAttributesForm = $('#entity_edit_card_other_attributes_form');
	otherAttributesFormButtonArea = $('#entity_edit_card_other_attributes_form .tab_panel_content_tab_bottom_button_area');
	otherAttributesFormProcessingMessage = $('#entity_edit_card_other_attributes_form .tab_panel_content_tab_bottom_processing_message');
	basicInfoFormErrorMsgArea = $('#entity_edit_card_basic_panel .tab_panel_content_error_message');
	basicInfoFormInfoMsgArea = $('#entity_edit_card_basic_panel .tab_panel_content_info_message');
	otherAttributesFormErrorMsgArea = $('#entity_edit_card_other_attributes_panel .tab_panel_content_error_message');
	otherAttributesFormInfoMsgArea = $('#entity_edit_card_other_attributes_panel .tab_panel_content_info_message');
	
	tabPanelMenuList.children('li').on('click', function() {
		tabPanelSwitchPanel($(this));
	});
	
	basicInfoForm.on('submit', function() {
		updateBasicInfo(this);
		return false;
	});
	
	otherAttributesForm.on('submit', function() {
		updateOtherAttributes(this)
		return false;
	})
});

function tabPanelSwitchPanel(item) {
	if (switchWarning != null) {
		var decision = confirm(switchWarning);
		if (!decision) return;
	}
	
	tabPanelMenuList.children('li').removeClass('tab_panel_menu_current_title');
	item.addClass('tab_panel_menu_current_title');
	tabPanelTabs.hide();
	$(item.data('panel_id')).show();
}

function updateOtherAttributes(form) {
	$.ajax({
		type: 'POST',
		url: 'request.php?module=entity&do=update-additional-attributes',
		dataType: 'json',
		data: $(form).serialize(),
		beforeSend: function() {
			otherAttributesFormInfoMsgArea.hide();
			otherAttributesFormErrorMsgArea.hide();
			otherAttributesFormButtonArea.hide();
			otherAttributesFormProcessingMessage.show();
		},
		success: function(data) {
			if (data.success) {
				otherAttributesFormInfoMsgArea.html('<i class="fa fa-info-circle"></i> ' + 'Saved');
				otherAttributesFormInfoMsgArea.show();
			} else {
				otherAttributesFormErrorMsgArea.html('<i class="fa fa-exclamation-circle"></i> ' + data.errorMessage);
				otherAttributesFormErrorMsgArea.show();
			}
		},
		error: function() {
			otherAttributesFormErrorMsgArea.html('<i class="fa fa-exclamation-circle"></i> ' + 'Unexpected error');
			otherAttributesFormErrorMsgArea.show();
		},
		complete: function() {
			otherAttributesFormButtonArea.show();
			otherAttributesFormProcessingMessage.hide();
		}
	});
}

function updateBasicInfo(form) {
	$.ajax({
		type: 'POST',
		url: 'request.php?module=entity&do=update-basic-information',
		dataType: 'json',
		data: $(form).serialize(),
		beforeSend: function() {
			basicInfoFormErrorMsgArea.hide();
			basicInfoFormInfoMsgArea.hide();
			basicInfoFormButtonArea.hide();
			basicInfoFormProcessingMessage.show();
		},
		success: function(data) {
			if (data.success) {
				basicInfoFormInfoMsgArea.html('<i class="fa fa-info-circle"></i> ' + 'Saved');
				basicInfoFormInfoMsgArea.show();
			} else {
				basicInfoFormErrorMsgArea.html('<i class="fa fa-exclamation-circle"></i> ' + data.errorMessage);
				basicInfoFormErrorMsgArea.show();
			}
		},
		error: function() {
			basicInfoFormErrorMsgArea.html('<i class="fa fa-exclamation-circle"></i> ' + 'Unexpected error');
			basicInfoFormErrorMsgArea.show();
		},
		complete: function() {
			basicInfoFormButtonArea.show();
			basicInfoFormProcessingMessage.hide();
		}
	});
}
</script>
<?php
include_once 'template-header.php';
if (!$entity = $this->getVar('entity')) fatalError('Unexpected error occurred when rendering the page.');
$addtitonalAttributes = $entity->getAdditionalAttributes();
?>

<div id="main">
  <div class="container-fluid" id="main_frame">
    <div class="row">
      <div class="col-md-12">
        <div class="card" id="entity_edit_card">
          <div id="entity_edit_card_menu"><i class="fa fa-cubes"></i> <span id="entity_edit_card_menu_title"><?php echo $entity->getName(); ?></span>
            <div id="entity_edit_card_menu_buttons"> <a href="<?php echo 'project/' . $entity->getID(); ?>"><i class="fa fa-check"></i> DONE</a> </div>
          </div>
          <div id="entity_card_tab_panel_area">
            <div class="tab_panel">
              <div class="tab_panel_header">
                <div class="tab_panel_title">Entity Settings Panel</div>
                <div class="tab_panel_menu">
                  <ul id="entity_edit_card_tab_panel_menu_list">
                    <li data-panel_id="#entity_edit_card_basic_panel" class="tab_panel_menu_current_title"> <i class="fa fa-info-circle"></i>BASIC</li>
                    <li data-panel_id="#entity_edit_card_other_attributes_panel"> <i class="fa fa-info-circle"></i>OTHER ATTRIBUTES</li>
                    <li data-panel_id="#entity_edit_card_media_panel"> <i class="fa fa-film"></i>MEDIA</li>
                  </ul>
                </div>
              </div>
              <div class="tab_panel_content">
                <div class="tab_panel_content_tab" id="entity_edit_card_basic_panel">
                  <div class="tab_panel_content_error_message"></div>
                  <div class="tab_panel_content_info_message"></div>
                  <form method="post" id="entity_edit_card_basic_info_form">
                    <input type="hidden" value="<?php echo $entity->getID(); ?>" name="id">
                    <div class="tab_panel_control"> <span class="tab_panel_control_title">Entity title</span>
                      <input type="text" class="form-control" name="name" value="<?php echo $entity->getName(); ?>">
                    </div>
                    <div class="tab_panel_control"> <span class="tab_panel_control_title">Description</span>
                      <textarea class="form-control" name="description" rows="10"><?php echo $entity->getDescription(); ?></textarea>
                    </div>
                    <hr>
                    <div class="tab_panel_content_tab_bottom_button_area">
                      <input type="submit" value="SAVE" class="text_button color_blue">
                    </div>
                    <div class="tab_panel_content_tab_bottom_processing_message"> <i class="fa fa-spinner fa-pulse"></i> Saving </div>
                    <div style="clear:both;"></div>
                  </form>
                </div>
                <div class="tab_panel_content_tab" id="entity_edit_card_other_attributes_panel">
                  <div class="tab_panel_content_error_message"></div>
                  <div class="tab_panel_content_info_message"></div>
                  <form method="post" id="entity_edit_card_other_attributes_form">
                    <input type="hidden" value="<?php echo $entity->getID(); ?>" name="id">
                    <?php
                  	foreach ($addtitonalAttributes as $addtitonalAttribute) {
                  		echo '<div class="tab_panel_control"> <span class="tab_panel_control_title">';
                  		echo $addtitonalAttribute->getName() . '</span>';
                  		echo $addtitonalAttribute->toHTMLElement('additionalAttributes' . '[' . $addtitonalAttribute->getName() . ']', 'form-control', null);
                  		echo '</div>';
                  	}
                  ?>
                    <hr>
                    <div class="tab_panel_content_tab_bottom_button_area">
                      <input type="submit" value="SAVE" class="text_button color_blue">
                    </div>
                    <div class="tab_panel_content_tab_bottom_processing_message"> <i class="fa fa-spinner fa-pulse"></i> Saving </div>
                    <div style="clear:both;"></div>
                  </form>
                </div>
                <div class="tab_panel_content_tab" id="entity_edit_card_media_panel"> MEDIA </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
