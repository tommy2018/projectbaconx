<?php
require_once 'system/classes/class-user.php';

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
				return $this->changePassword();
			case 'is-username-used':
				return $this->isUsernameUsed();
			case 'change-email':
				return $this->changeEmail();
			case 'create-users':
				return $this->createUsers();
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
	
	private function changePassword() {
		$userSession = UserSession::getInstance();
		
		if (!$user = $userSession->isSignedIn()) return array(false, 'Invalid request');
		if (!isset($_POST['oldPassword'])) return array(false, 'Invalid request');
		if (!isset($_POST['newPassword'])) return array(false, 'Invalid request');
		if (!isset($_POST['confirmNewPassword'])) return array(false, 'Invalid request');
		
		$oldPassword = $_POST['oldPassword'];
		$newPassword = $_POST['newPassword'];
		$confirmNewPassword = $_POST['confirmNewPassword'];
		
		
		if (!$user->isPasswordMatched($oldPassword)) return array(false, 'Password mismatch');
		if ($newPassword != $confirmNewPassword) return array(false, 'two new passwords different');
		
		if ($user->changePassword($newPassword))
			return array(true); 
		else
			return array(false, 'Unchange password');
	}
	
	private function changeEmail() {
		$userSession = UserSession::getInstance();
	
		if (!$user = $userSession->isSignedIn()) return array(false, 'Invalid request');
		if (!isset($_POST['email'])) return array(false, 'Invaild request');
	
		$email = $_POST['email'];
	
		if ($user->updateEmail($email))
			return array(true);
		else
			return array(false, 'Unchange email');
	}
	
	private function isUsernameUsed() {
		if (!isset($_POST['username'])) return array(false, 'Invalid request');
		
		$username = $_POST['username'];
	}
	
	private function createUsers() {
		if (!isset($_POST['data'])) return array(false, 'Invalid request');
		$data = $_POST['data'];
		
		for ($i = 0; $i < sizeof($data); $i++) {
			if (!isset($data[$i]['middleName']))
				$data[$i]['middleName'] = null;
		}
		
		UserAPI::newUsers($data);
		return array(true);
	}
}
?>