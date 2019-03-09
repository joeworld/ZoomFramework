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

/**Loader class
 *
 *Loads framework component
 *
**/

/**
 * Start class with defined STARTCLASS
 */

class ZM_Loader
{

/****** Autoloader for Application path ******/

public function ApplicationLoaders()
{

/**
* A condition statement to check if a const has been defined
**/

    if (!defined('DIR')) {
    define( 'DIR', APPATH );
    }
    if(!defined('DS')){
    define( 'DS', DIRECTORY_SEPARATOR );
    }if(!defined('CLASSES')){
    define( 'CLASSES', DIR. DS. 'classes' );
    }if(!defined('CONTROLLERS')) {
    define( 'CONTROLLERS', DIR. DS. 'controllers' );
    }if(!defined('MODELS')) {
    define( 'MODELS', DIR. DS. 'models' );
    }if(!defined('LIBS')) {
    define( 'LIBS', DIR . DS . 'libs');
    }if(!defined('CONFIGURATION')) {
    define( 'CONFIGURATION', DIR . DS . 'config');
    }

    /**
    *Need atleast PHP 5.6 for constant arrays.
    **/

if(!defined('AUTOLOAD_CLASSES')){
define('AUTOLOAD_CLASSES', serialize( array( CLASSES, CONTROLLERS, MODELS, LIBS, CONFIGURATION)));
}

}

  /****** Autoloader for System path ******/

  public function SystemLoaders()
  {

    if(!defined('SYSDIR')){
    define( 'SYSDIR', BASEPATH );
    }
    if(!defined('SYSDS')){
    define( 'SYSDS', DIRECTORY_SEPARATOR );
    }
    if (!defined('SYSLIBS')) {
    define( 'SYSLIBS', SYSDIR. SYSDS. 'libs' );
    }
    if (!defined('SYSDATABASE')) {
    define( 'SYSDATABASE', SYSDIR . SYSDS. 'database');
    }
    if (!defined('SYSCORE')) {
    define( 'SYSCORE', SYSDIR . SYSDS. 'core');
    }
    if (!defined('SECURITY')) {
    define( 'SECURITY', SYSDIR . SYSDS. 'security');
    }
    if (!defined('SYSCONFIG')) {
    define( 'SYSCONFIG', SYSDIR . SYSDS. 'config');
    }
    /**
     * You can add more directory if you want to
     **/

    /**
    *Need atleast PHP 5.6 for constant arrays.
    **/

  if(!defined('AUTOLOAD_SYSTEM')){

  define('AUTOLOAD_SYSTEM', serialize( array(SYSLIBS, SYSDATABASE, SYSCORE, SECURITY, SYSCONFIG)));

  }

 }

 //End classes

}

  function Loader($class)
  {
  $ZM_Loader = new ZM_Loader();
  $ZM_Loader->ApplicationLoaders();
  $class_file = DIR . DS . $class . '.php';
  if(file_exists($class_file)){
    require_once($class_file);
  }else{
    foreach ( unserialize(AUTOLOAD_CLASSES) as $class_path) {
      $class_file = $class_path . DS . $class . '.php';
      if (file_exists($class_file)) require_once($class_file);
    }
  }
}

function SystemLoader($SysClass)
{
$ZM_Loader = new ZM_Loader();
$ZM_Loader->SystemLoaders();
$class_file = SYSDIR . SYSDS . $SysClass . '.php';
if(file_exists($class_file)){
  require_once($class_file);
}else{
  foreach (unserialize(AUTOLOAD_SYSTEM) as $class_path) {
    $class_file = $class_path . SYSDS . $SysClass . '.php';
    if (file_exists($class_file)) require_once($class_file);
  }
}
}


/**
 *Using Spl autoload register
**/

spl_autoload_register('Loader');

spl_autoload_register('SystemLoader');
