<?php
require_once 'system/classes/class-template.php';
require_once 'system/classes/class-entity.php';

$template = new Template();
$userSession = UserSession::getInstance();
$user = $userSession->isSignedIn();
$pageID = 'PROJECT';

include_once 'controller-global.inc.php';

$template->addStylesheet('stylesheets/project/project.css');

$template->setTitle($pageID);
$template->assign('navPageTitle', $pageID);

/* Get the details of the requested project */
if (!isset($_GET['id'])) fatalError('Unable to find the resource you requested.', 404);
if (!preg_match('/^[1-9][0-9]*$/', $_GET['id'])) fatalError('Unable to find the resource you requested.', 404);

$projectID = $_GET['id'];
$info = Entity::getEntityInfoByID($projectID);

if (!$info) fatalError('Unable to find the resource you requested.', 404);
$template->assign('info', $info);

$template->display('template-project');
?>