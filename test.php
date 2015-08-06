<?php
include_once 'global.inc.php';
include_once 'system/classes/class-userRole.php';

print_r(UserRole::getUserAndRoleListByEntityID(1));
?>