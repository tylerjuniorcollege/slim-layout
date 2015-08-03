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
use \TJC\View\Asset\Title\Container as TitleContainer;
use \TJC\View\Asset\Title\Part as TitlePart;
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
	protected $titleParts;
	protected $enabled = TRUE;

	public function __construct() {
		$this->jsAssets = new Container();
		$this->cssAssets = new Container();
		$this->titleParts = new TitleContainer();

		return parent::__construct();
	}

	// Layout Configuration Getters and Setters
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
		return $this;
	}

	// enable/disable Layout functions. - Layout is enabled by default.
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

	// Getters for the AssetContainers
	public function getJavascript() {
		return $this->jsAssets;
	}

	public function getStyle() {
		return $this->cssAssets;
	}

	public function getTitle() {
		return $this->titleParts;
	}

	// Javascript/Stylesheet/Inline Code Functions
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

	public function appendTitle($asset) {
		$this->titleParts->appendAsset(new TitlePart($asset));
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

	public function prependStylesheet($asset) {
		$this->cssAssets->prependAsset(new CssFile($asset));
		return $this;
	}

	public function prependTitle($asset) {
		$this->titleParts->prependAsset(new TitlePart($asset));
	}

	public function insertJavascript($asset, $location) {
		$this->jsAssets->insertAsset(new JavascriptInline($asset), $location);
		return $this;
	}

	public function insertJavascriptFile($asset, $location) {
		$this->jsAssets->insertAsset(new JavascriptFile($asset), $location);
		return $this;
	}

	public function insertStyle($asset, $location) {
		$this->cssAssets->insertAsset(new CssInline($asset), $location);
		return $this;
	}

	public function insertStylesheet($asset, $location) {
		$this->cssAssets->insertAsset(new CssFile($asset), $location);
		return $this;
	}

	public function insertTitle($asset, $location) {
		$this->titleParts->insertAsset(new TitlePart($asset), $location);
		return $this;
	}

	// Overloading render() function to inject the layout.
	public function render($template, $data = array()) {
		if(!is_null($this->layout) && $this->enabled === TRUE) { // Render the layout!!
			$this->setLayoutData('content', parent::render($template, array_merge($this->layoutData, (array)$data)));
			$this->setLayoutData('js', $this->jsAssets->render());
			$this->setLayoutData('css', $this->cssAssets->render());
			$this->setLayoutData('title', $this->titleParts->render());

			return parent::render($this->layout, $this->layoutData);
		} else {
			return parent::render($template, $data);
		}
	}

	// New function for pre-rendering JSON without having to call disableLayout AND other rendering code.
	public function renderJson($data, $status = 200) {
		$app = \Slim\Slim::getInstance();

		$app->response()->status($status);
		$app->response()->header('Content-Type', 'application/json');

		$body = json_encode($data);
		$app->response()->body($body);
		$app->stop();
	}
}
