<?php
	/**
	 * Slim TJC\View\Layout.
	 * - This is used to override the default View object with Slim.
	 *
	 * (c) Copyright 2014 Tyler Junior College
	 * See LICENSE file for License details
	 **/

namespace TJC\View;

use \Slim\View as SlimView;

class Layout extends SlimView {

	const JAVASCRIPT_FILE = '<script type="text/javascript" src="%s"></script>';
	const JAVASCRIPT = '<script type="text/javascript">%s</script>';
	const STYLESHEET = '<link rel="stylesheet" href="%s" />';
	const STYLE = '<style type="text/css">%s</style>';

	protected $layout = null;
	protected $layoutData = array('js' => array(), 
								  'css' => array());
	protected $enabled = TRUE;

	public function setLayout($template) {
		$layout = $this->getTemplatePathname($template);
		if(!is_file($layout)) {
			throw new \RuntimeException("Layout file `$template` does not exist.");
		} else {
			$this->layout = $template;
		}
	}

	public function getLayoutData($key = null) {
		if(!is_null($key) && array_key_exists($key, $this->layoutData)) {
			return $this->layoutData[$key];
		} elseif(!is_null($key) && !array_key_exists($key, $this->layoutData)) {
			return FALSE;
		} else {
			return $this->layoutData;
		}
	}

	public function setLayoutData($data, $value = null) {
		if(is_array($data)) { // This allows for quick adding of data to the layout.
			$this->layoutData = array_merge($this->layoutData, $data);
		} elseif(!is_null($value)) {
			$this->layoutData[$data] = $value;
		}
	}

	public function setJavascriptData() {

	}

	public function setStyleData() {

	}
	
	public function disableLayout() {
		if($this->enabled === TRUE) {
			$this->enabled = FALSE;
		}
	}

	public function enableLayout() {
		if($this->enabled === FALSE) {
			$this->enabled = TRUE;
		}
	}

	public function render($template, $data = null) {
		if(!is_null($this->layout) && $this->enabled === TRUE) { // Render the layout!!
			$this->setLayoutData('content', parent::render($template, $data));

			return parent::render($this->layout, $this->layoutData);
		} else {
			return parent::render($template, $data);
		}
	}
}