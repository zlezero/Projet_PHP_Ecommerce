<?php

require_once("Controller.php");
require_once("models/class.PanierManager.php");
require_once("models/class.CommandeManager.php");
require_once("models/class.Panier.php");

class Controller_commande extends Controller {

	public function action_default() {
		$this->action_consulter();
    }

	public function action_consulter(){
		$commandeManager=new CommandeManager();
		if(empty($_SESSION["idCommande"])){
            $_SESSION["idCommande"]= $commandeManager->addCommande()->getidCommande();
        }
		$commande=new Commande($_SESSION["idCommande"]);

		$this->render('consulter',[
			'commande' => $commande
		]);
	}

	public function action_valider(){
		$commandeManager=new CommandeManager();
		if(empty($_SESSION["idCommande"])){
			return;
        }
		$commande=new Commande($_SESSION["idCommande"]);
		$commande->setStatutCommande(new StatutCommande(2));
		$this->render('payement');
	}

	//TODO : ajouter les critères pour tourner sur l'utilisateur connecté TO DO
public function action_liste(){
		$commandeManager=new CommandeManager();
		$commandes=$commandeManager->getAll();
		$this->render('liste',[
			'liste' => $commandes
		]);
	}
}