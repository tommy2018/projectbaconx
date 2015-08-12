<?php
include_once 'system/classes/class-template.php';

$template = new Template();
$userSession = UserSession::getInstance();
$user = $userSession->isSignedIn();
$pageID = 'HOME';

include_once 'controller-global.inc.php';

$template->addStylesheet('stylesheets/home/home.css');

$template->assign('navPageTitle', $pageID);
$template->setTitle($pageID);


$template->display('template-home');
?>