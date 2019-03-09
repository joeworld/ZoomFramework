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
* IMAGE REFLECTORS
*
**/

class imgreflection
{


  private $path_to_source          = null;    // The full input image path
  private $path_to_target          = null;    // Path to the output image dir
  private $path_to_temp            = '/tmp/'; // The temporary image path
  private $image_name              = null;    // The image name
  private $target_image_prefix     = null;    // The image name
  private $image_source            = null;    // The input image source
  private $reflection_source       = null;    // The image reflection source
  private $path_info               = array(); // Path information
  private $image_info              = array(); // Image information
  private $reflection_height       = 50;      // Reflection height
  private $reflection_transparency = 30;      // Reflection transparency
  private $divider                 = 1;       // Size of the divider line
  private $width                   = 0;       // Image width
  private $height                  = 0;       // Image height
  private $type                    = null;    // The image type
  private $mime                    = null;    // Image mime/type
  private $curl_timeout            = 5;       // curl timeout

  /*
   * Class Constructor
   */
  function __construct($path_to_source = false,$load = false)
  {
     if($path_to_source) {
        $this->setSourceImagePath($path_to_source);
     }
     if($load){
        $this->createReflection();
     }
  }


  /*
   *
   */
  function loadImage($path_to_source = false)
  {
     if($path_to_source) {
        $this->setSourceImagePath($path_to_source);
        $this->getImageInfo();
     }
     elseif($this->path_to_source) {
        $this->getImageInfo();
     }
  }

  /*
   *
   */
  function loadImageSource()
  {
     switch ($this->type)
     {
        case 1:
           //	GIF
           $this->image_source = imagecreatefromgif($this->path_to_source);
           break;

        case 2:
           //	JPG
           $this->image_source = imagecreatefromjpeg($this->path_to_source);
           break;

        case 3:
           //	PNG
           $this->image_source = imagecreatefrompng($this->path_to_source);
           break;

        default:
           echo 'Unsupported image file format.';
           exit();
     }

  }

  /*
   *
   */
  function createReflection()
  {
     if($this->path_to_source){
        $this->reflection_source = imagecreatefromjpeg($this->path_to_source);
        $reflection_image = imagecreatetruecolor($this->width, 1);
        $background_color = imagecolorallocate($reflection_image, 255, 255, 255);
        imagefilledrectangle($reflection_image, 0, 0, $this->width, 1, $background_color);
        $background = imagecreatetruecolor($this->width, $this->reflection_height);
        $color_allocate = imagecolorallocate($this->reflection_source,255,255,255);
        $this->image_source = imagerotate($this->reflection_source, -180, $color_allocate);
        imagecopyresampled($background, $this->reflection_source, 0, 0, 0, 0, $this->width, $this->height, $this->width, $this->height);
        $this->reflection_source = $background;
        $background = imagecreatetruecolor($this->width, $this->reflection_height);
        for ($x = 0; $x < $this->width; $x++) {
           imagecopy($background, $this->reflection_source, $x, 0, $this->width-$x, 0, 1, $this->reflection_height);
        }
        $this->reflection_source = $background;
        $in = 100/$this->reflection_height;
        for($i=0; $i<=$this->reflection_height; $i++){
           if($this->reflection_transparency>100) $this->reflection_transparency = 100;
           imagecopymerge($this->reflection_source, $reflection_image, 0, $i, 0, 0, $this->width, 1, $this->reflection_transparency);
           $this->reflection_transparency+=$in;
        }
        imagecopymerge($this->reflection_source, $reflection_image, 0, 0, 0, 0, $this->width, $this->divider, 100);  // Divider
        imagedestroy($reflection_image);
     }
  }


  /*
   *
   */
  function createImageWithReflection()
  {
     if($this->path_to_source){
        $this->image_source = imagecreatefromjpeg($this->path_to_source);
        $new_height = $this->reflection_height + $this->height;

        //	We'll store the final reflection in $output. $buffer is for internal use.
        $output = imagecreatetruecolor($this->width, $new_height);
        $buffer = imagecreatetruecolor($this->width, $new_height);

        //	Copy the bottom-most part of the source image into the output
        imagecopy($output, $this->image_source, 0, 0, 0, $this->height - $new_height, $this->width, $new_height);

        //	Rotate and flip it (strip flip method)
        for ($y = 0; $y < $new_height; $y++)
        {
           imagecopy($buffer, $output, 0, $y, 0, $new_height - $y - 1, $this->width, 1);
        }

        $this->image_source = $buffer;
     }
  }

  /*
   *
   */
  function saveImage($path_to_target = false)
  {
     if(!$path_to_target && !$this->path_to_target) {
        return;
     }
     elseif($path_to_target) {
        $this->setTargetImagePath($path_to_target);
     }
     if($this->image_source) {
        imagejpeg($this->image_source, $this->path_to_target, 100);
     }
     else {
        return;
     }
  }

  /*
   *
   */
  function saveImageToTemp($path_to_temp = false)
  {
     if(!$path_to_temp && !$this->path_to_temp) {
        return;
     }
     else {
        if($path_to_temp) { $this->setTempImagePath($path_to_temp); }

     }
  }

  /*
   *
   */
  function downloadImage($path_to_source = false,$path_to_target = false)
  {
     if(!$path_to_source && !$this->path_to_source) {
        return false;
     }
     else {
        if($path_to_source) { $this->setSourceImagePath($path_to_source); }
        if($path_to_target) { $this->setTargetImagePath($path_to_target); }

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_FAILONERROR, 1);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch,CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$this->curl_timeout);
        $this->image_source = curl_exec($ch);
        $this->setTargetImagePath($path_to_target);
        $this->saveImageToTemp();
        curl_close($ch);
        return true;
     }
  }

  /*
   *
   */
  function saveReflection($path_to_target = false)
  {
     if(!$path_to_target && !$this->path_to_target) {
        return;
     }
     elseif($path_to_target) {
        $this->setTargetImagePath($path_to_target);
     }
     if($this->image_source) {
        imagejpeg($this->reflection_source, $this->path_to_target, 100);
     }
     else {
        return;
     }
  }

  /*
   *
   */
  function showImage()
  {
     header('content-type: image/jpeg');
     imagejpeg($this->image_source, '', 100);
     imagedestroy($this->image_source);
  }

  /*
   *
   */
  function setSourceImagePath($path_to_source)
  {
     $path_parts = pathinfo($path_to_source);
     $this->path_to_source = $path_to_source;
  }

  /*
   *
   */
  function setTargetImagePath($path_to_target)
  {
     $this->path_to_target = $path_to_target;
  }

  /*
   *
   */
  function setTempImagePath($path_to_temp)
  {
     $this->path_to_temp = $path_to_temp;
  }

  /*
   *
   */
  function setReflectionHeight($reflection_height)
  {
     $this->reflection_height = $reflection_height;
  }

  /*
   *
   */
  function setReflectionTransparency($reflection_transparency)
  {
     $this->reflection_transparency = $reflection_transparency;
  }

  /*
   *
   */
  function getImageInfo()
  {
     $this->info   = getimagesize($this->path_to_source);
     $this->width  = $this->info[0];
     $this->height = $this->info[1];
     $this->type   = $this->info[2];
     $this->mime   = $this->info['mime'];
  }

  /*
   *
   */
  function getImageHeight()
  {
     return $this->height;
  }

  /*
   *
   */
  function getImageWidth()
  {
     return $this->width;
  }

  function __destruct()
  {

  }


}
