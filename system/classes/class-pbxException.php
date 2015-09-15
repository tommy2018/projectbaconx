<?php
class PBXException extends Exception {
	static private $errorMessage = array('db-00' => 'Couldn\'t not execute database query.', 'sys-00' => 'System internal error.');
	protected $message;
	
	function __construct($errorCode) {
		if (isset(PBXException::$errorMessage[$errorCode]))
			$this->message = PBXException::$errorMessage[$errorCode] . ' (' . basename($this->getFile()) . ':' . $this->getLine() . ')';
		else
			$this->message = "Undefined exception";
	}
}
?>