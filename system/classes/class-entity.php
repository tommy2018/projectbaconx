<?php
class Entity {
	private $id;
	private $entityGroupID;
	private $name;
	private $description;
	
	private function __construct($id, $entityGroupID, $name, $description) {
		$this->id = $id;
		$this->entityGroupID = $entityGroupID;
		$this->name = $name;
		$this->description = $description;
	}
	
	static public function getEntityByID($id) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT id, entityGroupID, name, description FROM entity WHERE id = :id');
		
		if ($stmt->execute(array('id' => $id)))
			if ($result = $stmt->fetch())
				return new Entity($result['id'], $result['entityGroupID'], $result['name'], $result['description']);
	}
	
	public function getID() {
		return $this->id;
	}
	
	public function getEntityGroupID() {
		return $this->entityGroupID;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getDescription() {
		return $this->description;
	}
}
?>