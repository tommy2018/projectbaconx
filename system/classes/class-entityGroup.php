<?php
class EntityGroup {
	private $id;
	private $eventID;
	private $name;
	private $description;
	
	private function __construct($id, $eventID, $name, $description)  {
		$this->id = $id;
		$this->eventID = $eventID;
		$this->name = $name;
		$this->description = $description;
	}
	
	static public function getEntityGroupListByEventID($eventID) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT id, name FROM entity_group WHERE eventID = :eventID');
		
		if ($stmt->execute(array('eventID' => $eventID))) {
			if ($result = $stmt->fetchAll())
				return $result;
		} else throw new PBXException('db-00');
	}
	
	static public function getEntityGroupByID($id) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT id, eventID, name, description FROM entity_group WHERE id = :id');
		
		if ($stmt->execute(array('id' => $id))) {
			if ($result = $stmt->fetch())
				return new EntityGroup($result['id'], $result['eventID'], $result['name'], $result['description']);
		} else throw new PBXException('db-00');
	}
	
	static public function newEntityGroup($eventID, $name, $description) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('INSERT INTO entity_group(eventID, name, description) VALUES(:eventID, :name, :description)');
				
		if ($stmt->execute(array('eventID' => $eventID, 'name' => $name, 'description' => $description))) return true; else throw new PBXException('db-00');
	}
	
	public function getID() {
		return $this->id;
	}
	
	public function getEventID() {
		return $this->eventID;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function updateEntityGroupName($newName) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE entity_group SET name = :newName WHERE id = :id');
		
		if ($stmt->execute(array('newName' => $newName, 'id' => $this->id))) {
			if ($stmt->rowCount() >= 1) {
				$this->name = $newName;
				return true;
			} else return false;
		} else throw new PBXException('db-00');
	}
	
	public function updateEntityGroupDescription($newDescription) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare("UPDATE entity_group SET description = :newDescription WHERE id = :id");
		
		if ($stmt->execute(array('newDescription' => $newDescription, 'id' => $this->id))) {
			if ($stmt->rowCount() >= 1) {
				$this->description = $newDescription;
				return true;
			} else return false;
		} else throw new PBXException('db-00');
	}
}
?>