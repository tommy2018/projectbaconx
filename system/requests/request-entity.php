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
			case 'update-basic-information':
				return $this->updateBasicInformation();
			case 'update-additional-attributes':
				return $this->updateAdditionalAttributes();
			default:
				return array(false, 'Invalid request');
		}
	}
	
	/*private function createEntity() {
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
	}*/
		
	private function updateBasicInformation() {
		if (!isset($_POST['id'])) return array(false, 'Invalid request');
		if (!isset($_POST['name'])) return array(false, 'Invalid request');
		if (!isset($_POST['description'])) return array(false, 'Invalid request');
					
		$name = $_POST['name'];
		$description = $_POST['description'];
		$id = $_POST['id'];
		
		if (!checkUserInput($id, UserInputType::numberStartsWithNonZero))  return array(false, 'Invalid request');

		$name = processUserInput($name);
		$description = processUserInput($description);
		if (!checkUserInput($name, UserInputType::nonEmptyString)) return array(false, 'Entity title cannot be empty');
					
		if (EntityAPI::updateEntityNameAndDescription($id, $name, $description))
			return array(true);
		else
			return array(false, 'Unable to update the information');
	}
	
	private function updateAdditionalAttributes() {
		if (!isset($_POST['id'])) return array(false, 'Invalid request');
		if (!isset($_POST['additionalAttributes'])) return array(false, 'Invalid request');
		
		$id = $_POST['id'];
		$additionalAttributes = $_POST['additionalAttributes'];
		
		if (!checkUserInput($id, UserInputType::numberStartsWithNonZero))  return array(false, 'Invalid request');
		
		$entityAdditionalAttributes = EntityAdditionalAttribute::getEntityAdditionalAttributesByEntityID($id);
		if (!$entityAdditionalAttributes) return array(false, 'Invalid request');
		
		foreach ((array)$additionalAttributes as $name => $value) {
			$entityAdditionalAttributes[$name]->setValue($value);
		}
	}
}
?>