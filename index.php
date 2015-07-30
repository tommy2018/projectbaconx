<?php
include_once 'global.inc.php';
include_once 'controllers/controller-home.php';
include_once 'system/classes/class-userSession.php';

$userSession = UserSession::getInstance();

if ($_GET['request'] == 'login') $userSession->signIn('tommy', 'password');

if ($user = $userSession->isSignedIn())
	echo($user->getUsername());
else
	echo("FALSE");
?>