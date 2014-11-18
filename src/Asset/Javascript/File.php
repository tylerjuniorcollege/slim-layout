<?php
	/**
	 * Slim TJC\View\Layout.
	 * - This is used to override the default View object with Slim.
	 *
	 * (c) Copyright 2014 Tyler Junior College
	 * See LICENSE file for License details
	 **/

namespace TJC\View\Asset\Javascript;

use \TJC\View\Asset\AssetAbstract;

class File
	extends AssetAbstract
{
	protected $renderString = '<script type="text/javascript" src="%s"></script>';
}