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
		} else throw new PBXException('db-00');
	}

	static public function getUsersAndRolesByEntityID($id) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT user.firstName, user.lastName, user.middleName, user_role.name FROM user_role_involvement JOIN user_role USING(rid) JOIN user USING(uid) WHERE user_role_involvement.entityID = :entityID');
		$list = [];
		
		if ($stmt->execute(array('entityID' => $id))) {
			while ($result = $stmt->fetch())
				$list[] = array('firstName' => $result['firstName'], 'lastName' => $result['lastName'], 'middleName' => $result['middleName'], 'role' => $result['name']);
			return $list;
		} else throw new PBXException('db-00');
	}
	
	static public function newUserRole($entiyGroupID, $name, $description) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('INSERT INTO user_role(entityGroupID, name, description) VALUES(:entityGroupID, :name, :description)');
		
		if ($stmt->execute(array('entityGroupID' => $entiyGroupID, 'name' => $name, 'description' => $description))) return true; else throw new PBXException('db-00');
	}
	
	public function updateUserRoleDescription($description) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE user_role SET description = :newDescription WHERE rid = :rid');
		
		if ($stmt->execute(array('description' => $description, 'rid' => $this->rid))) {
			if ($stmt->rowCount() >= 1) {
				$this->description = $description;
				return true;
			}
			else 
				return false;
		} else throw new PBXException('db-00');
	}
	
	public function updateAdminStatus($adminStatus) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE user_role SET is_admin = :adminStatus WHERE rid = :rid');
		
		if ($stmt->execute(array('adminStatus' => $adminStatus, 'rid' => $this->rid))) {
			if ($stmt->rowCount() >= 1) {
				return true;
			}
			else return false;
		} else throw new PBXException('db-00');
	}
	
	public function addUser($uid, $entityID) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('INSERT INTO user_role_involvement(rid, entityID, uid) VALUES(:rid, :entityID, :uid)');
		
		if ($stmt->execute(array('rid' => $this->rid, 'entityID' => $entityID, 'uid' => $uid))) return true; else throw new PBXException('db-00');
	}
}
?>