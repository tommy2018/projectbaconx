<?php
include_once 'system/classes/class-userSession.php';
include_once 'system/classes/class-user.php';

class AccountRequest {
	public function processRequest() {
		if (!isset($_GET['do'])) return(array('success' => false, 'errorMessage' => 'Invalid request'));
		
		$do = $_GET['do'];
		
		switch ($do) {
			case 'signin':
				return $this->signIn();
			case 'signout':
				return $this->signOut();
			default:
				return array('success' => false, 'errorMessage' => 'Invalid request');
		}
	}
	
	private function signIn() {
		if (!isset($_POST['username'])) return(array('success' => false, 'errorMessage' => 'Invalid request'));
		if (!isset($_POST['password'])) return(array('success' => false, 'errorMessage' => 'Invalid request'));
		
		$userSession = UserSession::getInstance();
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if ($user = $userSession->signIn($username, $password))
			return array('success' => true, 'uid' => $user->getUID(), 'username' => $user->getUsername());
		else
			return array('success' => false, 'errorMessage' => 'Invalid credentials');
	}
	
	private function signOut() {
		$userSession = UserSession::getInstance();
		$userSession->signOut();
		
		return array('success' => true);
	}
}
?>