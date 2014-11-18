<?php
	/**
	 * Slim TJC\View\Layout.
	 * - This is used to override the default View object with Slim.
	 *
	 * (c) Copyright 2014 Tyler Junior College
	 * See LICENSE file for License details
	 **/

namespace TJC\View\Asset;

abstract class AssetAbstract
{
	protected $asset;
	protected $renderString;

	public function __construct(string $asset) {
		$this->asset = $asset;
	}

	public function getRendered() {
		return sprintf($this->renderString, $this->asset);
	}

	public function getOriginal() {
		return $this->asset;
	}
}