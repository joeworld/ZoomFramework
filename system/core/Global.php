<?php
/**
 * Zoom
 *
 * An open source application development framework for PHP
 *
 * This content is released under the Joeworld
 *
 * Copyright (c) 2017, Joestack. - http://iamjoestack.com/
 *
 **/
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Common Functions For this framework
 *
 */

// ------------------------------------------------------------

if ( ! function_exists('check_php'))
{
/**
*Determine the current version of PHP is equal to or greater than what is been supplied
**/
	function check_php($ver)
	{
		static $_check_php;
		$ver = (string) $ver;

		if ( ! isset($_check_php[$ver]))
		{
			$_check_php[$ver] = version_compare(PHP_VERSION, $ver, '>=');
		}

		return $_check_php[$ver];
	}

}
// ------------------------------------------------------------------------

if ( ! function_exists('load_library_class'))
{
	function load_library_class($class, $directory = 'libs', $param = NULL)
	{
		static $_classes = array();

		// Does the class exist? If so, we're done...
		if (isset($_classes[$class]))
		{
			return $_classes[$class];
		}

		$name = FALSE;

		// Look for the class first in the local application/libs folder
		// then in the native appsys/libs folder
		foreach (array(APPATH, BASEPATH) as $path)
		{
			if (file_exists($path.$directory.'/'.$class.'.php'))
			{
				$name = 'ZM_'.$class;

				if (class_exists($name, FALSE) === FALSE)
				{
					require_once($path.$directory.'/'.$class.'.php');
				}

				break;
			}
		}

		// Did we find the class?
		if ($name === FALSE)
		{
			echo 'Unable to locate the specified class: '.$class.'.php';
			exit(5); // EXIT_UNK_CLASS
		}
		$_classes[$class] = isset($param)
			? new $name($param)
			: new $name();
		return $_classes[$class];
	}
}
// --------------------------------------------------------------------
