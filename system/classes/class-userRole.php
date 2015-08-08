<?php
class UserRole {
	private $rid;
	private $entityGroupID;
	private $name;
	private $description;
	
	private function __construct($rid, $entityGroupID, $name, $description) {
		$this->rid = $rid;
		$this->entityGroupID = $entityGroupID;
		$this->name = $name;
		$this->description = $description;
	}
	
	static public function getUserRoleByEntityGroupID($id) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT rid, entityGroupID, name, description FROM user_role WHERE entityGroupID = :entityGroupID');
		$groups = [];
		
		if ($stmt->execute(array('entityGroupID' => $id))) {
			while ($result = $stmt->fetch())
				$groups[] =  new UserRole($result['rid'], $result['entityGroupID'], $result['name'], $result['description']);
			
			return $groups;
		} else return null;
	}

	static public function getUserAndRoleListByEntityID($id) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT user.firstName, user.lastName, user.middleName, user_role.name FROM user_role_involvement JOIN user_role USING(rid) JOIN user USING(uid) WHERE user_role_involvement.entityID = :entityID');
		$list = [];
		
		if ($stmt->execute(array('entityID' => $id))) {
			while ($result = $stmt->fetch())
				$list[] = array('firstName' => $result['firstName'], 'lastName' => $result['lastName'], 'middleName' => $result['middleName'], 'role' => $result['name']);
			
			return $list;
		} else return null;
	}
	
	static public function newUserRole($entiyGroupID, $name, $description) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('INSERT INTO user_role(entityGroupID, name, description) VALUES(:entityGroupID, :name, :description)');
		
		if ($stmt->execute(array('entityGroupID' => $entiyGroupID, 'name' => $name, 'description' => $description))) return true; else return false;
	}
	
	public function updateUserRoleDescription($newDescription) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE user_role SET description = :newDescription WHERE rid = :rid');
		
		if ($stmt->execute(array('newDescription' => $newDescription, 'rid' => $this->rid))) {
			if ($stmt->rowCount() >= 1) {
				$this->description = $newDescription;
				return true;
			}
		}
		
		return false;
	}
	
	public function updateAdminStatus($newAdminStatus) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE user_role SET is_admin = :newAdminStatus WHERE rid = :rid');
		
		if ($stmt->execute(array('newAdminStatus' => $newAdminStatus, 'rid' => $this->rid))) {
			if ($stmt->rowCount() >= 1) {
				return true;
			}
		}
		
		return false;
	}
	
	public function addUser($uid, $entityID) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('INSERT INTO user_role_involvement(rid, entityID, uid) VALUES(:rid, :entityID, :uid)');
		
		if ($stmt->execute(array('rid' => $this->rid, 'entityID' => $entityID, 'uid' => $uid))) return true; else return false;
	}
}
?>