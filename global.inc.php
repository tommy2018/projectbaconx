<?php
require_once 'config.inc.php';
require_once 'system/functions/functions-common.php';
require_once 'system/classes/class-database.php';
require_once 'system/classes/class-userSession.php';
require_once 'system/classes/class-pbxException.php';
require_once 'system/constants/constant-system.php';
require_once 'system/classes/class-systemSetting.php';

define('DOC_ROOT', __DIR__ . DIRECTORY_SEPARATOR);
session_name($setting['core']['sessionName']);
session_start();
?>