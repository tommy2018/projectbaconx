<?php
class EntityGroup {
	private $id;
	private $eventID;
	private $name;
	private $description;
	
	private function __construct()  {}
	
	static public function getEntityGroupListByEventID($eventID) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT id, name FROM entity_group WHERE eventID = :eventID');
		
		if ($stmt->execute(array('eventID' => $eventID)))
			if ($result = $stmt->fetchAll())
				return $result;
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