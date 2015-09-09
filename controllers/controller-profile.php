<?php
require_once 'system/classes/class-template.php';

/* Template init set-up */
$template = new Template();
$userSession = UserSession::getInstance();
$user = $userSession->isSignedIn();
$pageID = 'PROFILE';

/* Include controller-global.inc.php */
require_once 'controller-global.inc.php';

/* Set-up the template */
$template->assign('navPageTitle', $pageID);
$template->setTitle($pageID);

$template->display('template-profile');
?>