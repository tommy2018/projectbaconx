<?php
require_once 'system/classes/class-template.php';
require_once 'system/classes/class-entity.php';

/* Template init set-up */
$template = new Template();
$userSession = UserSession::getInstance();
$user = $userSession->isSignedIn();
$pageID = 'EDIT PROJECT';

/* Include controller-global.inc.php */
include_once 'controller-global.inc.php';

/* Set-up the template */
$template->assign('navPageTitle', $pageID);
$template->setTitle($pageID);
$template->addStylesheet('stylesheets/edit-entity/edit-entity.css');

/* Get the details of the requested project */
if (!isset($_GET['id'])) fatalError('Unable to find the resource you requested.', 404);
if (!preg_match('/^[1-9][0-9]*$/', $_GET['id'])) fatalError('Unable to find the resource you requested.', 404);

$projectID = $_GET['id'];
$entity = Entity::getEntityByID($projectID);

if (!$entity) fatalError('Unable to find the resource you requested.', 404);
$template->assign('entity', $entity);

$template->display('template-editEntity');
?>