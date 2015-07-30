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
		
		if ($stmt->execute(array('eventID' => $eventID)))
			if ($result = $stmt->fetchAll())
				return $result;
	}
	
	static public function getEntityGroupByID($id) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT id, eventID, name, description FROM entity_group WHERE id = :id');
		
		if ($stmt->execute(array('id' => $id)))
			if ($result = $stmt->fetch())
				return new EntityGroup($result['id'], $result['eventID'], $result['name'], $result['description']);
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
	
}
?>