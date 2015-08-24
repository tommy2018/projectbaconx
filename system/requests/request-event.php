<?php
include_once 'system/classes/class-userSession.php';
include_once 'system/classes/class-event.php';
include_once 'system/classes/class-entityGroup.php';
include_once 'system/classes/class-entity.php';
include_once 'system/classes/class-userRole.php';

class EventRequest {
	public function processRequest() {
		if (!isset($_GET['do'])) return array(false, 'Invalid request');
		
		$do = $_GET['do'];
		
		switch ($do) {
			case 'getEventList':
				return $this->getEventList();
			case 'getEntity':
				return $this->getEntity();
			case 'getEntities':
				return $this->getEntities();
			case 'getEventBriefInfo':
				return $this->getEventBriefInfo();
			default:
				return array(false, 'Invalid request');
		}
	}
	
	private function getEventList() {
		$userSession = UserSession::getInstance();
		$events = Event::getEvents(1);
		$result = [];
		
		if (is_array($events))
			foreach ($events as $event)
				if (is_a($event, 'Event')) $result[] = array('id' => $event->getEventID(), 'name' => $event->getName(), 'startDate' => $event->getStartDate(), 'endDate' => $event->getEndDate());
		
		return array(true, $result);
	}
	
	private function getEntity() {
		if (!isset($_POST['id'])) return array(false, 'Invalid request');
		if (!preg_match('/^[1-9][0-9]*$/', $_POST['id'])) return array(false, 'Invalid request');
		
		$id = $_POST['id'];
		
		if ($entity = Entity::getEntityByID($id))
			return array(true, array(
					'id' => $entity->getID(),
					'name' => $entity->getName(),
					'description' => $entity->getDescription(),
					'members' => UserRole::getUserAndRoleListByEntityID($entity->getID())
			));
		else
			return array(false, 'Can\'t retrieve the object you requested for.');
	}
	
	private function getEventBriefInfo() {
		if (!isset($_POST['id'])) return array(false, 'Invalid request');
		if (!preg_match('/^[1-9][0-9]*$/', $_POST['id'])) return array(false, 'Invalid request');
		
		$id = $_POST['id'];
		
		if ($event = Event::getEventByID($id))
			return array(true, $event->getEventBrifeInfo());
		else
			return array(false, 'No such event');
	}
	
	private function getEntities() {
		if (!isset($_POST['id'])) return array(false, 'Invalid request');
		if (!preg_match('/^[1-9][0-9]*$/', $_POST['id'])) return array(false, 'Invalid request');
		
		$id = $_POST['id'];
		
		$result = [];
		$entities = Entity::getEntitiesByEntityGroupID($id);
		
		foreach ($entities as $entity)
			$result[] = array('id' => $entity->getID(), 'name' => $entity->getName(), 'description' => $entity->getDescription());
		
		return array(true, $result);
	}
	
}
?>