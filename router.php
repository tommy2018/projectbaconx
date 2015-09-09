<?php
require_once 'global.inc.php';

if (!isset($_GET['module'])) $module = null; else $module = $_GET['module'];

try {
	switch ($module) {
		case null:
		case 'home':
			require_once 'controllers/controller-home.php';
			break;
		case 'project':
			require_once 'controllers/controller-project.php';
			break;
		case 'control-panel':
			require_once 'controllers/controller-controlPanel.php';
			break;
		case 'profile':
			require_once 'controllers/controller-profile.php';
			break;
		case 'dashboard':
			break;
		case 'dashboard':
			break;
		default:
			fatalError('The page you requested couldn\'t be found.', 404);
			break;
	}
} catch (Exception $e) {
	fatalError($e->getMessage());
}
?>