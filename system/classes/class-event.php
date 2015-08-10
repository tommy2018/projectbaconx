<?php
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
		
		if ($stmt->execute(array('id' => $id)))
			if ($result = $stmt->fetch())
				return new Event($result['id'], $result['name'], $result['fromDate'], $result['toDate'], $result['published']);
	}

	static public function getEvents($numbers, $offset = 0) {
		$db = Database::getInstance();
		$conn = $db->connect();
		$events = [];
		
		$stmt = $conn->prepare('SELECT * FROM event');
		
		if ($stmt->execute())
			while ($result = $stmt->fetch())
				$events[] = new Event($result['id'], $result['name'], $result['fromDate'], $result['toDate'], $result['published']);
		
		return $events;
	}
	
// 	static public function newEvent($name, $startDate, $endDate) {
// 		$db = Database::getInstance();
// 		$conn = $db->connect();
		
// 		$stmt = $conn->prepare('INSERT INTO event(name) VALUES(:name)');
		
// 		if ($stmt->execute(array('name' => $name))) return $conn->lastInsertId(); else null;
// 	}
	
	static public function newEvent($name, $startDate, $endDate) {
		$db = Database::getInstance();
		$conn = $db->connect();
	
		$stmt = $conn->prepare('INSERT INTO event(name, fromDate, toDate) VALUES(:name, :startDate, :endDate)');
	
		if ($stmt->execute(array('name' => $name, 'startDate' => $startDate, 'endDate' => $endDate))) return true; else return false;
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
	
	public function getEntityGroupCount() {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT count(id) FROM entity_group WHERE eventID = :eventId');
		
		if ($stmt->execute(array('eventId' => $this->eventID)))
			if ($result = $stmt->fetch())
				return $result[0];
	}
	
	public function updateEventName($newName) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE event SET name = :newName WHERE id = :eventID');
		
		if ($stmt->execute(array('newName' => $newName, 'eventID' => $this->eventID))) {
			if ($stmt->rowCount() >= 1) {
				$this->name = $newName;
				return true;
			}
		}
		
		return false;
	}
	
	public function updateEventStartDate($newStartDate) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE event SET fromDate = :newStartDate WHERE id = :eventID');
		
		if ($stmt->execute(array('newStartDate' => $newStartDate, 'eventID' => $this->eventID))) {
			if ($stmt->rowCount() >= 1) {
				$this->startDate = $newStartDate;
				return true;
			}
		}
		
		return false;
	}
	
	public function updateEventEndDate($newEndDate) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE event SET toDate = :newEndDate WHERE id = :eventID');
		
		if ($stmt->execute(array('newEndDate' => $newEndDate, 'eventID' => $this->eventID))) {
			if ($stmt->rowCount() >= 1) {
				$this->endDate = $newEndDate;
				return true;
			}
		}
		
		return false;
	}
	
	public function updateEntityPublishStatus($newPublishStatus) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE event set published = :newPublishStatus WHERE id = :eventID');
		
		if ($stmt->execute(array('newPublishStatus' => $newPublishStatus, 'eventID' => $this->eventID))) {
			if ($stmt->rowCount() >= 1) {
				$this->published = $newPublishStatus;
				return true;
			}
		}
		
		return false;
	}
}