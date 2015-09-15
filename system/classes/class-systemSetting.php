<?php
class SystemSetting {
	private static $self;
	private $settings;
	
	private function __construct() {
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('SELECT object FROM application WHERE id = "systemSettings"');
		
		if ($stmt->execute()) {
			if ($result = $stmt->fetch())
				$this->settings = json_decode(base64_decode($result['object']), true);
			else throw new PBXException('sys-00');
		} else throw new PBXException('db-00');
	}
	
	public function __clone() {}
	
	public static function getInstance() {
		if (!self::$self) self::$self = new SystemSetting();
		return self::$self;
	}
	
	public function setSetting($key, $value) {
		if (!isset($this->settings[$key]))
			return false;

		$temp = $this->settings;
		$temp[$key] = $value;
		
		$db = Database::getInstance();
		$conn = $db->connect();
		
		$stmt = $conn->prepare('UPDATE application SET object = :object WHERE id = "systemSettings"');
		
		if ($stmt->execute(array('object' => base64_encode(json_encode($temp))))) {
			if ($stmt->rowCount() >= 1) {
				$this->settings[$key] = $value;
				return true;
			} else
				return false;
		} else throw new PBXException('db-00');
	}
	
	public function getSetting($key) {
		if (isset($this->settings[$key]))
			return $this->settings[$key];
		else
			return null;
	}
}
?>