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
	
	static public function getEntityGroupsByEventID($eventID) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT id, eventID, name, description FROM entity_group WHERE eventID = :eventID');
		$entityGroups = [];
		
		if ($stmt->execute(array('eventID' => $eventID))) {
			while ($result = $stmt->fetch())
				$entityGroups[] = new EntityGroup($result['id'], $result['eventID'], $result['name'], $result['description']);
			return $entityGroups;
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
	
	public function updateEntityGroupName($name) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE entity_group SET name = :name WHERE id = :id');
		
		if ($stmt->execute(array('name' => $name, 'id' => $this->id))) {
			if ($stmt->rowCount() >= 1) {
				$this->name = $name;
				return true;
			} else return false;
		} else throw new PBXException('db-00');
	}
	
	public function updateEntityGroupDescription($description) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare("UPDATE entity_group SET description = :description WHERE id = :id");
		
		if ($stmt->execute(array('description' => $description, 'id' => $this->id))) {
			if ($stmt->rowCount() >= 1) {
				$this->description = $description;
				return true;
			} else return false;
		} else throw new PBXException('db-00');
	}
}
?>