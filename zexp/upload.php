<?php
/*
if (!isset($_GET['chunk'])) exit(json_encode(array('success' => false, 'errorMessage' => '3')));
if (!isset($_FILES['file'])) exit(json_encode(array('success' => false, 'errorMessage' => '1')));
if ($_FILES['file']['error'] > 0) exit(json_encode(array('success' => false, 'errorMessage' => '2')));


move_uploaded_file($_FILES['file']['tmp_name'], $storeDir . $_GET['chunk']);
echo(json_encode(array('success' => true, 'errorMessage' => 'Something went wrong!')));
*/
define('STORE_ROOT', 'files' . DIRECTORY_SEPARATOR);
define('CHUNK_SIZE', 1572864);

if (!isset($_GET['request'])) errorHandler(array('success' => false, 'errorMessage' => '---'));

$request = $_GET['request'];

switch ($request) {
	case "requestToken":
		$result = requestTokenHandler();
		break;
	case "transmit":
		$result = transmitHandler();
		break;
	default:
		errorHandler(array('success' => false, 'errorMessage' => '---'));
		break;
}

if (array_key_exists('success', $result)) {
	header('Content-Type: application/json');
	exit(json_encode($result));
}

function errorHandler($content) {
	header('Content-Type: application/json');
	exit(json_encode($content));
}

function requestTokenHandler() {
	if (!isset($_POST['filename'])) return(array('success' => false, 'errorMessage' => 'Invalid request'));
	if (!isset($_POST['size'])) return(array('success' => false, 'errorMessage' => 'Invalid request'));
	
	$token = 'ie9dkw2lv93nvls34js9452m';
	$storeDir = STORE_ROOT . $token;
	
	mkdir($storeDir);
	touch($storeDir . DIRECTORY_SEPARATOR . 'combined_file');

	return array('success' => true, 'token' => $token, 'chunkSize' => CHUNK_SIZE);
}

function transmitHandler() {
	if (!isset($_POST['token'])) return(array('success' => false, 'errorMessage' => 'Invalid request'));
	if (!isset($_POST['chunk'])) return(array('success' => false, 'errorMessage' => 'Invalid request'));
	if (!isset($_FILES['file'])) return(array('success' => false, 'errorMessage' => 'Invalid request'));
	if (!preg_match('/^[1-9][0-9]*$/', $_POST['chunk'])) return(array('success' => false, 'errorMessage' => 'Invalid request'));
	if ($_FILES['file']['error'] > 0) return(array('success' => false, 'errorMessage' => 'Transmission error'));
	if ($_FILES['file']['size'] > CHUNK_SIZE) return(array('success' => false, 'errorMessage' => 'Invalid request'));
	
	$token = $_POST['token'];
	$chunk = intval($_POST['chunk']);
	$storeDir = STORE_ROOT . $token . DIRECTORY_SEPARATOR;
	$chunkFilePath = $storeDir . 'chunk_file';
	$combinedFilePath = $storeDir . 'combined_file';
	
	if (is_writable($storeDir) && is_dir($storeDir)) {
		if (move_uploaded_file($_FILES['file']['tmp_name'], $chunkFilePath)) {
			if (is_writable($combinedFilePath)) {
				if (($chunkFile = fopen($chunkFilePath, 'rb')) && ($combinedFile = fopen($combinedFilePath, 'ab'))) {
					$data = fread($chunkFile, filesize($chunkFilePath));
					
					fwrite($combinedFile, $data);
					
					fclose($chunkFile);
					fclose($combinedFile);
					unlink($chunkFilePath);
					
					return (array('success' => true));
				}
			}
		}
	}
	
	return (array('success' => false, 'errorMessage' => 'Internal server error'));
}
?>