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

function fatalError($errorMessage, $errorCode = 500) {
	ob_clean();
	http_response_code($errorCode);
	include_once DOC_ROOT . 'templates/template-error.php';
	die();
}

// function isNumber($number, $isStartWithZero) {
// 	if ($isStartWithZero)
// 		return preg_match('/^[0-9]*$/', $number);
// 	else
// 		return preg_match('/^[1-9][0-9]*$/', $subject);
// }
?>