<?php
	/**
	 * Slim ViewLayout.
	 * - This is used to override the default View object with Slim.
	 *
	 * (c) Copyright 2014 Tyler Junior College
	 * See LICENSE file for License details
	 **/

namespace TJC;

use \Slim\View as SlimView;

class ViewLayout extends SlimView {
	protected $layout = null;
	protected $layoutData = array();

	public function setLayout($template) {
		$layout = $this->getTemplatePathname($template);
		if(!is_file($layout)) {
			throw new \RuntimeException("Layout file `$template` does not exist.");
		} else {
			$this->layout = $template;
		}
	}

	public function getLayoutData() {
		return $this->layoutData;
	}

	public function setLayoutData($data, $value = null) {
		if(is_array($data)) {
			$this->layoutData = array_merge($this->layoutData, $data);
		} elseif(!is_null($value)) {
			$this->layoutData[$data] = $value;
		}
	}

	public function renderLayout($template, $data = null) {
		if(!is_null($this->layout)) { // Render the layout!!
			$this->setLayoutData('content', parent::render($template, $data));

			return parent::render($this->layout, $this->layoutData);
		} else {
			return parent::render($template, $data);
		}
	}
}