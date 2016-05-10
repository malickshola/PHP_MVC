<?php
/**
 * Created by PhpStorm.
 * User: Malick
 * Date: 02/09/2015
 * Time: 00:57
 */

class PagesController extends Controller {

    function view($id){
        //$this->render("index");
        $this->loadModel("client");
        $client=$this->client->findFirst(array(
            'conditions'=> array('id'=> $id)
        ));
        if(empty($client)){
            $this->e404('Page introuvable');
        }else{
        $this->set('client',$client);
        }
    }

    function article(){
        //$this->render("index");
        $this->loadModel("client");
        $client=$this->client->find(array());
        if(empty($client)){
            $this->e404('Page introuvable');
        }else{
            $this->set('client',$client);
        }
    }

} 