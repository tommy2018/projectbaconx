<?php 
include_once 'global.inc.php';

if (!isset($_GET['query'])) die();

$db = Database::getInstance()->connect();
$result = [];
$query = $_GET['query'];
$uidSearch = false;

if (preg_match('/^[1-9][0-9]*$/', $query)) $uidSearch = true;

if ($uidSearch)
	$stmt = $db->prepare('SELECT uid, username, fullName, email FROM user WHERE uid = :query OR username LIKE :query OR email LIKE :query OR fullName LIKE :query LIMIT 10');
else
	$stmt = $db->prepare('SELECT uid, username, fullName, email FROM user WHERE username LIKE :query OR email LIKE :query OR fullName LIKE :query LIMIT 10');

if ($stmt->execute(array('query' => $query.'%'))) {
	while ($row = $stmt->fetch())
		$result[] = array('uid' => $row['uid'], 'fullName' => $row['fullName'], 'email' => $row['email']);
}

header('Content-type:application/json');
echo json_encode($result);
?>