<?php
class ToolRequest {
	public function processRequest() {
		if (!isset($_GET['do'])) return array(false, 'Invalid request');
	
		$do = $_GET['do'];
	
		switch ($do) {
			case 'analyse-csv-file':
				return $this->analyseCsvFile();
			default:
				return array(false, 'Invalid request');
		}
	}
	
	private function analyseCsvFile() {
		if (!isset($_FILES["file"])) return array(false, 'Invalid request');
		if ($_FILES["file"]['error'] > 0) return array(false, 'Unable to process the uploaded file');
		
		$fileInfo = $_FILES["file"];
		$filename = $fileInfo['tmp_name'];
		
		if (is_readable($filename) && !is_dir($filename)) {
			$file = fopen($filename, 'r');
			if (!$file) return array(false, 'Unable to process the uploaded file');
			
			$data = [];
			$count = 0;
			
			while (!feof($file)) {
				$line = fgets($file);
				$line = trim($line, "\r\n");
			
				if (!feof($file)) {
					$matches = preg_split('/\t/', $line);
					$data[] = $matches;
					
					if (++$count > 500) {
						fclose($file);
						return array(false, 'Too many lines. The curreny limit is 500.');
					}
				}
			}
			
			fclose($file);
			return array(true, $data);
		}
		
		return array(false, 'Unable to process the uploaded file');
	}
}