<?php
include_once 'class-database.php';

class Log {
	private $timestamp;
	private $actor;
	private $level;
	private $message;
	
	private function __construct($timestamp, $actor, $level, $message) {
		$this->timestamp = $timestamp;
		$this->actor = $actor;
		$this->level = $level;
		$this->message = $message;
	}
	
	static public function newLog($level, $actor, $message) {
		$db = Database::getInstance();
		$conn = $db->connect();
		$timestamp = time();
		
		$stmt = $conn->prepare('INSERT INTO log(timestamp, level, actor, message) VALUES(:timestamp, :level, :actor, :message)');
		
		return $stmt->execute(array('timestamp' => $timestamp, 'level' => $level, 'actor' => $actor, 'message' => $message));
	}
	
	static public function getLogByID() {
		
	}
	
	public function count() {
	
	}
	
	public function current() {
	
	}
	
	public function next($offset) {
	
	}
	
	public function pervious($offset) {
	
	}
}
?>