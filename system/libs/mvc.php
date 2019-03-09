<?php

/**
* Zoom
*
* An open source application development framework for PHP
*
* This content is released under the Zora License
*
* Copyright (c) 2017, Zoom Inc, Zoracomunnictions Nigeria.
*
**/

defined('BASEPATH') OR exit('No direct script access allowed');

/**
*
* DO NOT EDIT THIS PAGE WITHOUT VITAL KNOWLEDGE
*
**/

class mvc extends database
{
   public $html;

   public $validate;

   public $cookie;

   public $email_layout;

   public $img;

   public $reflectors;

   public $useragents;

   public $encrypt;

   public $session;

   public $rest;

   public $e_conn;

   public function __construct(){
     if(class_exists('html')){
       $this->html = new html();
     }
     if (class_exists('validation')){
       $this->validate = new validation();
     }
     if (class_exists('cookie')) {
       $this->cookie = new cookie();
     }
     if (class_exists('Email_Layout')) {
       $this->email_layout = new Email_Layout();
     }
     if (class_exists('imglibs')) {
       $this->img = new imglibs();
     }
     if(class_exists('imgreflection')){
       $this->reflectors = new imgreflection();
     }
     if (class_exists('useragents')){
      $this->useragent = new useragents();
     }
     if (class_exists('encrypt')){
      $this->encrypt = new encrypt();
     }
     if (class_exists('session')){
      $this->session = new session();
     }
     if (class_exists('restapi')){
      $this->rest = new restapi();
     }

     $this->e_conn = parent::DbConsent();

   }
 }
