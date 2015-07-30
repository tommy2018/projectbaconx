<?php

/* Will return null if there is no such user */
private function __construct() {
	if ($uid = self::getSessionData('uid'))
		if ($_SERVER['HTTP_USER_AGENT'] == $this->getSessionData('useragent'))
			$this->user = User::getUserByUid($uid);
}

public function __clone() {}

public static function getInstance() {
	if (!self::$self) self::$self = new Core();
	return self::$self;
}

public function isSignedIn() {
	if ($this->user && $_SERVER['HTTP_USER_AGENT'] == $this->getSessionData('useragent'))
		return true;
	else
		$this->signOut();

	return false;
}

public function signOut() {
	$this->user = null;
	$this->clearSession();
}

public function signIn($username, $password) {
	if ($temp = User::login($username, $password)) {
		$this->user = $temp;
		$this->setSessionData('uid', $this->user->getUid());
		$this->setSessionData('useragent', $_SERVER['HTTP_USER_AGENT']);
			
		return true;
	} else
		return false;
}

public function getUser() {
	return $this->user;
}

private static function getSessionData($index) {
	return (isset($_SESSION[$index]) ? $_SESSION[$index] : NULL);
}

private static function setSessionData($index, $value) {
	$_SESSION[$index] = $value;
}

private static function clearSession($index = null) {
	if ($index)
		unset($_SESSION[$index]);
	else
		session_unset();
}