<?php
/**
 * Created by PhpStorm.
 * User: Malick
 * Date: 01/09/2015
 * Time: 23:05
 */

class Request {

    public $url; //Url appelé par l'utilisateur

    function  __construct(){
        $this->url=$_SERVER['PATH_INFO'];
    }

} 