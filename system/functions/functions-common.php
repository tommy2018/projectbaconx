<?php
class UserInputType {
	const string = 0;
	const nonEmptyString = 1;
	const numberStartsWithZero = 2;
	const numberStartsWithNonZero = 3;
	const url = 4;
	const email = 5;
}

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

function processUserInput($value) {
	$processedString = trim($value);
	//$processedString = strip_tags($processedString);
	$processedString = htmlspecialchars($processedString);
	if (strlen($processedString) <= 0) $processedString = null;
	
	return $processedString;
}

function checkUserInput($value, $type) {
	$processedString = trim($value);
	
	switch ($type) {
		case UserInputType::string:
			return true;
			break;
		case UserInputType::nonEmptyString:
			if (strlen($processedString) <= 0) return false; else return true;
			break;
		case UserInputType::numberStartsWithNonZero:
			if (preg_match('/^[1-9][0-9]*$/', $processedString)) return true; else return false;
			break;
		case UserInputType::numberStartsWithZero:
			if (preg_match('/^[0-9]*$/', $processedString)) return true; else return false;
			break;
		case UserInputType::url:
			break;
		case UserInputType::email:
			break;
		default:
			return false;
	}
}
?>