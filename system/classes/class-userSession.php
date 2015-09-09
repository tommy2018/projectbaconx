<?php
require_once 'system/classes/class-user.php';

class UserSession {
	private static $self;
	private $user;
	
	private function __construct() {	
		$uid = self::getSessionData('uid');
		$securityToken = self::getSessionData('securityToken');
		
		if ($uid && $securityToken) {
			if ($_SERVER['HTTP_USER_AGENT'] == $this->getSessionData('useragent')) {
				$user = User::getUserByUid($uid);
				if ($user && $user->getSecurityToken() == $securityToken) $this->user = $user;
			}
		}
	}
	
	public function __clone() {}
	
	public static function getInstance() {
		if (!self::$self) self::$self = new UserSession();
		return self::$self;
	}
	
	public function signOut() {
		$this->user = null;
		$this->clearSessionData();
	}
	
	public function signIn($username, $password) {
		$temp = User::signIn($username, $password);
		
		if ($temp) {
			$this->user = $temp;
			$this->setSessionData('uid', $this->user->getUid());
			$this->setSessionData('securityToken', $this->user->getSecurityToken());
			$this->setSessionData('useragent', $_SERVER['HTTP_USER_AGENT']);
				
			return $this->user;
		} else
			return null;
	}
	
	public function isSignedIn() {
		/* Check useragent and security token */
		if ($this->user && $_SERVER['HTTP_USER_AGENT'] == $this->getSessionData('useragent') && $this->user->getSecurityToken() == self::getSessionData('securityToken'))
			return $this->user;
		else
			$this->signOut();
	
		return false;
	}
	
	
	private static function getSessionData($index) {
		return (isset($_SESSION[$index]) ? $_SESSION[$index] : null);
	}
	
	private static function setSessionData($index, $value) {
		$_SESSION[$index] = $value;
	}
	
	private static function clearSessionData($index = null) {
		/* If an index is specificed, then clear that session data. Otherwise, destory the whole session object */
		if ($index) unset($_SESSION[$index]); else session_unset();
	}
}
?>