<?php
include_once 'system/functions-common.php';
include_once 'system/class-template.php';

$template = new Template();

$template->setTitle('Testing template');
$template->addStylesheet('stylesheets/home.css');
$template->addScript('scripts/jquery-1.11.3.min.js');

$template->assign('username', 'Tommy');

$template->display('template-home');
?>