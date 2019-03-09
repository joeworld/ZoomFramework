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
 *-------------------------------------------------------------------
 *AUTO-LOADER
 *-------------------------------------------------------------------
 *This file specifies which systems should be loaded by default.
 *
**/

/**
 * Classes to load
 */

$autoload['class'] = array('db');

/**
 * Helpers to load
 */

$autoload['helpers'] = array('html','date','string','form','date','email','session','cookie','validation','encrypt','url','fileupload','string','text','imglibs');
