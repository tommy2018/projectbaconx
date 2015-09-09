<?php
class EntityAdditionalAttribute {
	private $id;
	private $entityID;
	private $name;
	private $value;
	private $type;
	
	private function __construct($id, $entityID, $name, $value, $type) {
		$this->id = $id;
		$this->entityID = $entityID;
		$this->name = $name;
		$this->value = $value;
		$this->type = $type;
	}
	
	static public function getEntityAdditionalAttributeByEntityID($entityID) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT id, entityID, name, value, type FROM entity_group_attribute JOIN entity_group_attribute_value ON entity_group_attribute.id = entity_group_attribute_value.entityGroupAttributeID where entity_group_attribute_value.entityID = :entityID');
		
		if ($stmt->execute(array('entityID' => $entityID))) {
			$entityAdditionalAttributes = null;
			while ($result = $stmt->fetch())
				$entityAdditionalAttributes[$result['id']] = new EntityAdditionalAttribute($result['id'], $result['entityID'], $result['name'], $result['value'], $result['type']);
			return $entityAdditionalAttributes;
		} else throw new PBXException('db-00');
	}
	
	public function getID() {
		return $this->id;
	}
	
	public function getEntityID() {
		return $this->entityID;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getValue() {
		return $this->value;
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function updateEntityAdditionalAttributeValue($value) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE entity_group_attribute_value SET value = :value WHERE entityGroupAttributeID = :entityGroupAttributeID AND entityID = :entityID');
		
		if ($stmt->execute(array('value' => $value, 'entityGroupAttributeID' => $this->id, 'entityID' => $this->entityID))) {
			if ($stmt->rowCount() >= 1) {
				$this->value = $value;
				return true;
			} return false;
		} else throw new PBXException('db-00');
	}
}
?>