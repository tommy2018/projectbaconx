<?php
class Entity {
	private $id;
	private $entityGroupID;
	private $name;
	private $description;
	
	private function __construct($id, $entityGroupID, $name, $description) {
		$this->id = $id;
		$this->entityGroupID = $entityGroupID;
		$this->name = $name;
		$this->description = $description;
	}
	
	static public function getEntityByID($id) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT id, entityGroupID, name, description FROM entity WHERE id = :id');
		
		if ($stmt->execute(array('id' => $id)))
			if ($result = $stmt->fetch())
				return new Entity($result['id'], $result['entityGroupID'], $result['name'], $result['description']);
	}
	
	static public function getEntityListByUserID($uid) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT entity.id, entity.entityGroupID, entity.name, entity.description FROM entity JOIN user_role_involvement ON entity.id = user_role_involvement.entityID WHERE user_role_involvement.uid = :uid');
		$entityList = [];
		
		if($stmt->execute(array('uid' => $uid))) {
			while ($result = $stmt->fetch())
				$entityList[] = new Entity($result['id'], $result['entityGroupID'], $result['name'], $result['description']);
			
			return $entityList;
		} else return null;
	}
	
	static public function newEntity($entityGroupID, $name, $description) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('INSERT INTO entity(entityGroupID, name, description) values(:entityGroupID, :name, :description)');
		
		if ($stmt->execute(array('entityGroupID' => $entityGroupID, 'name' => $name, 'description' => $description))) return true; else return false;
	}
	
	public function getID() {
		return $this->id;
	}
	
	public function getEntityGroupID() {
		return $this->entityGroupID;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function updateEntityDescription($newDescription) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE entity SET description = :newDescription WHERE id = :id');
		
		if ($stmt->execute(array('newDescription' => $newDescription, 'id' => $this->id))) {
			if ($stmt->rowCount() >= 1) {
				$this->description = $newDescription;
				return true;
			}
		}
		
		return false;
	}
}
?>