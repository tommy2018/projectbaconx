<?php
class Template {
	private $context;
	
	public function display($page) {
		$file = DOC_ROOT . 'templates/' . $page . '.php';
		
		if (file_exists($file)) {
			$this->context['core']['body'] = $file;
		
		global $setting;
		$this->context['content']['applicationTitle'] = 'eShow Event Management System';
		include_once DOC_ROOT. 'templates/core/core.php';
		} else fatalError('Template file not found');
	}
	
	public function assign($index, $object) {
		$this->context['content'][$index] = $object;
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
	
	private function getVar($index) {
		if (isset($this->context['content'][$index])) 
			return $this->context['content'][$index]; 
		else
			return null;
	}
}
?>