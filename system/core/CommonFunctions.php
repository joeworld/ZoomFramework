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

if ( ! function_exists('load_libClass'))
{
	function load_libClass($class, $directory = 'libs', $param = NULL)
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
			if (file_exists($path.'/'.$directory.'/'.$class.'.php'))
			{
				$name = 'ZM_'.$class;

				if (class_exists($name, FALSE) === FALSE)
				{
					require_once($path.'/'.$directory.'/'.$class.'.php');
				}
				break;
			}
		}

		// Did we find the class?
		if ($name === FALSE)
		{
			echo 'Unable to locate the specified class: '.$class.'.php';
			exit(5);
		}
		$_classes[$class] = isset($param)
			? new $name($param)
			: new $name();
		return $_classes[$class];
	}
}
// --------------------------------------------------------------------

// ------------------------------------------------------------------------

if ( ! function_exists('load_coreClass'))
{
	function load_coreClass($class, $directory = 'core', $param = NULL)
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
    // You can add to the array if you have other defined dirs..

		foreach (array(BASEPATH) as $path)
		{
			if (file_exists($path.'/'.$directory.'/'.$class.'.php'))
			{
				$name = 'ZM_'.$class;

				if (class_exists($name, FALSE) === FALSE)
				{
					require_once($path.'/'.$directory.'/'.$class.'.php');
				}
				break;
			}
		}

		// Did we find the class?
		if ($name === FALSE)
		{
			echo 'Unable to locate the specified class: '.$class.'.php';
			exit(5);
		}

		$_classes[$class] = isset($param)
			? new $name($param)
			: new $name();

		return $_classes[$class];
	}
}

// --------------------------------------------------------------------


if (! function_exists('DatabaseConnect')) {
	function DatabaseConnect(){
		$mycon = new db_driver();
		$mycon = $mycon->__construct();
		return $mycon;
	}
}

// --------------------------------------------------------------------

if ( ! function_exists('Start_Class')) {

	/**
	*Define STARTCLASS for class to be started
	**/

    if(! defined('STARTCLASS')){
	define('STARTCLASS', serialize( $SysConfig['loads_array'] ));
    }

	/**
	*Define STARTCLASS for app autoloader
	**/

    if(file_exists(APPATH.'/config/autoload.php')){
    require APPATH.'/config/autoload.php';
    }else{
    die("Your autoload.php file is missing in your application config file");
    }

    if(! defined('STARTCLASSAPP')){
	  define('STARTCLASSAPP', serialize($autoload['class']));
    }

    function Start_Class(){

    /**
    * Split the array for app autoloader first
    */

   foreach(unserialize(STARTCLASSAPP) as $classapp) {
   if (class_exists($classapp)) {
   new $classapp();

   }

   }

    /**
    * Split the array
    */

   foreach ( unserialize(STARTCLASS) as $class) {

   if (class_exists($class)) {

   new $class();

   }

   }

   }
}


// ------------------------------------------------------------------------

if ( ! function_exists('is_https'))
{
	/**
	 * Is HTTPS?
	 *
	 * Determines if the application is accessed via an encrypted
	 * (HTTPS) connection.
	 *
	 * @return	bool
	 */
	function is_https()
	{

		if ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off')
		{
			return TRUE;
		}
		elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https')
		{
			return TRUE;
		}
		elseif ( ! empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off')
		{
			return TRUE;
		}

		return FALSE;
	}

}

// ------------------------------------------------------------------------

if( ! function_exists('environ')){

     /**
      * Switch Case for Environment
      */

      function environ(){
				switch (ENVIRONMENT)
        {
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;
	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>='))
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}
		else
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
	break;
	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly. Correct this in '.INDEX;
		exit(1); // EXIT_ERROR
      }
		}
}

// ------------------------------------------------------------------------

if (! function_exists('RequiredFile')) {
   function RequiredFile($array, $directory = false){
		 $array = unserialize($array);
		 if ($directory == false) {
		 	  $directory = 'config';
		 }
		 foreach ($array as $file) {
			$fileself = APPATH.'/'.$directory.'/'.$file;
			if(file_exists($fileself)){
				require_once($fileself);
			}
			else{
				//Check the appsys folders
				$fileself = BASEPATH.'/'.$directory.'/'.$file;
				if(file_exists($fileself)){
					require_once($fileself);
				}
				else{

					/**
					 * Load Helpers
					 */

          $dir = 'core/helpers';
					$fileself = BASEPATH.'/'.$dir.'/'.$file.'.php';
					if(file_exists($fileself)){
						require_once($fileself);
					}else{
						die('('.$fileself. ') Could not be found in any of the directories, in app folder and Appsystem folder');
					}

				}
			}
		 }

	 }
}

// -----------------------------------------------------------------

if ( ! function_exists('is_cli'))
{

	/**
	 * Is CLI?
	 *
	 * Test to see if a request was made from the command line.
	 *
	 * @return 	bool
	 */
	function is_cli()
	{
		if(PHP_SAPI === 'cli'){
			return true;
		}else{
			return false;
		}
	}
}

// -------------------------------------------------------------------


// -----------------------------------------------------------------

if ( ! function_exists('ini_sword'))
{
	/**
	 * inisword
	 *
	 * Initialize sword template engine
	 *
	 */
	function ini_sword()
	{
		if(class_exists('sword')){
    return new sword();
		}else{
			die("Could not Initialize sword at this time error: class does not exist");
		}
  }
}

// -------------------------------------------------------------------

if(! function_exists('show404')){
	function show404(){
	$error = new Exceptions();
	return $error->show404();
	}
}

if(! function_exists('ValidDriversAvailable')){

	function ValidDriversAvailable(){

   /**
    * DO NOT EDIT THIS PART
    */

	$arrayName = serialize(array('pdo', 'mysqli', 'mysql', 'postgre'));

    return $arrayName;

	}

}

if (! function_exists('loadImportant')) {

function loadImportant($requiredFiles, $helpers) {

/**
 * Load Important config files in application config folder
**/

RequiredFile($requiredFiles);

/**
 * Load Important helpers
**/

RequiredFile($helpers);

//Load the environment

environ();

/**
 *Call Class Loader file
**/

load_coreClass('Loader');

/**
 *Start Important classes after load
**/

Start_Class();

}

loadImportant($SysConfig['requireFiles'], serialize($autoload['helpers']));

}