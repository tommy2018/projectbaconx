<?php
if ($template) {
	/* Common scripts and stylesheets */
	$template->addScript('scripts/libraries/jquery-1.11.3.min.js');
	$template->addStylesheet('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
	$template->addScript('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js');
	$template->addStylesheet('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
	$template->addStylesheet('stylesheets/global/global.css');
	
	/* Set up header and header nav menu */
	if ($user) {
		$template->assign('user', $user);
		$template->addScript('scripts/header/header.js');
		$template->addStylesheet('stylesheets/header/header.css');
		
		$headerNavMenuItems = [];
		$headerNavMenuItems[] = array('HOME', '/home');
		$headerNavMenuItems[] = array('DASHBOARD', '/dashboard');
		$headerNavMenuItems[] = array('PROFILE', '/profile');
		$headerNavMenuItems[] = array('CONTROL PANEL', '/control-panel');
		
		if (isset($pageID)) $template->assign('pageID', $pageID);
		
		$template->assign('headerNavMenuItems', $headerNavMenuItems);
	} else {
		$template->addScript('scripts/header/header-guest.js');
		$template->addStylesheet('stylesheets/header/header-guest.css');
	}	
}
?>