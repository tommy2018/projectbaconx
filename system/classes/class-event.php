<?php
include_once 'class-database.php';

class Event {
	private $eventID;
	private $name;
	private $startDate;
	private $endDate;
	private $published;
	
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
	
	static public function newEvent($name, $startDate, $endDate) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('INSERT INTO event(name) VALUES(:name)');
		
		if ($stmt->execute(array('name' => $name))) return $conn->lastInsertId(); else null;
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
}