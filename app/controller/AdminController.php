<?php require_once 'AuthenticationController.php';

class AdminController extends Shared {

	public function __construct(){
		$this->setAuth(new AuthenticationController());

	}

	public function index(){
		
		if($this->getAuth()->loggedIn()){
			$this->header('Beheer');
		    $this->menu();
			$this->view('admin/index',['logged' => $this->getAuth()->loggedIn()]);
			$this->footer();
		} else {
			global $Base_URI;
			header('Location: ' . $Base_URI . 'Shared/noPermission');
		}

	}




}



?>

