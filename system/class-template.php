<?php
include_once 'functions-common.php';

class Template {
	private $context;
	
	public function display($page) {
		$file = DOC_ROOT . 'templates/' . $page . '.php';
		
		if (file_exists($file)) {
			$this->context['core']['body'] = $file;
			include_once DOC_ROOT. 'templates/core/core.php';
		} else
			fatalError('Template file not found');
	}
	
	public function assign($name, $object) {
		$this->context['content'][$name] = $object;
	}
	
	public function addScript($filename) {
		$this->context['core']['script'][] = $filename;
	}
	
	public function addStylesheet($filename) {
		$this->context['core']['css'][] = $filename;
	}
	
	public function setTitle($title) {
		$this->context['core']['title'] = $title;
	}
}
?>