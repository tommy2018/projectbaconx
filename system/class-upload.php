<?php
class Upload {
	private $filename;
	private $filesize;
	private $uid;
	private $token;
	
	public function __construct($filename, $filesize, $uid) {
		
	}
	
	public function cancel() {
		
	}
	
	public function getToken() {
		
	}
	
	public function getUid() {
		return $this->uid;
	}
	
	public function getFilename() {
		return $this->filename;
	}
	
	public function getFilesize() {
		return $this->filesize;
	}
	
	public function getInstanceByToken($token) {
		
	}
}
?>