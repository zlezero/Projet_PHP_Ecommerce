<?php

require_once("Controller.php");
require_once("models/class.PanierManager.php");
require_once("models/class.CommandeManager.php");
require_once("models/class.Panier.php");

class Controller_commande extends Controller {

	public function action_default() {
		if (!$this->getSessionManager()->isAdmin()) {
			$this->action_consulter();
		} else {
			redirect("index.php");
		}
    }

	public function action_consulter() {

		if (!$this->getSessionManager()->isAdmin()) {

			$commandeManager=new CommandeManager();

			if(empty($_SESSION["idCommande"])){
				$_SESSION["idCommande"]= $commandeManager->addCommande()->getidCommande();
			}

			$commande=new Commande($_SESSION["idCommande"]);
	
			$this->render('consulter',[
				'commande' => $commande
			]);

		} else {
			redirect("index.php");
		}

	}

	public function action_valider(){
		$this->render('payement');
	}

	//TODO : ajouter les critères pour tourner sur l'utilisateur connecté TO DO
	public function action_liste(){

		if (!$this->getSessionManager()->isAdmin()) {

			$commandeManager=new CommandeManager();
			$commandes=$commandeManager->getAll();
			$this->render('liste',[
				'liste' => $commandes
			]);

		} else {
			redirect("index.php");
		}

	}

	public function action_getMontantTotal() {
		$commandeManager = new CommandeManager();
		$commande=new Commande($_SESSION["idCommande"]);
		echo json_encode($commande->getMontantTotalPanier());
	}

}