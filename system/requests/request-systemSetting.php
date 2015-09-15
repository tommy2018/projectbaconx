<?php
class SystemSettingRequest {
	public function processRequest() {
		if (!isset($_GET['do'])) return array(false, 'Invalid request');
	
		$do = $_GET['do'];
	
		switch ($do) {
			default:
				return array(false, 'Invalid request');
		}
	}
}
?>