<?php
include_once 'config.inc.php';

define('DOC_ROOT', __DIR__ . '/');
session_name($setting['core']['sessionName']);
session_start();
?>