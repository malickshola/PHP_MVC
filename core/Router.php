<?php
/**
 * Created by PhpStorm.
 * User: Malick
 * Date: 01/09/2015
 * Time: 23:07
 */

class Router {
    /**
     * permet de passer une url
     * @param $url Url à parse
     * @return tableau contenant les paramètres
     */
    static function parse($url,$request)
    {
        $url=trim($url,'/');
        $params=explode('/',$url);
        $request->controller=$params[0];
        $request->action=isset($params[1]) ? $params[1]:'index';

        $request->params=array_slice($params,2);
       // return  true;

    }

} 