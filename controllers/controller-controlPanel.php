<?php
require_once 'system/classes/class-template.php';

$template = new Template();
$userSession = UserSession::getInstance();
$user = $userSession->isSignedIn();
$pageID = 'CONTROL PANEL';

/* USER PERMISSION TO BE CHECKED */

if ($user) {
	include_once 'controller-global.inc.php';
	
	$template->addScript('https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.jquery.min.js');
	$template->addScript('https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/bloodhound.js');
	$template->addScript('scripts/control-panel/control-panel.js');
	$template->addStylesheet('stylesheets/control-panel/control-panel.css');
	
	$template->setTitle($pageID );
	$template->assign('navPageTitle', $pageID);
	
	$template->display('template-controlPanel');
} else
	fatalError('You don\'t have the required permission to access the resource.', 403);
?>