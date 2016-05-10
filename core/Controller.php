<?php
/**
 * Created by PhpStorm.
 * User: Malick
 * Date: 01/09/2015
 * Time: 23:20
 */

class Controller {
    public $request;
    /**
     * @var array Variable a passer a la vue
     */
    private $vars=array();
    /**
     * @var string
     * Template du site
     */
    public $template ='default';
    /**
     * @var Permet de vérifier si la vue a déjà été rendue ou pas
     */
    private $rendered=false;

    function __construct($request){
        $this->request=$request;
    }

    /**
     * @param $view url de la vue à rendre
     * Fonction d'affichage de la vue demandée
     */
    public function render($view){
        if($this->rendered){return false; }
        extract($this->vars);
        if(strpos($view,'/')===0){
            $view=ROOT.DS.'view'.$view.'.php';
        }
        else{
        $view=ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
            //die($view);
        }
            ob_start();
        require($view);
        $layout_content=ob_get_clean();
        require ROOT.DS.'view'.DS.'layout'.DS.$this->template.'.php';
        $this->rendered=true;
        //die($view);

    }

    public function set($key,$value=null){
        if(is_array($key)){
            $this->vars += $key;

        }
        else
        {
        $this->vars[$key] = $value;
        }
    }

    /**
     * Permet de charger un modèle
     * @param $name nom du modèle
     */

    function loadModel($name){

        $file=ROOT.DS.'model'.DS.$name.'.php';
        require_once($file);
        if(!isset($this->$name)){
            $this->$name=new $name();
        }
    }

    /**
     * @param $message
     * Ramène une vue correspondant à l'érreur 404
     */
    function e404 ($message){
        $this->set('message',$message);
        header("HTTP/1.0 404 Not Found");
        $this->render('/errors/404');
        die();
    }
}