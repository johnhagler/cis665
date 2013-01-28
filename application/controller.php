<?php

class Controller {
	public $load;
	public $model;
	function __construct() {

		$this->load = new Load();
		$this->model = new Model();

		session_start();
		
		if(isset($_SESSION['user'])) {

	        $this->secured();

	    } else { 

		    $this->unsecured();

	    } 


	}

	function secured() {

		$this->home();

	}



	function unsecured() {

		$q = $_GET['q'];

		if ($q == 'findit') {
			$this->findit();
		
		} else if ($q == 'planit') {
			$this->planit();
		
		} else if ($q == 'climbit') {
			$this->climbit();
		
		} else if ($q == 'signup') {
			$this->signup();
		
		} else {
			$this->home();

		}

		
	}
	

	function home() {

		
		$data = $this->model->user_info();

		$this->load->view('splash.php', $data);

	}

	function findit() {

		$this->load->view('findit.php', $data);

	}

	function planit() {

		$this->load->view('planit.php', $data);

	}

	function climbit() {

		$this->load->view('climbit.php', $data);

	}

	function signup() {

		$this->load->view('signup.php', $data);

	}


}

?>