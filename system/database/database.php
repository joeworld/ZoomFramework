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

class database
{

  private $username = null, $password = null, $host = null, $db = null, $charset = null, $dsn = null, $driver = null, $showerrors = null, $encrypt = null;

  public $database;

  public $errors;

  public function DbConsent(){

    $this->db = db::DB_NAME;

    $this->username = db::DB_USER;

    $this->password = db::DB_PASSWORD;

    $this->host     = db::DB_HOST;

    $this->charset  = db::DB_CHARSET;

    $this->dsn  = db::DB_DSN;

    $this->port  = db::DB_PORT;

    $this->driver  = db::DB_DRIVER;

    $this->showerrors = db::SHOW_ERRORS;

    $this->encrypt = db::DB_ENCRYPT;

    if($this->db == "" || $this->username == "" || $this->host == ""){
    return false;
    }

    $arrayName = array(
    'db'   =>  $this->db,
    'user' => $this->username,
    'password' => $this->password,
    'host' => $this->host,
    'charset' => $this->charset,
    'dsn' => $this->dsn,
    'port' => $this->port,
    'errors'  => $this->showerrors,
    'encrypt'  => $this->encrypt
    );

    return $arrayName;

  }

}
