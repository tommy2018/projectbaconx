<?php
include_once 'system/config.inc.php';
include_once 'system/functions/functions-common.php';
include_once 'system/classes/class-database.php';
include_once 'system/classes/class-userSession.php';
include_once 'system/classes/class-pbxException.php';

define('DOC_ROOT', __DIR__ . DIRECTORY_SEPARATOR);
session_name($setting['core']['sessionName']);
session_start();
?>