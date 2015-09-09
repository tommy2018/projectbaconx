<?php
include_once 'config.inc.php';
include_once 'system/functions/functions-common.php';
include_once 'system/classes/class-database.php';
include_once 'system/classes/class-userSession.php';
include_once 'system/classes/class-pbxException.php';
include_once 'system/constants/constant-system.php';

session_name($setting['core']['sessionName']);
session_start();
?>