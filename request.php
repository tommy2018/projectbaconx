<?php
include_once 'global.inc.php';

if (!isset($_GET['module'])) errorHandler(array('success' => false, 'errorMessage' => 'Invalid request'));

$module = $_GET['module'];

switch ($module) {
	case 'login':
		include_once 'system/requests/request-login.php';
		$result = processRequest();
		break;
	default:
		echo(json_encode(array('success' => false, 'errorMessage' => 'Invalid request')));
		break;
}

if (array_key_exists('success', $result)) {
	header('Content-Type: application/json');
	exit(json_encode($result));
}

function errorHandler($content) {
	header('Content-Type: application/json');
	exit(json_encode($content));
}
?>