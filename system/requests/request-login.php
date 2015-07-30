<?php
include_once 'system/classes/class-user.php';

function processRequest() {
	if (!isset($_POST['username'])) return(array('success' => false, 'errorMessage' => 'Invalid request'));
	if (!isset($_POST['password'])) return(array('success' => false, 'errorMessage' => 'Invalid request'));
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if ($user = User::login($username, $password))
		return(array('success' => true, 'uid' => $user->getUID(), 'username' => $user->getUsername()));
	else
		return(array('success' => false, 'errorMessage' => 'Invalid credentials'));
}
?>