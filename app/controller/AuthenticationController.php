<?php
	class AuthorizeController extends Shared
	{
		private $userRepo;

		public function __construct()
		{
            // Start the session
            session_start();

            // Initialize the repositories
			$this->initRepository();

            // Check if the user is already logged in
            $this->loginCheck();
		}

        // Action: login
		public function login()
		{
            if (isset($_POST['username']) && !empty($_POST['username']) &&
                isset($_POST['password']) && !empty($_POST['password']))
            {
                $this->processLogin();
            }
            else
            {
                // Include the login page
                $this->header("Login");
                $this->menu();

                $this->view('authentication/login');

                $this->footer();
            }
		}

        // Action: logout
        public function logout()
        {
            session_destroy();

            header('');
            //Return to Home/Index
        }

        // Action: register
        public function register()
        {
            // TODO: Complete the registration process -- Thus far incomplete and should not be used
        }

        private  function loginCheck()
        {
            if (!isset($_SESSION['userId']) || empty($_SESSION['userId']) ||
                $_SESSION['timeout'] + (20 * 60) < time())
            {
                header('');
            }
            else
            {
                $_SESSION['timeout'] = time();
                session_write_close();
            }
        }

		private function processLogin($username = "", $password = "")
		{
			if (isset($username) && !empty($username) &&
				isset($password) && !empty($password))
			{
				if (preg_match("/^[a-zA-Z0-9]+$/", $username))
				{
                    $user = $this->userRepo->getByUsername($username);

					if (isset($user) && !empty($user))
					{
                        if ($user->getActive())
                        {
                            $salt = $user->getSalt();

                            require_once('auth/SecurityManager.php');
                            $securityManager = new SecurityManager();

                            if ($securityManager->validatePassword($password, $salt, $user->getPassword()))
                            {
                                // Save user specific variables in the session
                                $_SESSION['userId'] = $user->userId;
                                $_SESSION['username'] = $user->username;
                                $_SESSION['userGroupId'] = $user->userGroupId;
                                $_SESSION['userDistrictSectionId'] = $user->districtSectionId;

                                // Save the current time in the session to check timeout
                                $_SESSION['timeout'] = time();
                                session_write_close();
                            }
                            else
                            {
                                //Feedback: gebruiker is geblokkeerd.
                            }
                        }
					}
				}
			}
            //Feedback: Gebruikersnaam of wachtwoord is foutief ingevuld.
		}

        // TODO: Incomplete template for the registration process
//        private function processRegistration($username = "", $password = "")
//        {
//            if (isset($username) && !empty($username) &&
//                isset($password) && !empty($password))
//            {
//                if (preg_match("/^[a-zA-Z0-9]+$/", $username))
//                {
//                    $user = $this->userRepo->getByUsername($username);
//
//                    if (!isset($user) && empty($user))
//                    {
//                        include('PBKDF2/SecurityManager.php');
//                        $securityManager = new SecurityManager();
//
//                        $salt = $securityManager->generateSalt();
//
//                        if ($securityManager->createFirstTimeHash($password, $salt))
//                        {
//                            // Save user specific variables in the session
//                            $_SESSION['userId'] = $user->userId;
//                            $_SESSION['username'] = $user->username;
//                            $_SESSION['userGroupId'] = $user->userGroupId;
//                            $_SESSION['userDistrictSectionId'] = $user->districtSectionId;
//
//                            // Save the current time in the session to check timeout
//                            $_SESSION['timeout'] = time();
//                        }
//                        else
//                        {
//                            //Feedback: gebruiker is geblokkeerd.
//                        }
//                    }
//                    else
//                    {
//                        // Feedback: De ingevulde gebruikersnaam is al in gebruik
//                        // TODO: Beter dit via een on-page validator doen
//                    }
//                }
//                else
//                {
//                    //Feedback: Uw gebruikersnaam mag alleen uit de <valid characters> bestaan
//                }
//            }
//        }

		private function initRepository()
		{
            require_once('../repository/UserRepository.php');
			$this->userRepo = new UserRepository();
		}
	}
?>