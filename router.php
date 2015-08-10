<?php
include_once 'global.inc.php';

if (!isset($_GET['module'])) $module = null; else $module = $_GET['module'];

switch ($module) {
	case null:
	case 'home':
		break;
	case 'project':
		include_once 'controllers/controller-project.php';
		break;
	case 'control-panel':
		include_once 'controllers/controller-controlPanel.php';
		break;
	case 'default':
		break;
}
?>