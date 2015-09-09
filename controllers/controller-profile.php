<?php
require_once 'system/classes/class-template.php';

/* Template init set-up */
$template = new Template();
$userSession = UserSession::getInstance();
$user = $userSession->isSignedIn();
$pageID = 'PROFILE';

if ($user) {
	require_once 'controller-global.inc.php';

	$template->assign('navPageTitle', $pageID);
	$template->setTitle($pageID);

	$template->display('template-profile');
} else
	fatalError('You don\'t have the required permission to access the resource.', 403);
?>