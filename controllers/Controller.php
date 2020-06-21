<?php

require_once("models/class.SessionManager.php");

abstract class Controller
{


    /**
     * Action par défaut du contrôleur (à définir dans les classes filles)
     */
    abstract public function action_default();

    /**
     * Constructeur. Lance l'action correspondante
     */
    public function __construct()
    {

        if (!isset($_SESSION["sessionManager"])) {
            $_SESSION["sessionManager"] = new SessionManager();
        }

        //On détermine s'il existe dans l'url un paramètre action correspondant à une action du contrôleur
        if (isset($_GET['action']) and method_exists($this, "action_" . $_GET["action"])) {
            //Si c'est le cas, on appelle cette action
            $action = "action_" . htmlspecialchars($_GET["action"]);
            $this->$action();
        } else {
            $this->action_default(); //Sinon, on appelle l'action par défaut
        }
    }


    /**
     * Affiche la vue
     * @param  string $vue nom de la vue
     * @param array $data tableau contenant les données à passer à la vue
     * @return void
     */
    protected function render($vue, $data = [])
    {

        //On extrait les données à afficher
        extract($data);

        require_once('views/include/view_header.php');

        //On teste si la vue existe
        $file_name = "views/view_" . $vue . '.php';

        if (file_exists($file_name)) {
            //Si oui, on l'affiche
            include($file_name);
        } else {
            //Sinon, on affiche la page d'->action_error
            $this->action_error("La vue n'existe pas !");
        }

        require_once('views/include/view_footer.php');
        
        if (isset($_SESSION['erreur']))
            unset($_SESSION['erreur']);

        if (isset($_SESSION['succes']))
            unset($_SESSION['succes']);

        die(); // Pour terminer le script
    }


    /**
     * Méthode affichant une page d'erreur
     * @param  string $message Message d'erreur à afficher
     * @return aucun
     */
    protected function action_error($message = '')
    {
        $data = [
            'title' => "Error",
            'message' => $message
        ];
        $this->render("message", $data);
    }

    protected function getSessionManager() : SessionManager {
        
        if (isset($_SESSION['sessionManager'])) {
            return $_SESSION['sessionManager'];
        } else {
            return null;
        }

    }

}
