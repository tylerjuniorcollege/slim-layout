<?php
	/**
	 * Slim TJC\View\Layout.
	 * - This is used to override the default View object with Slim.
	 *
	 * (c) Copyright 2014 Tyler Junior College
	 * See LICENSE file for License details
	 **/

namespace TJC\View\Asset\Title;

use TJC\View\Asset\Container as AssetContainer;

class Container 
	extends AssetContainer {

	protected $sep = ' - ';

	public function separator($sep = NULL) {
		if(is_null($sep)) {
			return $this->sep;
		} else {
			$this->sep = $sep;
			return TRUE;
		}
	}

	// Overloading render() to have a proper render.
	public function render() {
		return implode($this->sep, $this->assets);
	}
}