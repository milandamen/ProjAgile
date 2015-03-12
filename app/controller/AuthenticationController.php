<?php
	class AuthenticationController extends Shared
	{
		private $userRepo;

		public function __construct()
		{
            // Start the session
            session_start();

            // Initialize the repositories
			$this->initRepository();
		}

        public function index()
        {
            $this->loginCheck();
        }

        // Action: login
		public function login()
		{
            if (isset($_POST['username']) && !empty($_POST['username']) &&
                isset($_POST['password']) && !empty($_POST['password']))
            {
                $this->processLogin($_POST['username'], $_POST['password']);
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

            $this->redirectTo();
            //Return to Home/Index
        }

        // Action: register
        public function register()
        {
            // TODO: Complete the registration process -- Thus far incomplete and should not be used
        }

        private function loginCheck()
        {
            if (!isset($_SESSION['userId']) || empty($_SESSION['userId']) ||
                $_SESSION['timeout'] + (20 * 60) < time())
            {
                $this->redirectTo("AuthenticationController/login");
            }
            else
            {
                $_SESSION['timeout'] = time();
                session_write_close();
            }
        }

		private function processLogin($username, $password)
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

                            // ######TEST##########
//                            $userTest = new User
//                            (
//                                $user->getUserId(),
//                                $user->getUserGroupId(),
//                                $user->getDistrictSectionId(),
//                                $user->getUsername(),
//                                $securityManager->createFirstTimeHash($password, $salt),
//                                $user->getSalt(),
//                                $user->getFirstName(),
//                                $user->getSurname(),
//                                $user->getPostal(),
//                                $user->getHouseNumber(),
//                                $user->getEmail(),
//                                $user->getActive()
//                            );
//                            $this->userRepo->update($userTest);
//
//                            return;
                            if ($securityManager->validatePassword($password, $salt, $user->getPassword()))
                            {
                                echo "test 12123131313";
                                // Save user specific variables in the session
                                $_SESSION['userId'] = $user->userId;
                                $_SESSION['username'] = $user->username;
                                $_SESSION['userGroupId'] = $user->userGroupId;
                                $_SESSION['userDistrictSectionId'] = $user->districtSectionId;

                                // Save the current time in the session to check timeout
                                $_SESSION['timeout'] = time();
                                session_write_close();
                                $this->redirectTo();
                            }
                            else
                            {
                                echo "test zfggzasfgdagdasgdasgadegaseg";
                            }
                        }
                        else
                        {
                            echo "wow blocked";
                            //Feedback: gebruiker is geblokkeerd.
                        }
					}
                    else
                    {
                        echo "wow";
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

        // TODO: moet nog even bespreken waar we dit soort settings laten (config file maybe?). Is op zich ook handig voor andere redirection dingen
        private function redirectTo($extra = "")
        {
            $host  = $_SERVER['HTTP_HOST'];
            $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("Location: http://$host$uri/$extra");
            exit;
        }

		private function initRepository()
		{
            // TODO: Dit moet nog worden aangepast. Tijdelijke workaround wegns dat een relative pad niet werkt(e)
            require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjAgile/app/repository/UserRepository.php');
			$this->userRepo = new UserRepository();
		}
	}
?>