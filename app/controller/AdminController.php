<?php require_once 'AuthenticationController.php';

class AdminController extends Shared {

	public function __construct(){
		parent::__construct();

	}

	public function index(){
		
		$this->header('Beheer');
	    $this->menu();
		$this->view('admin/index',['logged' => $this->login()]);
		$this->footer();

	}




}



?>

