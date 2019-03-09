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
 * Class that handles exceptions
**/

class Exceptions
{

    public function HandleNormalErrors($errno, $errstr, $errfile, $errline)
    {

    if (!(error_reporting() & $errno)) {
    // This error code is not included in error_reporting, so let it fall
    // through to the standard PHP error handler
    return false;
    }

    $classError = new ErrorHandler();

    if(!defined('E_PARSE'))            define('E_PARSE', 4);
    if(!defined('E_STRICT'))            define('E_STRICT', 2048);
    if(!defined('E_RECOVERABLE_ERROR')) define('E_RECOVERABLE_ERROR', 4096);
    switch ($errno) {
    case E_ERROR:               die($classError->DefError("Error",$errno, $errstr, $errfile, $errline));
    case E_WARNING:             die($classError->DefError("Warning",$errno, $errstr, $errfile, $errline));
    case E_PARSE:               die($classError->DefError("Parse",$errno, $errstr, $errfile, $errline));
    case E_NOTICE:              die($classError->DefError("Notice",$errno, $errstr, $errfile, $errline));
    case E_CORE_ERROR:          die($classError->DefError("Core Error",$errno, $errstr, $errfile, $errline));
    case E_CORE_WARNING:        die($classError->DefError("Core Warning",$errno, $errstr, $errfile, $errline));
    case E_COMPILE_ERROR:       die($classError->DefError("Compile Error",$errno, $errstr, $errfile, $errline));
    case E_COMPILE_WARNING:     die($classError->DefError("Compile Warning",$errno, $errstr, $errfile, $errline));
    case E_USER_ERROR:          die($classError->DefError("User Error",$errno, $errstr, $errfile, $errline));
    case E_USER_WARNING:        die($classError->DefError("User Warning",$errno, $errstr, $errfile, $errline));
    case E_USER_NOTICE:         die($classError->DefError("User Notice",$errno, $errstr, $errfile, $errline));
    case E_STRICT:              die($classError->DefError("Strict",$errno, $errstr, $errfile, $errline));
    case E_RECOVERABLE_ERROR:   die($classError->DefError("Recoverable Error",$errno, $errstr, $errfile, $errline));
    case E_DEPRECATED:          die($classError->DefError("Deprecated",$errno, $errstr, $errfile, $errline));
    default: die($classError->DefError($errno, $errstr, $errfile, $errline));
    break;
    }

    /* Don't execute PHP internal error handler */

    return true;

  }

  public function shutDownHandler(){

    $error = error_get_last();

    $classError = new ErrorHandler();

    // fatal error, E_ERROR === 1
    if ($error['type'] === E_ERROR) {
    die($classError->DefError("Fatal Error",$error["type"], $error["message"], $error["file"], $error["line"]));

  }

}

public function show404(){

  if(class_exists('error')){

  $errorClass = new error();

  if(method_exists($errorClass, 'index')){

  return $errorClass->index();

  }else{

  //Load Zoom default error page
  $classError = new ErrorHandler();
  $errorClass = $classError->custom404();
  die($errorClass);

  }

  }else{
  
  //Load Zoom default error page
  $classError = new ErrorHandler();
  $errorClass = $classError->custom404();
  die($errorClass);

  }

}

public function showDbError($msg){

  $classError = new ErrorHandler();
  $errorClass = $classError->DbShowError($msg);
  die($errorClass);
  
}

}

$newexceptions = new Exceptions();

/**
 * set to the defined error handler
**/

set_error_handler(array($newexceptions, 'HandleNormalErrors'));

/**
 * register_shutdown_function to handle fatal errors
 **/

register_shutdown_function(array($newexceptions, 'shutDownHandler'));