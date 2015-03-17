<?php
	class AuthenticationController extends Shared
	{
		private $userRepo;

		public function __construct()
		{
            if (session_status() == PHP_SESSION_NONE)
            {
                // Start the session
                session_start();
            }

            // Initialize the repositories
			$this->initRepository();
		}

        public function index()
        {
            if ($this->loggedIn())
            {
                $this->redirectTo();
            }
            else
            {
                $this->redirectTo('AuthenticationController/login');
            }
        }

        // Action: login
		public function login()
		{
            if (!$this->loggedIn())
            {
                if (isset($_POST['username']) && !empty($_POST['username']) &&
                    isset($_POST['password']) && !empty($_POST['password']))
                {
                    $this->processLogin($_POST['username'], $_POST['password']);
                }
                else
                {
                    $this->setAuth($this);
                    // Include the login page
                    $this->header("Login");
                    $this->menu();
                    $this->view('authentication/login');
                    $this->footer();
                }
            }
            else
            {
                $this->redirectTo();
            }
		}

        // Action: logout
        public function logout()
        {
            // Close the session
            session_destroy();

            // Redirect to home
            $this->redirectTo();
        }

        public function loggedIn()
        {
            if (!isset($_SESSION['userId']) || empty($_SESSION['userId']) ||
                !isset($_SESSION['timeout']) || $_SESSION['timeout'] + (20 * 60) < time())
            {
                return false;
            }
            else
            {
                return true;
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

                            if ($securityManager->validatePassword($password, $salt, $user->getPassword()))
                            {
                                // Save user specific variables in the session
                                $_SESSION['userId'] = $user->getUserId();
                                $_SESSION['username'] = $user->getUsername();
                                $_SESSION['userGroupId'] = $user->getUserGroupId();
                                $_SESSION['userDistrictSectionId'] = $user->getDistrictSectionId();

                                // Save the current time in the session to check timeout
                                $_SESSION['timeout'] = time();
                                session_write_close();

                                $this->redirectTo();
                            }
                        }
                        else
                        {
                            // Feedback: Gebruiker is geblokkeerd
                        }
					}
				}
			}
            // Feedback: Gebruikersnaam of wachtwoord is foutief ingevuld.
			$this->redirectTo('AuthenticationController/login');
		}

        private function redirectTo($extra = "")
        {
            $host  = $_SERVER['HTTP_HOST'];
            $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("Location: http://$host$uri/$extra");

            exit;
        }

		private function initRepository()
		{
            require_once($_SERVER['DOCUMENT_ROOT'] . '/ProjAgile/app/repository/userRepository.php');
			$this->userRepo = new UserRepository();
		}
	}