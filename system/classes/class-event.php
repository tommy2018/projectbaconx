<?php
include_once 'class-database.php';

class Event {
	private $eventID;
	private $name;
	private $startDate;
	private $endDate;
	
	private function __construct($eventID, $name) {
		$this->eventID = $eventID;
		$this->name = $name;
	}
	
	static public function getEventByID($id) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT id, name, fromDate, toDate FROM event WHERE id = :id');
		
		if ($stmt->execute(array('id' => $id)))
			if ($result = $stmt->fetch())
				return new Event($result['id'], $result['name']);
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
	
	public function getEntityGroupCount() {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT count(id) FROM entity_group WHERE eventID = :eventId');
		
		if ($stmt->execute(array('eventId' => $this->eventID)))
			if ($result = $stmt->fetch())
				return $result[0];
	}
}