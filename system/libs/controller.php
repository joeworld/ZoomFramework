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

class controller extends mvc
{

  public function __construct()
  {
    parent::__construct();
    if(class_exists('session')){
    session::init();
    }
    $this->view = new view();
  }

  public function LoadModel($model){
    
    $model = $model.'_model';
    if(class_exists($model)){
    $this->model = new $model();
    }

  }

}