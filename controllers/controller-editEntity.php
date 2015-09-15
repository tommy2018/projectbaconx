<?php
require_once 'system/classes/class-entity.php';
require_once 'system/classes/class-template.php';

/* Template init set-up */
$template = new Template();
$userSession = UserSession::getInstance();
$user = $userSession->isSignedIn();
$pageID = 'EDIT PROJECT';

/* Get the details of the requested project */
if (!isset($_GET['id'])) fatalError('Unable to find the resource you requested.', 404);
if (!isset($_GET['tab'])) $tab = null; else $tab = $_GET['tab'];
if (!preg_match('/^[1-9][0-9]*$/', $_GET['id'])) fatalError('Unable to find the resource you requested.', 404);
$projectID = $_GET['id'];
$entity = Entity::getEntityByID($projectID);

if (!$entity) fatalError('Unable to find the resource you requested.', 404);

/* Process post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!isset($_POST['formType'])) fatalError('Invalid request');
	
	$type = $_POST['formType'];
	
	switch ($type) {
		case 'additionalAttributes':
			
			break;
		case 'basicInformation':
			if (!isset($_POST['name'])) fatalError('Invalid request');
			if (!isset($_POST['description'])) fatalError('Invalid request');
			
			$name = $_POST['name'];
			$description = $_POST['description'];
			
			//Check user input
			$name = processUserInput($name);
			$description = processUserInput($description);
			
			if (!checkUserInput($name, UserInputType::nonEmptyString)) {
				$template->assign('errorMessage','Entity title cannot be empty');
				break;
			}
			
			if ($entity->getName() != $name || $entity->getDescription() != $description)
				$entity->updateEntityNameAndDescription($name, $description);
			break;
		default:
			fatalError('Invalid request');
	}
}*/

/* Include controller-global.inc.php */
include_once 'controller-global.inc.php';

/* Set-up the template */
switch ($tab) {
	case 'basic':
		$template->assign('tab', 'basic');
		break;
	case 'other-attributes':
		$template->assign('tab', 'otherAttributes');
		break;
	case 'media':
		$template->assign('tab', 'media');
		break;
	default:
		$template->assign('tab', 'basic');
}

$template->assign('navPageTitle', $pageID);
$template->setTitle($pageID);
$template->addStylesheet('stylesheets/edit-entity/edit-entity.css');

$template->assign('entity', $entity);
$template->display('template-editEntity');
?>