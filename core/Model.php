<?php
/**
 * Created by PhpStorm.
 * User: Malick
 * Date: 03/09/2015
 * Time: 22:35
 */

class Model {
    /**
     * @var array
     * Tableau recevant les connectioons à la base de données
     */
    static $connection=array();

    /**
     * @var string
     * Configuration sélectionnée
     */
    public $conf='default';

    /**
     * @var bool
     * Nom de la table
     */
    public $table=false;

    public $db;

    /**
     * Connexion à la base de donnée
     */
    public function __construct(){
        //Connexion à la base de données
       $conf=Conf::$databases[$this->conf];
        if(isset(Model::$connection[$this->conf])){
            $this->db=Model::$connection[$this->conf];
            return true;
        }
        try{
            $pdo=new PDO(
                'mysql:host='.$conf['host'].';dbname='.$conf['database'].';',
                $conf['login'],
                $conf['password'],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

            Model::$connection[$this->conf]=$pdo;
           $this->db=$pdo;
        }
        catch (PDOException $e){
            if(Conf::$debug >=1)
            {
                die($e->getMessage());
            }else{
                die("Connexion à la base de donnée impossible");
            }
        }

        //echo "Base de donnée chargée avec succès";

        if($this->table==false){
            $this->table=strtolower(get_class($this)).'s';
        }

    }

    /**
     * @param $req conditions de la requete
     * @return array Resultat de la requete
     * Requete de selection
     */
    public function find($req){
        $sql= 'SELECT * FROM '.$this->table.' as '.get_class ($this).'';

        //Construction de la condition

        if(isset($req['conditions'])) {
            $sql .= ' WHERE ';
            if (!is_array($req['conditions'])) {
                $sql .= $req['conditions'];
            } else {
                $cond=array();
                foreach ($req['conditions'] as $k => $v) {
                    if(!is_numeric($v)){
                        $v='"'.mysql_real_escape_string($v).'"';
                    }
                    $cond[]="$k=$v";
                }
                $sql.=implode(' AND ',$cond);
            }
        }



        die($sql);
        $pre=$this->db->prepare($sql);
        $pre->execute();
        return $pre->fetchAll(PDO::FETCH_OBJ);
//die($this->table);

    }

    /**
     * @param $req
     * @return mixed
     * Affiche le premier resultat de la requete de selection
     */
    public function findFirst($req){
        return current($this->find($req));
    }

    
} 