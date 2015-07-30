<?php
include_once 'global.inc.php';
include_once 'controllers/controller-home.php';
include_once 'system/classes/class-userSession.php';
include_once 'system/classes/class-event.php';

$object = Event::getEventByID(1);

if ($object) {
	echo($object->getEventID() . ': ' . $object->getName());
	echo(' Number of entity group: ' . $object->getEntityGroupCount());
}

?>