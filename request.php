<?php
include_once 'global.inc.php';
include_once 'system/classes/class-request.php';

if (!isset($_GET['module'])) errorHandler(array('success' => false, 'errorMessage' => 'Invalid request'));

$module = $_GET['module'];
$request = null;

switch ($module) {
	case 'account':
		include_once 'system/requests/request-account.php';
		$request = new AccountRequest();
		break;
	case 'event':
		include_once 'system/requests/request-event.php';
		$request = new EventRequest();
		break;	
	default:
		exit(json_encode(array('success' => false, 'errorMessage' => 'Invalid request')));
		break;
}

$result = $request->processRequest();

if (array_key_exists('success', $result)) {
	header('Content-Type: application/json');
	exit(json_encode($result));
}

function errorHandler($content) {
	header('Content-Type: application/json');
	exit(json_encode($content));
}
?>