<?php
class Database {
	private static $self;
	private $db;
	private $count = 0;
	
	private function __contruct() {}
	
	public function __clone() {}
	
	public static function getInstance() {
		if (!self::$self) self::$self = new self();
		
		return self::$self;
	}
	
	public function connect() {
		global $setting;
		
		if (!$this->db)
			$this->db = new PDO('mysql:host=' . $setting['db']['location'] . ';dbname=' . $setting['db']['dbName'] . ';charset=utf8', ''. $setting['db']['username'] . '', '' . $setting['db']['password'] . '');
			
		$this->count++;
		return $this->db;
	}
	
	public function getCount() {
		return $this->count;
	}
}
?>