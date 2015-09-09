<?php
require_once 'system/classes/class-template.php';

/* Template init set-up */
$template = new Template();
$userSession = UserSession::getInstance();
$user = $userSession->isSignedIn();
$pageID = 'HOME';

/* Include controller-global.inc.php */
include_once 'controller-global.inc.php';

/* Set-up the template */
$template->addScript('scripts/home/home.js');
$template->addStylesheet('stylesheets/home/home.css');

$template->assign('navPageTitle', $pageID);
$template->setTitle($pageID);

$template->display('template-home');
?>