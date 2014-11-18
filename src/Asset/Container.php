<?php
	/**
	 * Slim TJC\View\Layout.
	 * - This is used to override the default View object with Slim.
	 *
	 * (c) Copyright 2014 Tyler Junior College
	 * See LICENSE file for License details
	 **/

namespace TJC\View\Asset;

use \TJC\View\Asset\AssetAbstract;

// Container is the simple container class for all assets passed to the layout script.
class Container
{
	protected $assets = array();

	public function appendAsset(AssetAbstract $asset) {
		$this->assets[] = $asset;
		return $this;
	}

	public function prependAsset(AssetAbstract $asset) {
		array_unshift($this->assets, $asset);
		return $this;
	}

	// This will insert an asset in to a specific location in the array and then shift the element keys.
	public function insetAsset(AssetAbstract $asset, int $location) {
		array_splice($this->assets, $location, 0, array($asset));
		return $this;
	}

	public function render() {
		$output = array('rendered' => array(), 'original' => array());

		foreach($this->assets as $id => $asset) {
			$output['rendered'][] = $asset->getRendered();
			$output['original'][] = $asset->getOriginal();
		}

		return $output;
	}

	public function getAssets() {
		return $this->assets;
	}
}