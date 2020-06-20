<?php
require_once('Model.php');

class ConfigArticles{

    private string $defaultOrder;

    private $bdd;

    public function __construct()
    {
        $this->bdd = Model::getDatabase();

        try{
            $req = $this->bdd->prepare('SELECT defaultOrder FROM config');
            $req->execute();
            $data = $req->fetch();
            if($data !== false){
                $this->defaultOrder = $data['defaultOrder'];
            } else{
                $this->addDefaultOrder(Config::getInstance('defaultOrder'));
                $this->defaultOrder = Config::getInstance('defaultOrder');
            }
        }catch(Exception $e){
            throw new Exception($e);
        }
    }

    public function getDefaultOrder(){
        return $this->defaultOrder;
    }

    public function setDefaultOrder(string $defaultOrd){
        $this->defaultOrder = $defaultOrd;
    }

    private function addDefaultOrder(string $defaultOrd){

        $req = $this->bdd->prepare('INSERT INTO config (defaultOrder) VALUES(:defaultValue)');
        $req->bindValue(':defaultValue',$defaultOrd);
        $req->execute();
    }

    public function updateDefaultOrder(string $defaultOrd){
        $req = $this->bdd->prepare('UPDATE config SET defaultOrder = :valueOrder');
        $req->bindValue(':valueOrder',$defaultOrd);
        $req->execute();
    }
}
?>