<?php
function hashString($string) {
	return hash('sha256', $string);
}

function fatalError($errorMsg) {
	include_once DOC_ROOT . 'templates/template-error.php';
	die();
}
?>