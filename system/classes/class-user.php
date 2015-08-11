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
	
	static public function signIn($username, $password) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$password = hashString($password);
		$securityToken = randomString(20);
		
		$stmt = $conn->prepare('SELECT uid, username, firstName, lastName, middleName, email FROM user WHERE username = :username AND password = :password');
		$stmt1 = $conn->prepare('UPDATE user SET securityToken = :securityToken WHERE uid = :uid');
		
		if ($stmt->execute(array('username' => $username, 'password' => $password))) {
			if ($result = $stmt->fetch())
				if ($stmt1->execute(array('uid' => $result['uid'], 'securityToken' => $securityToken)))
					return new User($result['uid'], $result['username'], $result['lastName'], $result['firstName'], $result['middleName'], $result['email'], $securityToken);
				else
					throw new PBXException('db-00');
		} else throw new PBXException('db-00');
	}
	
	static public function getUserByUid($uid) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT uid, username, firstName, lastName, middleName, email, securityToken FROM user WHERE uid = :uid');
		
		if ($stmt->execute(array('uid' => $uid))) {
			if ($result = $stmt->fetch())
				return new User($result['uid'], $result['username'], $result['lastName'], $result['firstName'], $result['middleName'], $result['email'], $result['securityToken']);
		} else throw new PBXException('db-00');
	}
	
	static public function searchUserByUsername($username) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT uid, username, firstName, lastName, middleName, email, securityToken FROM user WHERE username LIKE :username LIMIT 5');
		
		$users = [];
		
		if ($stmt->execute(array('username' => $username.'%'))) {
			while ($result = $stmt->fetch()) {
				$users[] = new User($result['uid'], $result['username'], $result['lastName'], $result['firstName'], $result['middleName'], $result['email'], $result['securityToken']);
			}
			return $users;
		} else throw new PBXException('db-00');
	}
	
	static public function searchUserByEmail($email) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT uid, username, firstName, lastName, middleName, email, securityToken FROM user WHERE email LIKE :email LIMIT 5');
		
		$users = [];
		
		if ($stmt->execute(array('email' => $email.'%'))) {
			while ($result = $stmt->fetch()) {
				$users[] = new User($result['uid'], $result['username'], $result['lastName'], $result['firstName'], $result['middleName'], $result['email'], $result['securityToken']);
			}
			return $users;
		} else throw new PBXException('db-00');
	}
	
	static public function searchUserByFirstName($firstName) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT uid, username, firstName, lastName, middleName, email, securityToken FROM user WHERE firstName LIKE :firstName LIMIT 5');
		
		$users = [];
		
		if ($stmt->execute(array('firstName' => $firstName.'%'))) {
			while ($result = $stmt->fetch()) {
				$users[] = new User($result['uid'], $result['username'], $result['lastName'], $result['firstName'], $result['middleName'], $result['email'], $result['securityToken']);
			}
			return $users;
		} else throw new PBXException('db-00');
	}
	
	static public function searchUserByLastName($lastName) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT uid, username, firstName, lastName, middleName, email, securityToken FROM user WHERE lastName LIKE :lastName LIMIT 5');
		
		$users = [];
		
		if ($stmt->execute(array('lastName' => $lastName.'%'))) {
			while ($result = $stmt->fetch()) {
				$users[] = new User($result['uid'], $result['username'], $result['lastName'], $result['firstName'], $result['middleName'], $result['email'], $result['securityToken']);
			}
			return $users;
		} else throw new PBXException('db-00'); 
	}
	
	static public function newUser($username, $password, $lastname, $firstname, $middlename, $email) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$password = hashString($password);
		
		$stmt = $conn->prepare('INSERT INTO user(username, password, firstname, lastname, middlename, email) VALUES(:username, :password, :firstname, :lastname, :middlename, :email)');
		
		if ($stmt->execute(array('username' => $username, 'password' => $password, 'firstname' => $firstname, 'lastname' => $lastname, 'middlename' => $middlename, 'email' => $email))) 
			return true;
		else throw new PBXException('db-00');
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
			else
				return false;
		} else throw new PBXException('db-00');
	}
	
	public function changePasswordWithoutOldPassword($password) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE user SET password = :password WHERE uid = :uid');

		$newPassword = hashString($newPassword);
		
		if ($stmt->execute(array('password' => $password, 'uid' => $this->uid))) {
			if ($stmt->rowCount() >= 1)
				return true;
			else
				return false;
		} else throw new PBXException('db-00');
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
	
	public function updateEmail($email) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE user SET email = :email WHERE uid = :uid');
		
		if ($stmt->execute(array('email' => $email, 'uid' => $this->uid))) {
			if ($stmt->rowCount() >= 1) {
				$this->email = $email;
				return true;
			} else return false;
		} else throw new PBXException('db-00');
	}
}
?>