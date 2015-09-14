<?php
$filename = "export.txt";
$pattern['csv'] = '/,/';
$pattern['tab'] = '/\t/';

if (is_readable($filename) && !is_dir($filename)) {
	$file = fopen($filename, 'r');
	
	if (!$file) exit();
	
	$data = [];

	while (!feof($file)) {
		$line = fgets($file);
		$line = trim($line, "\r\n");
		
		if (!feof($file)) {
			$matches = preg_split($pattern['tab'], $line);
			$data[] = $matches;
		}
	}

	header('Content-Type: application/json');
	echo json_encode($data);
	
	fclose($file);
}
?>
