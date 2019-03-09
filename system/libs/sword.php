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
* Sword allows you to use its syntax in files with the .sword
*
**/

class sword extends mvc
{

  private $vars = array();

  public function assign($key, $value){
    $this->vars[$key] = $value;
  }

  public function _eval($file){
      $contents = file_get_contents($file);

      foreach($this->vars as $key => $value){
      $contents = preg_replace('/\[' . $key . ']/', $value, $contents);
      }

      $contents = preg_replace('/\# (.*) \#/', '<?php //($1) ?>', $contents);

      $contents = preg_replace("/\% if (.*) \%/", "<?php if ($1) : ?>", $contents);
      $contents = preg_replace('/\% else \%/', '<?php else : ?>', $contents);
      $contents = preg_replace('/\% endif \%/', '<?php endif; ?>', $contents );

      eval(' ?>' . $contents . '<?php ');

  }



  public function render($_name, $isInclude = false, $allowcomponents = true, $override = false){
    $name = APPATH.'/views/' . $_name . '.sword.php';
    if(file_exists($name)){
      $name = $name;
    }else{
    $name = APPATH.'/views/' . $_name . '.sword';
    if(file_exists($name)){
    $name = APPATH.'/views/' . $_name . '.sword';
    }else{
    die($_name." is not a sword file, sword files end .sword or .sword.php");
    }
    }


    if ($isInclude == true) {
      if(is_array($isInclude)){
     if(array_key_exists('header', $isInclude) && array_key_exists('footer', $isInclude)){
    $header = $isInclude['header'];
      $footer = $isInclude['footer'];
            $hd = APPATH.'/views/' . $header;
            $this->_eval($hd);
            $this->_eval($name);
            $ft = APPATH.'/views/' . $footer;
            $this->_eval($ft);
          }else{
            $this->_eval($name);
          }
        }else{
          die($isInclude." should be an array having a footer and a header key(footer & header files)");
        }
        }
        else{
        $headerfile = APPATH.'/views/header.php';
        $footerfile = APPATH.'/views/footer.php';
        //Template folder
        $headerTempfolder = APPATH.'/views/template/header.php';
        $footerTempfolder = APPATH.'/views/template/footer.php';
        if(file_exists($headerfile) && file_exists($footerfile) && $allowcomponents == true){
        $this->_eval($headerfile);
        $this->_eval($name);
        $this->_eval($footerfile);
        }
        elseif(file_exists($headerTempfolder) && file_exists($headerTempfolder) && $allowcomponents == true){
        //Files could be in the template folder in view folder as it's better that way
        $this->_eval($headerTempfolder);
        $this->_eval($name);
        $this->_eval($footerTempfolder);
        }
        else{
        $this->_eval($name);
        }
        }

  }

}
