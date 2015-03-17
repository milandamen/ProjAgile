<?php require_once 'AuthenticationController.php';

class AdminController extends Shared {

	public function __construct(){
		$this->setAuth(new AuthenticationController());

	}

	public function index(){
		
		if($this->getAuth()->loggedIn() && ($_SESSION['userGroupId'] == 1 || $_SESSION['userGroupId'] == 2)){
			$this->header('Beheer');
		    $this->menu();
			$this->view('admin/index',['loggedIn' => $this->getAuth()->loggedIn()]);
			$this->footer();
		} else {
			global $Base_URI;
			header('Location: ' . $Base_URI . 'Shared/noPermission');
		}

	}




}



?>

