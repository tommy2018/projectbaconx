<?php
include_once 'system/classes/class-userSession.php';
include_once 'system/classes/class-event.php';

class EventRequest extends Request {
	public function processRequest() {
		if (!isset($_GET['do'])) return array('success' => false, 'errorMessage' => 'Invalid request');
		
		$do = $_GET['do'];
		
		switch ($do) {
			case 'getEventList':
				return $this->getEventList();
			default:
				return array('success' => false, 'errorMessage' => 'Invalid request');
		}
	}
	
	private function getEventList() {
		$userSession = UserSession::getInstance();
		$events = Event::getEvents(2);
		$result = [];
		
		if (is_array($events)) {
			foreach ($events as $event)
				if (is_a($event, 'Event')) $result[] = array('id' => $event->getEventID(), 'name' => $event->getName(), 'startDate' => $event->getStartDate(), 'endDate' => $event->getEndDate());
		}
		
		return array('success' => true, 'result' => $result);
	}
}
?>