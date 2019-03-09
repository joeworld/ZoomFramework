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
* DO NOT EDIT THIS PAGE WITHOUT VITAL KNOWLEDGE
*
**/


class view extends mvc
{

  public function __construct()
  {
   parent::__construct();
   //print("This is the view");
  }


  public function render($_name, $isInclude = false, $allowcomponents = true, $override = false)
  {
   //Check if main file exist either in sword format or php format or both

   $swordini = null;

   $name = APPATH.'/views/' . $_name;
   if(file_exists($name)){
   $name = APPATH.'/views/' . $_name;
   }else{
   $name = APPATH.'/views/' . $_name . '.php';
   if(file_exists($name)){
   $name = $name;
   }else{
   $name = APPATH.'/views/' . $_name . '.sword.php';
   if(file_exists($name)){
     $swordini = new sword();
     $name = $name;
   }else{
     $name = APPATH.'/views/' . $_name . '.sword';
     if(file_exists($name)){
       $swordini = new sword();
       $name = $name;
     }else{
       die("Your view path for ".$name." was not found");
     }
   }
   }
   }

    if ($isInclude == true) {
      if(is_array($isInclude)){
      if(array_key_exists('header', $isInclude) && array_key_exists('footer', $isInclude)){
        $header = $isInclude['header'];
        $footer = $isInclude['footer'];
        require_once APPATH.'/views/' . $header;
        if($swordini !== null){
        $swordini->render($name);
        }else{
        require_once $name;
        }
        require_once APPATH.'/views/' . $footer;
      }else{
        require_once $name;
      }
    }else{
      die($isInclude." should be an array having a footer and a header key(footer & header files)");
    }
    }
    else{
    $headerfile = APPATH.'/views/header.php';
    $footerfile = APPATH.'/views/footer.php';
    //Template folder
    $headerTempfolder = APPATH.'/views/template/header.php';
    $footerTempfolder = APPATH.'/views/template/footer.php';
    if(file_exists($headerfile) && file_exists($footerfile) && $allowcomponents == true){
    require_once $headerfile;
    if($swordini !== null){
    $swordini->render($name);
    }else{
    require_once $name;
    }
    require_once $footerfile;
    }
    elseif(file_exists($headerTempfolder) && file_exists($headerTempfolder) && $allowcomponents == true){
    //Files could be in the template folder in view folder as it's better that way
    require_once $headerTempfolder;
    if($swordini !== null){
    $swordini->render($name);
    }else{
    require_once $name;
    }
    require_once $footerTempfolder;
    }
    else{
      if($swordini !== null){
      $swordini->render($name);
      }else{
      require_once $name;
      }
    }
    }
  }


}
