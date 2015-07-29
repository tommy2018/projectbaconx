<?php
include_once 'global.inc.php';
header('Content-Type: application/json');

if (!isset($_GET['module']))
	exit(json_encode(array('success' => false, 'errorMsg' => 'Invalid request')));

$module = $_GET['module'];

switch ($module) {
	case 'login':
		break;
	default:
		echo(json_encode(array('success' => false, 'errorMsg' => 'Invalid request')));
}
?>