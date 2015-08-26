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
		
		if ($stmt->execute(array('id' => $id))) {
			if ($result = $stmt->fetch())
				return new Entity($result['id'], $result['entityGroupID'], $result['name'], $result['description']);
		} else throw new PBXException('db-00');
	}
	
	static public function getEntitiesByUserID($uid) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT entity.id, entity.entityGroupID, entity.name, entity.description FROM entity JOIN user_role_involvement ON entity.id = user_role_involvement.entityID WHERE user_role_involvement.uid = :uid');
		$entities = [];
		
		if ($stmt->execute(array('uid' => $uid))) {
			while ($result = $stmt->fetch())
				$entities[] = new Entity($result['id'], $result['entityGroupID'], $result['name'], $result['description']);
			return $entities;
		} else throw new PBXException('db-00');
	}
	
	static public function getEntitesByEntityGroupID($entityGroupID) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT * FROM entity WHERE entityGroupID = :entityGroupID');
		$entities = [];
		
		if ($stmt->execute(array('entityGroupID' => $entityGroupID))) {
			while ($result = $stmt->fetch()) {
				$entities[] = new Entity($result['id'], $result['entityGroupID'], $result['name'], $result['description']);
			}
			return $entities;
		} else throw new PBXException('db-00');
	}
	
	static public function getEntityInfoByID($id) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$entityInfo = [];
		
		$stmt = $conn->prepare('SELECT entity.id, entity.name, entity.description, entity.entityGroupID, entity_group.name, event.id, event.name, event.fromDate, event.toDate FROM entity JOIN entity_group ON entity.entityGroupID = entity_group.id JOIN event ON entity_group.eventID = event.id WHERE entity.id = :id');
		if ($stmt->execute(array('id' => $id))) {
			if ($result = $stmt->fetch()) {
				$entityInfo['basicInfo'] = array('id' => $result[0], 'name' => $result[1], 'description' => $result[2]);
				$entityInfo['entityGroup'] = array('id' => $result[3], 'name' => $result[4]);
				$entityInfo['event'] = array('id' => $result[5], 'name' => $result[6], 'fromDate' => $result[7], 'toDate' => $result[8]);
			} else {
				return null;
			}
		} else throw new PBXException('db-00');
		
		$stmt = $conn->prepare('SELECT entity_group_attribute.id, entity_group_attribute.name, entity_group_attribute.type, entity_group_attribute_value.value FROM entity_group_attribute_value JOIN entity_group_attribute ON entity_group_attribute_value.entityGroupAttributeID = entity_group_attribute.id WHERE entity_group_attribute_value.entityID = :id');
		if ($stmt->execute(array('id' => $id))) {
			$entityInfo['additionalAttributes'] = null;
			while ($result = $stmt->fetch()) {
				$entityInfo['additionalAttributes'][] = array('attributeID' => $result[0], 'name' => $result[1], 'type' => $result[2], 'value' => $result[3]);
			}
		} else throw new PBXException('db-00');
		
		$stmt = $conn->prepare('SELECT user.uid, user.username, user.firstname, user.middlename, user.lastname, user.email, user_role.rid, user_role.name FROM user_role_involvement JOIN (user_role, user) ON (user_role.rid = user_role_involvement.rid and user_role_involvement.uid = user.uid) WHERE user_role_involvement.entityID = :id');
		if ($stmt->execute(array('id' => $id))){
			$entityInfo['users'] = null;
			while ($result = $stmt->fetch()) {
				$entityInfo['users'][] = array('uid' => $result[0], 'username' => $result[1], 'fullname' => $result[2].($result[3]==null?'':' '.$result[3]).' '.$result[4], 'email' => $result[5], 'role' => array('rid' => $result[6], 'name' => $result[7]));
			}
		} else throw new PBXException('db-00');
		
		return $entityInfo;
	}
	
	static public function newEntity($entityGroupID, $name, $description) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('INSERT INTO entity(entityGroupID, name, description) values(:entityGroupID, :name, :description)');
		
		if ($stmt->execute(array('entityGroupID' => $entityGroupID, 'name' => $name, 'description' => $description))) return true; else throw new PBXException('db-00');
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
	
	public function updateEntityDescription($description) {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE entity SET description = :description WHERE id = :id');
		
		if ($stmt->execute(array('description' => $description, 'id' => $this->id))) {
			if ($stmt->rowCount() >= 1) {
				$this->description = $description;
				return true;
			} else return false;
		} else throw new PBXException('db-00');
	}
}
?>