<?php
include_once 'global.inc.php';
include_once 'controllers/controller-home.php';
include_once 'system/classes/class-userSession.php';
include_once 'system/classes/class-event.php';
include_once 'system/classes/class-entityGroup.php';

$object = Event::getEventByID(1);

if ($object) {
	echo($object->getEventID() . ': ' . $object->getName());
	echo('<br>');
	echo(' Number of entity group: ' . $object->getEntityGroupCount());
	$list = EntityGroup::getEntityGroupListByEventID($object->getEventID());
	echo('<br>');
	print_r($list);
	echo('<br>');
	$group = EntityGroup::getEntityGroupByID($list[0]['id']);
	echo($group->getDescription());
}

?>