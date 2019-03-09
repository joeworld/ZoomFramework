<?php

//Un comment the following code if you have https installed

// if (!(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || 
//    $_SERVER['HTTPS'] == 1) ||  
//    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&   
//    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'))
// {
//    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//    header('HTTP/1.1 301 Moved Permanently');
//    header('Location: ' . $redirect);
//    exit();
// }

session_start();

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

/**
 * Note always check your error.log file in your app folder for php errors
**/


/*
*
* Define your environment for custom error reporting
*
* Options are development, testing or production, By default development will show errors but testing and production will hide them.
*
*/

$application_environment = 'development';

/*
 *---------------------------------------------------------------
 * SYSTEM DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "appsys"
 * directory than the default one you can set its name here. The directory
 * can also be renamed or relocated anywhere on your server. If you do,
 * use an absolute (full) server path.
 *
 * NO TRAILING SLASH!
 */

$system_path = 'system';

/*
 *---------------------------------------------------------------
 * APPLICATION DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * directory than the default one you can set its name here. The directory
 * can also be renamed or relocated anywhere on your server. If you do,
 * use an absolute (full) server path.
 *
 * NO TRAILING SLASH!
 */

$application_folder = 'app';

/*
 *---------------------------------------------------------------
 * APPLICATION index.php
 *---------------------------------------------------------------
 *
 * If your index file was changed both in the .htaccess file and this file please make changes below
 *
 * NO TRAILING SLASH!
 */

// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------
// The name of THIS file

define('FILESELF', pathinfo(__FILE__, PATHINFO_BASENAME));

/*
|--------------------------------------------------------------------------
| Set environment
|--------------------------------------------------------------------------
|
|---------------------------------------------------------------
| ERROR REPORTING
| ---------------------------------------------------------------
|
| Different environments will require different levels of error reporting.
| By default development will show errors but testing and live will hide them.
|
*/

define('ENVIRONMENT', $application_environment);

/*
 *---------------------------------------------------------------
 * SYSTEM DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" directory.
 * Set the path if it is not in the same directory as this file.
 */

define('BASEPATH', $system_path);

// The path to the "system" directory

if (is_dir($system_path))
{
  if (($_temp = realpath($system_path)) !== FALSE)
  {
    $system_path = $_temp;
  }
  else
  {
    $system_path = strtr(
      rtrim($system_path, '/\\'),
      '/\\',
      DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
    );
  }
}
elseif (is_dir(BASEPATH.$system_path.DIRECTORY_SEPARATOR))
{
  $system_path = BASEPATH.strtr(
    trim($system_path, '/\\'),
    '/\\',
    DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
  );
}
else
{
  header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
  echo 'Your appsystem folder path does not appear to be set correctly. Please open the following file and correct this: '.FILESELF;
  exit(3); // EXIT_CONFIG
}

/*
*define to system path
*
*/
// The path to the "application" directory

if(defined('BASEPATH') == '') die('Your appsystem was left empty');


if (is_dir($application_folder))
{
  if (($_temp = realpath($application_folder)) !== FALSE)
  {
    $application_folder = $_temp;
  }
  else
  {
    $application_folder = strtr(
      rtrim($application_folder, '/\\'),
      '/\\',
      DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
    );
  }
}
elseif (is_dir(BASEPATH.$application_folder.DIRECTORY_SEPARATOR))
{
  $application_folder = BASEPATH.strtr(
    trim($application_folder, '/\\'),
    '/\\',
    DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
  );
}
else
{
  header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
  echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.FILESELF;
  exit(3); // EXIT_CONFIG
}

// Name of the "system" directory


define('SYSDIR', basename(BASEPATH));

// Name of the "application" directory

define('APPATH', $application_folder);


if (file_exists(BASEPATH.'/core/zoom.php')) {

  require_once(BASEPATH.'/core/zoom.php');

}
else{

  die('Your appsystem folder path does not appear to be set correctly. Please open the following file and correct this: '.FILESELF);

}
