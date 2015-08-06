<?php
include_once 'global.inc.php';
include_once 'system/classes/class-entity.php';

$entity = Entity::getEntityByID(2);
echo $entity->getName();
echo($entity->updateEntityDescription('test'));
?>