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

/**
 * Bootstrap Class
 */

class bootstrap
{

  private $_url = NULL;

  private $_newexceptions = NULL;

  private $_controller = NULL;

  private $_defaultcontroller = DEFAULTCONTROLLER;

  private $_anycontroller = ANYCONTROLLER;

  private $_err = "There is no index function for this controller";

  function __construct()
  {
      /*
      *Declare public errors
      */

    $this->_newexceptions = new Exceptions;

     $this->_getUrl();

      if (empty($this->_url[0])) {
       $this->_loadDefaultController();
       return false;
      }

      $this->_loadExistingController();

      $this->_callControllerMethod();


  }

    private function _getUrl(){
       $url = isset($_GET['url']) ? $_GET['url'] : null;

         if ($url != '') {
             $parts = explode('&', $url, 2);

             if (strpos($parts[0], '=') === false) {
                 $url = $parts[0];
             } else {
                 $url = '';
             }
         }

         $url = rtrim($url, '/\\');
         $this->_url = explode('/',$url);
    }



   private function _loadDefaultController(){
     if(class_exists($this->_defaultcontroller)){
       $this->_controller = new $this->_defaultcontroller();
        if (method_exists($this->_controller, 'index')) {
        $this->_controller->index();
        }else{
        die($this->_err);
        }
      }else{
        //Load Zoom custom page
        $controller = new zoom_welcome();
        $controller->index();
        if (method_exists($controller, 'index')) {
        $controller->index();
        }else{
        die($this->_err);
        }
     }
     return false;
   }



   private function _loadExistingController(){
     $file = APPATH.'/controllers/' . $this->_url[0] . '.php';
     if(! file_exists($file)) {
      if(! empty($this->_anycontroller)){
      $file = APPATH.'/controllers/' . $this->_anycontroller . '.php';
      if(! file_exists($file)){
      die('Unknown controller for (<b>ANY</b>) slug, please correct in your application config file');
      }else{
      require_once $file;
      $this->_controller = new $this->_anycontroller;
      $this->_controller->LoadModel($this->_anycontroller);
      }
      }else{
       $this->_newexceptions->show404();
       die();
      }
     }else{
        require_once $file;
        $this->_controller = new $this->_url[0];
        $this->_controller->LoadModel($this->_url[0]);
        return false;
     }
   }



   private function _callControllerMethod(){


    // http://localhost/controller/method/(param)/(param)/(param)
    // url[0] = controller
    // url[1] = Method
    // url[2] = Param
    // url[3] = Param
    // url[4] = Param


    $length = count($this->_url);

    if($length > 1){
    if(!method_exists($this->_controller, $this->_url[1])) {
        $this->_newexceptions->show404();
        return false;
     }
   }

    switch ($length) {
      case 5:
         # code... controller->method(param1, param2, param3)
         $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
         break;
      case 4:
          # code...
          $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
          break;
      case 3:
          # code...
          $this->_controller->{$this->_url[1]}($this->_url[2]);
          break;
      case 2:
          # code...
          $this->_controller->{$this->_url[1]}();
          break;
      default:
          # code...
          if(! empty($this->_anycontroller)){
          if (method_exists($this->_controller, 'index')) {
          $this->_controller->index($this->_url[0]);
          }else{
          die($this->_err);
          }
          }else{
          if (method_exists($this->_controller, 'index')) {
          $this->_controller->index();
          }else{
          die($this->_err);
          }
          }
          break;
    }
  }

}
