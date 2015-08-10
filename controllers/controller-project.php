<?php
include_once 'system/classes/class-template.php';

$template = new Template();

$template->setTitle('HOME');
$template->addScript('scripts/jquery-1.11.3.min.js');
$template->addStylesheet('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
$template->addScript('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js');
$template->addStylesheet('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
$template->addScript('scripts/header.js');
$template->addStylesheet('stylesheets/global.css');
$template->addStylesheet('stylesheets/header.css');

$template->addStylesheet('stylesheets/project.css');

$template->assign('username', 'Tommy');

$template->display('template-project');
?>