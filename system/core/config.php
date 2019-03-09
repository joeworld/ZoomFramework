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
 * Loader Config
 */

 /**
  * Class arrays to start, add more if required
  * Always Load ErrorHandler & Exceptions First
  */

 $SysConfig['loads_array'] = array('ErrorHandler','Exceptions','db_driver','database','bootstrap');

 /**
  * Require Files
  */

 /**
  * Array of files you would love to require in application config folder
 */

 $SysConfig['requireFiles'] = serialize(array('config.php','autoload.php','define.php','constants.php','user_agents.php'));
