<?php
	/**
	 * Slim TJC\View\Layout.
	 * - This is used to override the default View object with Slim.
	 *
	 * (c) Copyright 2014 Tyler Junior College
	 * See LICENSE file for License details
	 **/

namespace TJC\View\Asset\Css;

use \TJC\View\Asset\AssetAbstract;

class Inline
	extends AssetAbstract
{
	protected $renderString = "<style type=\"text/css\">\n%s\n</style>";
}