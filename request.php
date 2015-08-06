<?php
include_once 'global.inc.php';

if (!isset($_GET['module'])) response(array(false, 'Invalid request'));

$module = $_GET['module'];
$request = null;

/* START OF REQUEST ROUTER */

switch ($module) {
	case 'user':
		include_once 'system/requests/request-user.php';
		$request = new UserRequest();
		break;
	case 'event':
		include_once 'system/requests/request-event.php';
		$request = new EventRequest();
		break;
	default:
		response(array(false, 'Invalid request'));
}

/* END OF REQUEST ROUTER */

if ($request) $result = $request->processRequest();
if (isset($result)) response($result); else response(array(false));

function response($array) {
	header('Content-Type: application/json');
	
	if ($array[0] == true) (array_key_exists(1, $array)) ? exit(json_encode(array('success' => true, 'result' => $array[1]))) : exit(json_encode(array('success' => true)));
	else if ($array[0] == false && array_key_exists(1, $array)) exit(json_encode(array('success' => false, 'errorMessage' => $array[1])));
	else exit(json_encode(array('success' => false, 'errorMessage' => 'Unexpected error')));
}
?>