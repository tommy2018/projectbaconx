<?php
include_once 'global.inc.php';

if (!isset($_GET['module'])) $module = null; else $module = $_GET['module'];

try {
	switch ($module) {
		case null:
		case 'home':
			include_once 'controllers/controller-home.php';
			break;
		case 'project':
			include_once 'controllers/controller-project.php';
			break;
		case 'control-panel':
			include_once 'controllers/controller-controlPanel.php';
			break;
		default:
			fatalError('The page you requested couldn\'t be found.', 404);
			break;
	}
} catch (Exception $e) {
	fatalError($e->getMessage());
}
?>