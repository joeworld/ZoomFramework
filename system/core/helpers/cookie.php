<?php

/**
 * Cookie manager.
 */

class cookie
{
    /**
     * Cookie name - the name of the cookie.
     * @var bool
     */
    private $name = false;

    /**
     * Cookie value
     * @var string
     */
    private $value = "";

    /**
     * Cookie life time
     * @var DateTime
     */
    private $time;

    /**
     * Cookie domain
     * @var bool
     */
    private $domain = false;

    /**
     * Cookie path
     * @var bool
     */
    private $path = false;

    /**
     * Cookie secure
     * @var bool
     */
    private $secure = false;

    /**
     * Constructor
     */
    public function __construct() { }

    /**
     * Create or Update cookie.
     */
    public function create() {
        return setcookie($this->name, $this->getValue(), $this->getTime(), $this->getPath(), $this->getDomain(), $this->getSecure(), true);
    }


    /**
     * Return a cookie
     * @return mixed
     */
    public function get($cookieName = null){
        if($cookieName == null){
        if(isset($_COOKIE[$this->getName()])){
        return $_COOKIE[$this->getName()];
        }
        }else{
        if(isset($_COOKIE[$cookieName])){
        return $_COOKIE[$cookieName];
        }
       }
        
    }

    /**
     * Delete cookie.
     * @return bool
     */
    public function delete($cookieName = null){
        if($cookieName == null){
        return setcookie($this->name, '', time() - 3600, $this->getPath(), $this->getDomain(), $this->getSecure(), true);
        }else{
        return setcookie($cookieName, '', time() - 3600, $this->getPath(), $this->getDomain(), $this->getSecure(), true);
        }
    }


    /**
     * @param $domain
     */
    public function setDomain($domain) {
        $this->domain = $domain;
    }

    /**
     * @return bool
     */
    public function getDomain() {
        return $this->domain;
    }

    /**
     * @param $id
     */
    public function setName($id) {
        $this->name = $id;
    }

    /**
     * @return bool
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param $path
     */
    public function setPath($path) {
        $this->path = $path;
    }

    /**
     * @return bool
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @param $secure
     */
    public function setSecure($secure) {
        $this->secure = $secure;
    }

    /**
     * @return bool
     */
    public function getSecure() {
        return $this->secure;
    }

    /**
     * @param $time
     */
    public function setTime($time = '+1 month') {
        // Create a date
        $date = new DateTime();
        // Modify it (+1hours; +1days; +20years; -2days etc)
        $date = $date->modify($time);
        // Store the date in UNIX timestamp.
        $this->time = $date->getTimestamp();
    }

    /**
     * @return bool|int
     */
    public function getTime() {
        return $this->time;
    }

    /**
     * @param string $value
     */
    public function setValue($value) {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue() {
        return $this->value;
    }
}

/**
 * Create a cookie with the name "myCookieName" and value "testing cookie value"
 */
//$cookie = new Cookie();
// Set cookie name
//$cookie->setName('Name');
// Set cookie value
//$cookie->setValue("testing cookie value");
// Set cookie expiration time
//$cookie->setTime("+2 minute");
// Create the cookie
//$cookie->create();
// Get the cookie value.
//print_r($cookie->get());
// Delete the cookie.
//$cookie->delete();