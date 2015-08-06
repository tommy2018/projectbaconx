<?php
include_once 'system/classes/class-userSession.php';
include_once 'system/classes/class-user.php';

class UserRequest {
	public function processRequest() {
		if (!isset($_GET['do'])) return array(false, 'Invalid request');
		
		$do = $_GET['do'];
		
		switch ($do) {
			case 'signin':
				return $this->signIn();
			case 'signout':
				return $this->signOut();
			case 'changePassword':
				return $this->chnagePassword();
			default:
				return array(false, 'Invalid request');
		}
	}
	
	private function signIn() {
		if (!isset($_POST['username'])) return array(false, 'Invalid request');
		if (!isset($_POST['password'])) return array(false, 'Invalid request');
		
		$userSession = UserSession::getInstance();
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if ($user = $userSession->signIn($username, $password))
			return array(true, array('uid' => $user->getUID(), 'username' => $user->getUsername()));
		else
			return array(false, 'Invalid credentials');
	}
	
	private function signOut() {
		$userSession = UserSession::getInstance();
		$userSession->signOut();
		
		return array(true);
	}
	
	private function chnagePassword() {
		$userSession = UserSession::getInstance();
		
		if (!$user = $userSession->isSignedIn()) return array(false, 'Invalid request');
		if (!isset($_POST['oldPassword'])) return array(false, 'Invalid request');
		if (!isset($_POST['newPassword'])) return array(false, 'Invalid request');
		
		$oldPassword = $_POST['oldPassword'];
		$newPassword = $_POST['newPassword'];
		
		if ($user->changePassword($oldPassword, $newPassword))
			return array(true); 
		else
			return array(false, 'Unable to change your password, please check the old password you entered is correct.');
	}
}
?>