<?php
include_once 'global.inc.php';
include_once 'system/classes/class-log.php';

if (!Log::newLog(1, 'Tommy',	'User logged in.'))
	echo('error');
?>