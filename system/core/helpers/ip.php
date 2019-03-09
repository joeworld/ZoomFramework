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
* IP FUNCTIONS, This part uses the ip-api.com/php/ Api
*
**/

if( ! function_exists('getLocale')){
  function getLocale($ip = null){

    $getLocale = array();
    if($ip == null){
      $getLocale = unserialize(file_get_contents("http://ip-api.com/php/"));
    }else{
      $getLocale = unserialize(file_get_contents("http://ip-api.com/php/".$ip));
    }

    return $getLocale;

  }
}