<?php
require_once 'system/classes/class-userSession.php';
require_once 'system/classes/class-entity.php';

class EntityRequest {
	public function processRequest() {
		if (!isset($_GET['do'])) return array(false, 'Invalid request');
		
		$do = $_GET['do'];
		
		switch ($do) {
			case 'create-entity':
				return $this->createEntity();
			case 'is-entity-name-used':
				return $this->isEntityNameUsed();
			default:
				return array(false, 'Invalid request');
		}
	}
	
	private function createEntity() {
		if (!isset($_POST['entityGroupID'])) return array(false, 'Invalid request');
		if (!isset($_POST['name'])) return array(false, 'Invalid request');
		
		
		$entityGroupID = $_POST['entityGroupID'];
		$name = $_POST['name'];
		
		if (isset($_POST['description'])) {
			$description = trim($_POST['description']);
			if (strlen($description) <= 0) $description = null; 
		}  else $description = null;
		
		if (Entity::newEntity($entityGroupID, $name, $description))
			return array(true);
		else
			return array('Unable to create entity');
	}
	
	private function isEntityNameUsed() {
		if (!isset($_POST['entityGroupID'])) return array(false, 'Invalid request');
		if (!isset($_POST['name'])) return array(false, 'Invalid request');
		
		$entityGroupID = $_POST['entityGroupID'];
		$name = $_POST['name'];
		
		return array(true, true);
	}
}
?>