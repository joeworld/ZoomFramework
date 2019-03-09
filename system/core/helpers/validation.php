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
* VALIDATION CLASS
*
**/

class validation
{

   /**
    * Form Id
    */

  	private $formID = null;

    /**
     * Form Id Name, this part should be set as hidden in form
     */

  	private $formIDName = null;

    /**
     * Form Post method
     */

  	private $POST = null;

    /**
     * Set as an array of errors in form
     */

  	private $error = array();



  	public function __construct($formID = null, $POST = false, $formIDName="formID")
  	{

      /**
       * Public function construct
       */

  		$this->formID = $formID;
  		$this->POST = $POST ? $POST : $_POST;
  		$this->formIDName = $formIDName;
  		return $this;

  	}



  	public function value($name, $sanitize=true){

      /**
       * Get the value
       */

  		if(isset($this->POST[$name])){
  			return $sanitize ? htmlspecialchars($this->POST[$name], ENT_QUOTES, "UTF-8") : $this->POST[$name];
  		}
  		return "";
  	}



  	public function submitted(){

      /**
       * Get the submitted values
       */

  		if(!empty($this->POST) && $this->value($this->formIDName, false)===$this->formID){
  			return true;
  		}
      
  		return false;
  	}



  	public function validate($nameArr=array()){

      /**
       * Validate
       */

  		if(!$this->submitted()) return $this;
  		foreach ($nameArr as $name=>$validationFunction) {
  		   $error = call_user_func_array($validationFunction, array($this->value($name, false), $this));
  		   if(is_string($error)){
  		   	$this->errors[$name] = $error;
  		   }
  		}
  		return true;
  	}



      public function error($name){

        /**
         * Set error
         */

      	print isset($this->errors[$name]) ? $this->errors[$name] : "";
        return true;
      }



      public function addError(){

        /**
         * Check if error was set
         */

      	if(!isset($this->errors[$name])){
      		$this->errors[$name] = $errors;
      	}
      	return $this;
      }



      public function errorInForm(){

        /**
         * Check all error in form to determine if to trigger success or not
         */

      	return empty($this->errors) ? false : true;
      }



      public function success(){

        /**
         * Trigger success
         */

      	return $this->submitted() && !$this->errorInForm();
      }


}


/**
 * Start class Automatically
 */

//$validation = new validation();
