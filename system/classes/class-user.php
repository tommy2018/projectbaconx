<?php
include_once 'class-database.php';

class User {
	private $uid;
	private $username;
	private $lastName;
	private $firstName;
	private $middleName;
	private $email;
	private $securityToken;
	
	private function __construct($uid, $username, $lastName, $firstName, $middleName, $email, $securityToken) {
		$this->uid = $uid;
		$this->username = $username;
		$this->lastName = $lastName;
		$this->firstName = $firstName;
		$this->middleName = $middleName;
		$this->email = $email;
		$this->securityToken = $securityToken;
	}
	
	static public function login($username, $password) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$password = hashString($password);
		$securityToken = randomString(20);
		
		$stmt = $conn->prepare('SELECT uid, username, firstName, lastName, middleName, email FROM user WHERE username = :username AND password = :password');
		$stmt1 = $conn->prepare('UPDATE user SET securityToken = :securityToken WHERE uid = :uid');
		
		if ($stmt->execute(array('username' => $username, 'password' => $password)))
			if ($result = $stmt->fetch())
				if ($stmt1->execute(array('uid' => $result['uid'], 'securityToken' => $securityToken)))
					return new User($result['uid'], $result['username'], $result['lastName'], $result['firstName'], $result['middleName'], $result['email'], $securityToken);
		
		return null;
	}
	
	static public function getUserByUid($uid) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT uid, username, firstName, lastName, middleName, email, securityToken FROM user WHERE uid = :uid');
		
		if ($stmt->execute(array('uid' => $uid)))
			if ($result = $stmt->fetch())
				return new User($result['uid'], $result['username'], $result['lastName'], $result['firstName'], $result['middleName'], $result['email'], $result['securityToken']);
		
		return null;
	}
	
	static public function newUser($username, $password, $lastname, $firstname, $middlename, $email) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$password = hashString($password);
		
		$stmt = $conn->prepare('INSERT INTO user(username, password, firstname, lastname, middlename, email) VALUES(:username, :password, :firstname, :lastname, :middlename, :email)');
		
		if ($stmt->execute(array('username' => $username, 'password' => $password, 'firstname' => $firstname, 'lastname' => $lastname, 'middlename' => $middlename, 'email' => $email))) return true; else return false;
	}
	
	public function changePassword($oldPassword, $newPassword) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE user SET password = :newPassword WHERE uid = :uid AND password = :oldPassword');
		
		$oldPassword = hashString($oldPassword);
		$newPassword = hashString($newPassword);
		
		if ($stmt->execute(array('newPassword' => $newPassword, 'oldPassword' => $oldPassword, 'uid' => $this->uid))) {
			if ($stmt->rowCount() >= 1)
				return true;
		}
		
		return false;
	}
	
	public function getUsername() {
		return $this->username;
	}
	
	public function getFirstName() {
		return $htis->firstName;
	}
	
	public function getLastName() {
		return $this->lastName;
	}
	
	public function getMiddleName() {
		return $this->middleName;
	}
	
	public function getEmail() {
		return $this->email;
	}
	
	public function getUid() {
		return $this->uid;
	}
	
	public function getSecurityToken() {
		return $this->securityToken;
	}
	
	public function updateUserEmail($newEmail) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE user SET email = :newEmail WHERE uid = :uid');
		
		if ($stmt->execute(array('newEmail' => $newEmail, 'uid' => $this->uid))) {
			if ($stmt->rowCount() >= 1) {
				$this->email = $newEmail;
				return true;
			}
		}
		
		return false;
	}
}
?>