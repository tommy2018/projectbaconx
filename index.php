<?php
include_once 'global.inc.php';
include_once 'system/functions-common.php';

if (isset($_GET['module'])) {
	$module = $_GET['module'];
	
	switch ($moudle) {
		default:
			fatalError('No such module');
	}	
} else
	include_once 'controllers/controller-home.php';
?>