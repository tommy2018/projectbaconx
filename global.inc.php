<?php
include_once 'system/config.inc.php';
include_once 'system/functions/functions-common.php';

define('DOC_ROOT', __DIR__ . DIRECTORY_SEPARATOR);
session_name($setting['core']['sessionName']);
session_start();
?>