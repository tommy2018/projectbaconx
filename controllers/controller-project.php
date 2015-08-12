<?php
include_once 'system/classes/class-template.php';

$template = new Template();
$userSession = UserSession::getInstance();
$user = $userSession->isSignedIn();
$pageID = 'PROJECT';

include_once 'controller-global.inc.php';

$template->addStylesheet('stylesheets/project.css');

$template->setTitle($pageID);
$template->assign('navPageTitle', $pageID);

$template->display('template-project');
?>