<?php
require_once 'system/classes/class-userSession.php';
require_once 'system/classes/class-user.php';

class ControlPanelRequest {
	public function processRequest() {
		if (!isset($_GET['do'])) return array(false, 'Invalid request');
		
		$do = $_GET['do'];
		
		switch ($do) {
			case 'create-user':
				return $this->createUser();
			case 'create-project':
			case 'change-user-password':
				return $this->changeUserPasword();
			default:
				return array(false, 'Invalid request');
		}
	}
	
	private function createUser() {
		if (!isset($_POST['username'])) return array(false, 'Invalid request');
		if (!isset($_POST['password'])) return array(false, 'Invalid request');
		if (!isset($_POST['firstName'])) return array(false, 'Invalid request');
		if (!isset($_POST['lastName'])) return array(false, 'Invalid request');
		if (!isset($_POST['email'])) return array(false, 'Invalid request');
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		if (isset($_POST['middleName'])) $middleName = $_POST['middleName']; else $middleName = null;
		
		if (User::newUser($username, $password, $lastName, $firstName, $middleName, $email))
			return array(true);
		else
			return array(false, 'Unable to create user');
		
	}
	
	private function createProject() {
		
	}
	
	private function changeUserPasword() {
		if (!isset($_POST['uid'])) return array(false, 'Invalid request');
		if (!isset($_POST['password'])) return array(false, 'Invalid request');
		
		$uid = $_POST['uid'];
		$password = $_POST['password'];
		
		if (!$user = User::getUserByUid($uid)) return array(false, 'No such user');
		
		if ($user->changePassword($password))
			return array(true);
		else
			return array(false, 'Unable to change the password');
	}
}
?>