<?php

require_once("class.Config.php");
require_once('Utils/fonctions.php');
require_once("models/class.SessionManager.php");
require_once("models/class.Role.php");
require_once("models/class.CB.php");

session_start();

class Model
{
    
    /**
     * Attribut contenant l'instance PDO
     */
    private PDO $bdd;

    /**
     * Attribut statique qui contiendra l'unique instance de Model
     */
    private static $instance = null;

    
    /**
     * Constructeur : effectue la connexion à la base de données.
     */
    private function __construct()
    {
        
        try {

            $dbConfig = Config::getInstance("database");

            $this->bdd = new PDO($dbConfig['dsn'].':host='.$dbConfig['host'].';port='.$dbConfig['port'].';dbname='.$dbConfig['name'], $dbConfig["user"], $dbConfig["pwd"]);
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->bdd->query("SET nameS 'utf8'");

        } catch (PDOException $e) {
            die('Echec connexion, erreur n°' . $e->getCode() . ':' . $e->getMessage());
        }

    }


    /**
     * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
     */
    public static function getDatabase()
    {

        if (is_null(self::$instance)) {
            self::$instance = new Model();
        }

        return self::$instance->bdd;

    }

}
