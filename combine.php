<?php
if (!isset($_GET['chunk'])) exit(json_encode(array('success' => false, 'errorMessage' => '3')));
$fp = fopen('files/data.mp4', 'w');
for ($i = 0; $i < (int)$_GET['chunk']; $i++) {
	$ffp = fopen('files/' . $i, 'r');
	fwrite($fp, fread($ffp, filesize('files/' . $i)));
	fclose($ffp);
}
fclose($fp);
?>