<?php

/**
* Zoom
*
* Ninimal but powerful web application framework for PHP
*
* This content is not open source but application built with zoom can be modified by users, but not to be sold
*
* Copyright (c) 2018, Zoom Inc, ZumClouds Nigeria.
*
**/

defined('BASEPATH') OR exit('No direct script access allowed');

/**
*
* PATH HELPER
*
**/

if ( ! function_exists('setpath'))
{
	/**
	 * Set Realpath
	 *
	 * @param	string
	 * @param	bool	checks to see if the path exists
	 * @return	string
	 */
	function setpath($path, $check_existance = FALSE)
	{
		// Security check to make sure the path is NOT a URL. No remote file inclusion!
		if (preg_match('#^(http:\/\/|https:\/\/|www\.|ftp|php:\/\/)#i', $path) OR filter_var($path, FILTER_VALIDATE_IP) === $path)
		{
			die('The path you submitted must be a local server path, not a URL');
		}

		// Resolve the path
		if (realpath($path) !== FALSE)
		{
			$path = realpath($path);
		}
		elseif ($check_existance && ! is_dir($path) && ! is_file($path))
		{
			die('Not a valid path: '.$path);
		}

		// Add a trailing slash, if this is a directory
		return is_dir($path) ? rtrim($path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR : $path;
	}
}
