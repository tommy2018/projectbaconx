<?php
include_once 'functions-common.php';
include_once 'class-database.php';

class User {
	private $uid;
	private $username;
	private $lastName;
	private $firstName;
	private $middleName;
	private $email;
	
	private function __construct($uid, $username, $lastName, $firstName, $middleName, $email) {
		$this->uid = $uid;
		$this->username = $username;
		$this->lastName = $lastName;
		$this->firstName = $firstName;
		$this->middleName = $middleName;
		$this->email = $email;
	}
	
	public static function login($username, $password) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$password = hashString($password);
		
		$stmt = $conn->prepare('SELECT uid, username, firstName, lastName, middleName, email FROM user WHERE username = :username AND password = :password');
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		
		if ($stmt->execute())
			if ($result = $stmt->fetch())
				return new User($result['uid'], $result['username'], $result['lastName'], $result['firstName'], $result['middleName'], $result['email']);
			else
				return null;
	}
	
	public static function getUserByUid($uid) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT uid, username, firstName, lastName, middleName, email FROM user WHERE uid = :uid');
		$stmt->bindParam(':uid', $uid);
		
		if ($stmt->execute())
			if ($result = $stmt->fetch())
				return new User($result['uid'], $result['username'], $result['lastName'], $result['firstName'], $result['middleName'], $result['email']);
			else
				return null;
	}
	
	public function getUsername() {
		return $this->username;
	}
	
	public function getUid() {
		return $this->uid;
	}
}
?>