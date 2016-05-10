<?php
/**
 * Created by PhpStorm.
 * User: Malick
 * Date: 03/09/2015
 * Time: 23:03
 */
class Conf{
    static $debug=1;

   static $databases = array(
        'default' => array(
        'host' => 'localhost',
        'database' => 'test_mvc',
        'login' => 'root',
        'password' => ''
        )
    );
}