<?php
class EntityAdditionalAttribute {
	private $additionalAttributeID;
	private $entityID;
	private $name;
	private $value;
	private $type;
	
	private function __construct($additionalAttributeID, $entityID, $name, $value, $type) {
		$this->additionalAttributeID = $additionalAttributeID;
		$this->entityID = $entityID;
		$this->name = $name;
		$this->value = $value;
		$this->type = $type;
	}
	
	static public function getEntityAdditionalAttributesByEntityID($entityID) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT entity.id entityID, entity_group_attribute.id additionalAttributeID, entity_group_attribute.name, entity_group_attribute_value.value, entity_group_attribute.type FROM entity_group_attribute LEFT JOIN entity ON (entity_group_attribute.entityGroupID = entity.entityGroupID) LEFT JOIN entity_group_attribute_value ON (entity_group_attribute_value.entityID = entity.id AND entity_group_attribute_value.entityGroupAttributeID = entity_group_attribute.id) WHERE entity.id = :entityID');
		$entityAdditionalAttributes = [];
		
		if ($stmt->execute(array('entityID' => $entityID))) {
			while ($result = $stmt->fetch())
				$entityAdditionalAttributes[$result['name']] = new EntityAdditionalAttribute($result['additionalAttributeID'], $result['entityID'], $result['name'], $result['value'], $result['type']);
		} else throw new PBXException('db-00');
		
		return $entityAdditionalAttributes;
	}
	
	public function getID() {
		return $this->id;
	}
	
	public function getAdditionalAttributeID() {
		return $this->additionalAttributeID;
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
	
	public function setValue($value) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('INSERT INTO entity_group_attribute_value(value, entityID, entityGroupAttributeID) VALUES(:value, :entityID, :entityGroupAttributeID) ON DUPLICATE KEY UPDATE value = :value');
		if (!$stmt->execute(array('value' => $value, 'entityID' => $this->entityID, 'entityGroupAttributeID' => $this->additionalAttributeID))) throw new PBXException('db-00');
	}
	
	public function toHTMLElement($name, $class, $id) {
		switch ($this->type) {
			case AttributeType::text:
				return '<input type="text" ' . (($name) ? 'name="' . $name . '" ' : '') . (($class) ? 'class="' . $class . '" ' : '') . (($id) ? 'id="' . $id . '" ' : '') . 'value="' . $this->value . '">';
				break;
			case AttributeType::textArea:
				break;
			case AttributeType::email:
				break;
			case AttributeType::weblink:
				break;
			case AttributeType::number:
				break;
			default:
				return null;
		}
	}
	
	private static function isValueSatisfiedAttributeType($attributeSchema, $value) {
		switch ($attributeSchema->getType()) {
			case AttributeType::text:
				break;
			case AttributeType::textArea:
				break;
			case AttributeType::email:
				break;
			case AttributeType::weblink:
				break;
			case AttributeType::number:
				break;
			default:
		}
	}
}
class AttributeType {
	const text = 0;
	const textArea = 1;
	const email = 2;
	const weblink = 3;
	const number = 4;
}
?>