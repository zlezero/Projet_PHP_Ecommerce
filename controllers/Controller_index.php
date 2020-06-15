<?php

require_once("Controller.php");

class Controller_index extends Controller {

	public function action_default() {
		$this->action_index();
	}

	public function action_index() {

		$user ='toto';
		$age = 12;

		$this->render('index',[
			//'infosUser' => $info,
			'user' => $user,
			'ageUser' => $age
		]);

	}
}