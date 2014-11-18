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
use \TJC\View\Asset\Container as Container;
use \TJC\View\Asset\Javascript\File as JavascriptFile;
use \TJC\View\Asset\Javascript\Inline as JavascriptInline;
use \TJC\View\Asset\Css\File as CssFile;
use \TJC\View\Asset\Css\Inline as CssInline;

class Layout 
	extends SlimView
{
	protected $layout = null;
	protected $layoutData = array();
	protected $jsAssets;
	protected $cssAssets;
	protected $enabled = TRUE;

	public function __construct() {
		$this->jsAssets = new Container();
		$this->cssAssets = new Container();
	}

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

	public function getJavascript() {
		return $this->jsAssets;
	}

	public function getStyle() {
		return $this->cssAssets;
	}

	public function appendJavascript($asset) {
		$this->jsAssets->appendAsset(new JavascriptInline($asset));
		return $this;
	}

	public function appendJavascriptFile($asset) {
		$this->jsAssets->appendAsset(new JavascriptFile($asset));
		return $this;
	}

	public function appendStyle($asset) {
		$this->cssAssets->appendAsset(new CssInline($asset));
		return $this;
	}

	public function appendStylesheet($asset) {
		$this->cssAssets->appendAsset(new CssFile($asset));
		return $this;
	}

	public function prependJavascript($asset) {
		$this->jsAssets->prependAsset(new JavascriptInline($asset));
		return $this;
	}

	public function prependJavascriptFile($asset) {
		$this->jsAssets->prependAsset(new JavascriptFile($asset));
		return $this;
	}

	public function prependStyle($asset) {
		$this->cssAssets->prependAsset(new CssInline($asset));
		return $this;
	}

	public function prependStylesheet($asset, $location) {
		$this->cssAssets->prependAsset(new CssFile($asset));
		return $this;
	}

	public function insertJavascript($asset, $location) {
		$this->jsAssets->insertAsset(new JavascriptInline($asset));
		return $this;
	}

	public function insertJavascriptFile($asset, $location) {
		$this->jsAssets->insertAsset(new JavascriptFile($asset));
		return $this;
	}

	public function insertStyle($asset, $location) {
		$this->cssAssets->insertAsset(new CssInline($asset));
		return $this;
	}

	public function insertStylesheet($asset, $location) {
		$this->cssAssets->insertAsset(new CssFile($asset));
		return $this;
	}

	public function render($template, $data = null) {
		if(!is_null($this->layout) && $this->enabled === TRUE) { // Render the layout!!
			$this->setLayoutData('content', parent::render($template, $data));
			$this->setLayoutData('js', $this->jsAssets->render());
			$this->setLayoutData('css', $this->cssAssets->render());

			return parent::render($this->layout, $this->layoutData);
		} else {
			return parent::render($template, $data);
		}
	}
}