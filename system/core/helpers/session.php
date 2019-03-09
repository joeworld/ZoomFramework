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
* SESSION HELPER
*
**/

 class session
 {

   public static function init(){
     @session_start();
   }

   public function set($key, $value){
     $_SESSION[$key] = $value;
   }

   public function get($key){
     if(isset($_SESSION[$key])){
     return $_SESSION[$key];
     }

     return false;

   }

   public function destroy(){
     session_destroy();
   }

 }
