<?php
include_once 'system/classes/class-userSession.php';
include_once 'system/classes/class-user.php';

class UserRequest {
	public function processRequest() {
		if (!isset($_GET['do'])) return array(false, 'Invalid request');
		
		$do = $_GET['do'];
		
		switch ($do) {
			case 'sign-in':
				return $this->signIn();
			case 'sign-out':
				return $this->signOut();
			case 'is-signed-in':
				return $this->isSignedIn();
			case 'change-password':
				return $this->chnagePassword();
			case 'is-username-used':
				return $this->isUsernameUsed();
			case 'change-email':
				return $this->changeEmail();
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
	
	private function isSignedIn() {
		$userSession = UserSession::getInstance();
		
		if ($user = $userSession->isSignedIn())
			return array(true, array('uid' => $user->getUID(), 'username' => $user->getUsername()));
		else
			return array(true, false);
	}
	
	private function chnagePassword() {
		$userSession = UserSession::getInstance();
		
		if (!$user = $userSession->isSignedIn()) return array(false, 'Invalid request');
		if (!isset($_POST['password'])) return array(false, 'Invalid request');
		
		$password = $_POST['password'];
		
		if (!$user->isPasswordMatched($password)) return array(false, 'Password mismatch');
		
		if ($user->changePassword($password))
			return array(true); 
		else
			return array(false, 'Unable to change your password at this moment');
	}
	
	private function changeEmail() {
		$userSession = UserSession::getInstance();
	
		if (!$user = $userSession->isSignedIn()) return array(false, 'Invalid request');
		if (!isset($_POST['email'])) return array(false, 'Invaild request');
	
		$email = $_POST['email'];
	
		if ($user->updateEmail($email))
			return array(true);
		else
			return array(false, 'Unable to change your email at this moment');
	}
	
	private function isUsernameUsed() {
		if (!isset($_POST['username'])) return array(false, 'Invalid request');
		
		$username = $_POST['username'];
	}
}
?>