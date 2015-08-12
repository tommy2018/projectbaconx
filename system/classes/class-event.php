<?php
include_once 'system/classes/class-entityGroup.php';

class Event {
	private $eventID;
	private $name;
	private $startDate;
	private $endDate;
	private $published;
	private $entityGroups;
	
	private function __construct($eventID, $name, $startDate, $endDate, $published) {
		$this->eventID = $eventID;
		$this->name = $name;
		$this->startDate = $startDate;
		$this->endDate = $endDate;
		$this->published = $published;
	}
	
	static public function getEventByID($id) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT * FROM event WHERE id = :id');
		
		if ($stmt->execute(array('id' => $id))) {
			if ($result = $stmt->fetch())
				return new Event($result['id'], $result['name'], $result['fromDate'], $result['toDate'], $result['published']);
		} else throw new PBXException('db-00');
	}

// 	static public function getEvents($numbers, $offset = 0) {
// 		$db = Database::getInstance();
// 		$conn = $db->connect();
// 		$events = [];
		
// 		$stmt = $conn->prepare('SELECT * FROM event');
		
// 		if ($stmt->execute()) {
// 			while ($result = $stmt->fetch()) 
// 				$events[] = new Event($result['id'], $result['name'], $result['fromDate'], $result['toDate'], $result['published']);
// 			return $events;
// 		} else throw new PBXException('db-00');
// 	}
	
	static public function newEvent($name, $startDate, $endDate) {
		$db = Database::getInstance();
		$conn = $db->connect();
	
		$stmt = $conn->prepare('INSERT INTO event(name, fromDate, toDate) VALUES(:name, :startDate, :endDate)');
	
		if ($stmt->execute(array('name' => $name, 'startDate' => $startDate, 'endDate' => $endDate))) return true; else throw new PBXException('db-00');
	}
	
	public function getEventID() {
		return $this->eventID;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getStartDate() {
		return $this->startDate;
	}
	
	public function getEndDate() {
		return $this->endDate;
	}
	
	public function isPublished() {
		return $this->published;
	}
	
	public function getEntityGroups() {
		if (!$this->entityGroups) {
			$this->entityGroups = EntityGroup::getEntityGroupsByEventID($this->eventID);
		}
		
		return $this->entityGroups;
	}
	
	public function getEntityGroupCount() {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT count(id) FROM entity_group WHERE eventID = :eventId');
		
		if ($stmt->execute(array('eventId' => $this->eventID))) {
			if ($result = $stmt->fetch())
				return $result[0];
		} else throw new PBXException('db-00');
	}
	
	public function getEntityBrifeInfo() {
		$this->getEntityGroups();
		$entityGroups = [];
		foreach ($this->entityGroups as $entityGroup)
			$entityGroups[] = array('id' => $entityGroup->getID(), 'eventID' => $entityGroup->getEventID(), 'name' => $entityGroup->getName(), 'description' => $entityGroup->getDescription());
		return array('eventID' => $this->eventID, 'name' => $this->name, 'startData' => $this->startDate, 'endDate' => $this->endDate, 'published' => $this->published, 'entityGroups' => $entityGroups);
	}
	
	public function updateEventName($name) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE event SET name = :name WHERE id = :eventID');
		
		if ($stmt->execute(array('name' => $name, 'eventID' => $this->eventID))) {
			if ($stmt->rowCount() >= 1) {
				$this->name = $name;
				return true;
			} else return false;
		} else throw new PBXException('db-00');
	}
	
	public function updateEventStartDate($startDate) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE event SET fromDate = :startDate WHERE id = :eventID');
		
		if ($stmt->execute(array('startDate' => $startDate, 'eventID' => $this->eventID))) {
			if ($stmt->rowCount() >= 1) {
				$this->startDate = $startDate;
				return true;
			} else return false;
		} else throw new PBXException('db-00');
	}
	
	public function updateEventEndDate($endDate) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE event SET toDate = :endDate WHERE id = :eventID');
		
		if ($stmt->execute(array('newEndDate' => $endDate, 'eventID' => $this->eventID))) {
			if ($stmt->rowCount() >= 1) {
				$this->endDate = $endDate;
				return true;
			} else return false;
		} else throw new PBXException('db-00');
	}
	
	public function updateEntityPublishStatus($publishStatus) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE event set published = :publishStatus WHERE id = :eventID');
		
		if ($stmt->execute(array('publishStatus' => $publishStatus, 'eventID' => $this->eventID))) {
			if ($stmt->rowCount() >= 1) {
				$this->published = $publishStatus;
				return true;
			} else return false;
		} throw new PBXException('db-00');
	}
}
?>