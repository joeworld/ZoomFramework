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
*
* DATABASE CONFIGURATION FILE
*
**/

/**
* Driver Library
*/

class db_driver
{

  private $driver = null;

  public function LoadGivenDriver($given = false){
       if($given != false){
       $driver_file = BASEPATH.'/database/drivers/'.$given.'/'.$given.'_driver.php';
       $validDrivers = unserialize(ValidDriversAvailable());
       if(! file_exists($driver_file)){
         print("Your database connection failed because your driver was not surpported <br><br><b>Below are the surpported drivers:</b><br>");
         foreach ($validDrivers as $Driver) {
           print("<b>".$Driver."</b><br>");
         }
         exit();
       }
       else{
         require_once($driver_file);
         $driverClass = "Zm_".$given.'_driver';
         $mycon =  new $driverClass();
         return $mycon;
       }
       }else{
         require_once(BASEPATH.'/database/drivers/pdo_driver.php');
         $mycon = new Zm_pdo_driver();
         return $mycon;
       }
  }

  public function __construct()
  {
    $validDrivers = unserialize(ValidDriversAvailable());
    $this->driver = db::DB_DRIVER;
    if(! in_array($this->driver,$validDrivers) && $this->driver != ""){
      print("Your database connection failed because your driver was not surpported <br><br><b>Below are the surpported drivers:</b><br>");
      foreach ($validDrivers as $Driver) {
        print("<b>".$Driver."</b><br>");
      }
      exit();
    }elseif(in_array($this->driver,$validDrivers)){
    $loaddriver = $this::LoadGivenDriver($this->driver);
    return $loaddriver;
    }
  }
}
