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
 * ----------------------------------------------------------------
 * DATABASE CONNECTION SETTINGS
 * -----------------------------------------------------------------
 */

class db
{

   /**
     * Database host
     * @var string
     */

    const DB_HOST = 'localhost';

    /**
     * Database name
     * @var string
     */

    const DB_NAME = '';

    /**
     * Database user
     * @var string
     */

    const DB_USER = 'root';

    /**
     * Database password
     * @var string
     */

    const DB_PASSWORD = '';

    /**
     * Database Driver
     * Currently surpported (pdo, mysqli, mysql, sqlite, pdo is zoom default)
     * @var string
     */

    const DB_DRIVER = 'pdo';

     /**
     * Database Charset
     * Your database charset
     * @var string
     */

    const DB_CHARSET = 'utf8';

    /**
    * Database DSN
    * Your database DSN
    * Leave empty if you want a zoom customize dsn
    * @var string
    */

    const DB_DSN = '';

    /**
    * Port
    */

    const DB_PORT = '';

    /**
    * DATABASE CONNECTION PERSISTENTCY ----- Set true if application is containerized
    */

    const PESISTENT = FALSE;

    /**
     * Show or hide error messages on screen
     * @var boolean
     */

    const SHOW_ERRORS = true;

    /**
     * Encrypt database, not mostly required
     * @var boolean
     */

    const DB_ENCRYPT = FALSE;
}
