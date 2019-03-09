<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class zoom_welcome extends controller
{
  function __construct()
  {
    parent::__construct();
    $this->swordview = ini_sword();
  }

  function index(){
  	$this->view->title = "Welcome to Zoom";
    $this->view->render('zoom_welcome');
  }

  function swordtest(){
    $this->swordview->assign('username', 'Joe');
    $this->swordview->assign('title', 'Welcome to Sword-Zoom');
    $this->swordview->render('swordtest');
  }

}