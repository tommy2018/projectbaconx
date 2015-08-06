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
}
?>