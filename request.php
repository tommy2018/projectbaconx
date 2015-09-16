<?php
require_once 'global.inc.php';

if (!isset($_GET['module'])) response(array(false, 'Invalid request'));

$module = $_GET['module'];
$request = null;

/* START OF REQUEST ROUTER */

switch ($module) {
	case 'user':
		require_once 'system/requests/request-user.php';
		$request = new UserRequest();
		break;
	case 'event':
		require_once 'system/requests/request-event.php';
		$request = new EventRequest();
		break;
	case 'entity':
		require_once 'system/requests/request-entity.php';
		$request = new EntityRequest();
		break;
	case 'control-panel':
		require_once 'system/requests/request-controlPanel.php';
		$request = new ControlPanelRequest();
		break;
	case 'system-setting':
		require_once 'system/requests/request-systemSetting.php';
		$request = new SystemSettingRequest();
		break;
	case 'tool':
		require_once 'system/requests/request-tool.php';
		$request = new ToolRequest();
		break;
	default:
		response(array(false, 'Invalid request'));
}

/* END OF REQUEST ROUTER */

try {
	if ($request) $result = $request->processRequest();
} catch (Exception $e) {
	response(array(false, 'System error: ' . $e->getMessage()));
}

if (isset($result)) response($result); else response(array(false));

function response($array) {
	header('Content-Type: application/json');
	
	if ($array[0] == true) (array_key_exists(1, $array)) ? exit(utf8_encode(json_encode(array('success' => true, 'result' => $array[1])))) : exit(json_encode(array('success' => true)));
	else if ($array[0] == false && array_key_exists(1, $array)) exit(json_encode(array('success' => false, 'errorMessage' => $array[1])));
	else exit(json_encode(array('success' => false, 'errorMessage' => 'Unexpected error')));
}
?>