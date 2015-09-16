<?php
class User {
	private $uid;
	private $username;
	private $lastName;
	private $firstName;
	private $middleName;
	private $fullName;
	private $email;
	private $securityToken;
	
	private function __construct($uid, $username, $lastName, $firstName, $middleName, $fullname, $email, $securityToken) {
		$this->uid = $uid;
		$this->username = $username;
		$this->lastName = $lastName;
		$this->firstName = $firstName;
		$this->middleName = $middleName;
		$this->fullName = $fullname;
		$this->email = $email;
		$this->securityToken = $securityToken;
	}
	
	static public function signIn($username, $password) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$password = hashString($password);
		$securityToken = randomString(20);
		
		$stmt = $conn->prepare('SELECT uid, username, firstName, lastName, middleName, fullname, email FROM user WHERE username = :username AND password = :password');
		$stmt1 = $conn->prepare('UPDATE user SET securityToken = :securityToken WHERE uid = :uid');
		
		if ($stmt->execute(array('username' => $username, 'password' => $password))) {
			if ($result = $stmt->fetch())
				if ($stmt1->execute(array('uid' => $result['uid'], 'securityToken' => $securityToken)))
					return new User($result['uid'], $result['username'], $result['lastName'], $result['firstName'], $result['middleName'], $result['fullname'], $result['email'], $securityToken);
				else
					throw new PBXException('db-00');
		} else throw new PBXException('db-00');
	}
	
	static public function getUserByUid($uid) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT uid, username, firstName, lastName, middleName, fullname, email, securityToken FROM user WHERE uid = :uid');
		
		if ($stmt->execute(array('uid' => $uid))) {
			if ($result = $stmt->fetch())
				return new User($result['uid'], $result['username'], $result['lastName'], $result['firstName'], $result['middleName'], $result['fullname'], $result['email'], $result['securityToken']);
		} else throw new PBXException('db-00');
	}
	
	static public function searchUsersByUsername($username) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT uid, username, firstName, lastName, middleName, fullname, email, securityToken FROM user WHERE username LIKE :username LIMIT 5');
		
		$users = [];
		
		if ($stmt->execute(array('username' => $username.'%'))) {
			while ($result = $stmt->fetch()) {
				$users[] = new User($result['uid'], $result['username'], $result['lastName'], $result['firstName'], $result['middleName'], $result['fullname'], $result['email'], $result['securityToken']);
			}
			return $users;
		} else throw new PBXException('db-00');
	}
	
	static public function searchUsersByEmail($email) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT uid, username, firstName, lastName, middleName, fullname, email, securityToken FROM user WHERE email LIKE :email LIMIT 5');
		
		$users = [];
		
		if ($stmt->execute(array('email' => $email.'%'))) {
			while ($result = $stmt->fetch()) {
				$users[] = new User($result['uid'], $result['username'], $result['lastName'], $result['firstName'], $result['middleName'], $result['fullname'], $result['email'], $result['securityToken']);
			}
			return $users;
		} else throw new PBXException('db-00');
	}
	
// 	static public function searchUsersByFirstName($firstName) {
// 		$db = Database::getInstance();
// 		$conn = $db->connect();
		
// 		$stmt = $conn->prepare('SELECT uid, username, firstName, lastName, middleName, fullname, email, securityToken FROM user WHERE firstName LIKE :firstName LIMIT 5');
		
// 		$users = [];
		
// 		if ($stmt->execute(array('firstName' => $firstName.'%'))) {
// 			while ($result = $stmt->fetch()) {
// 				$users[] = new User($result['uid'], $result['username'], $result['lastName'], $result['firstName'], $result['middleName'], $result['fullname'], $result['email'], $result['securityToken']);
// 			}
// 			return $users;
// 		} else throw new PBXException('db-00');
// 	}
	
// 	static public function searchUsersByLastName($lastName) {
// 		$db = Database::getInstance();
// 		$conn = $db->connect();
		
// 		$stmt = $conn->prepare('SELECT uid, username, firstName, lastName, middleName, email, securityToken FROM user WHERE lastName LIKE :lastName LIMIT 5');
		
// 		$users = [];
		
// 		if ($stmt->execute(array('lastName' => $lastName.'%'))) {
// 			while ($result = $stmt->fetch()) {
// 				$users[] = new User($result['uid'], $result['username'], $result['lastName'], $result['firstName'], $result['middleName'], $result['email'], $result['securityToken']);
// 			}
// 			return $users;
// 		} else throw new PBXException('db-00'); 
// 	}
	
	static public function newUser($username, $password, $lastname, $firstname, $fullname, $middlename, $email) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$password = hashString($password);
		
		$stmt = $conn->prepare('INSERT INTO user(username, password, firstname, lastname, fullname, middlename, email) VALUES(:username, :password, :firstname, :lastname, :middlename, :fullname, :email)');
		
		if ($stmt->execute(array('username' => $username, 'password' => $password, 'firstname' => $firstname, 'lastname' => $lastname, 'middlename' => $middlename, 'fullname' => fullname, 'email' => $email))) 
			return true;
		else throw new PBXException('db-00');
	}
	
	static public function checkUsernameExist($username) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT COUNT(username) FROM user WHERE username = :username');
		
		if ($stmt->execute(array('username' => $username))) {
			if ($result = $stmt->fetch()) {
				if ($result[0] > 0) {
					return true;
				} else return false;
			}
		} else throw new PBXException('db-00');
	}
	
	public function changePassword($password) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE user SET password = :password WHERE uid = :uid');
		
		$password = hashString($password);
		
		if ($stmt->execute(array('password' => $password, 'uid' => $this->uid))) {
			if ($stmt->rowCount() >= 1)
				return true;
			else
				return false;
		} else throw new PBXException('db-00');
	}
	
	public function isPasswordMatched($password) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT COUNT(uid) FROM user WHERE uid = :uid AND password = :password');
		
		$password = hashString($password);
		
		if ($stmt->execute(array('uid' => $this->uid, 'password' => $password))) {
			if ($result = $stmt->fetch()) {
				if ($result[0] == 1)
					return true;
				else
					return false;
			}
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
	
	public function getFullName() {
		return $this->fullName;
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

class UserAPI {
	static function newUsers($data) {
		$db = Database::getInstance();
		$conn = $db->connect();
		$conn->beginTransaction();
		
		$stmt = $conn->prepare('INSERT INTO user(username, password, firstName, lastName, middleName, email) VALUES(:username, :password, :firstName, :lastName, :middleName, :email)');
		
		foreach ((array)$data as $record) {
			if (!$stmt->execute(array('username' => $record['username'], 'password' => hashString($record['password']), 'firstName' => $record['firstName'], 'lastName' => $record['lastName'], 'middleName' => $record['middleName'], 'email' => $record['email']))) {
				$conn->rollBack();
				throw new PBXException('db-00');
			}
		}
		
		$conn->commit();
	}
}
?>