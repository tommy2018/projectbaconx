<?php
function hashString($string) {
	return hash('sha256', $string);
}

function randomString($length = 15) {
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	$charsLength = strlen($chars);
	$string = '';
	
	for ($i = 0; $i < $length; $i++) $string .= $chars[rand(0, $charsLength - 1)];
	
	return $string;
}

function fatalError($errorMsg) {
	include_once DOC_ROOT . 'templates/template-error.php';
	die();
}
?>