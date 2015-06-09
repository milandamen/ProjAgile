<?php
	namespace App\Http\Controllers\Auth;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Auth\LoginRequest;
	use App\Repositories\RepositoryInterfaces\IUserRepository;
	use Auth;
	use Carbon\Carbon;
	use Flash;
	use Illuminate\Contracts\Auth\Guard;
	use Redirect;
	use Session;

	class AuthController extends Controller
	{
		/**
		 * The Guard implementation.
		 *
		 * @var Guard
		 */
		private $auth;

		/**
		 * The UserRepository implementation.
		 * 
		 * @var IUserRepository
		 */
		private $userRepo;

		/**
		 * Create a new AuthController instance.
		 * 
		 * @param  Guard			$auth
		 * @param  IUserRepository	$userRepo
		 *
		 * @return void
		 */
		public function __construct(Guard $auth, IUserRepository $userRepo)
		{
			$this->auth = $auth;
			$this->userRepo = $userRepo;
		}

		/**
		 * Show the login page.
		 * 
		 * @return Response
		 */
		public function getLogin()
		{
			return view('auth.login');
		}

		/**
		 * Post the login and handle the input.
		 * 
		 * @param  LoginRequest $request
		 * 
		 * @return Response
		 */
		public function postLogin(LoginRequest $request)
		{
			if(!Auth::viaRemember())
			{
				$credentials = $request->only('username', 'password');

				// Set additional credentials requirements.
				$credentials['active'] = true;

				if(!$this->auth->attempt($credentials, $request['remember']))
				{
					// Set configurable security settings.
					$attemptsBeforeCaptcha = 1;
					$attemptsBeforeLockout = 5;

					// Set the configurable timeout and lockout settings (in minutes).
					$captchaTimeout = 1;
					$lockoutTimeout = 10;

					$user = $this->userRepo->getByUsername($credentials['username']);

					// Set attempt count and timestamp.
					$user->loginAttempts++;
					$user->lastLoginAttempt = Carbon::now();

					$enableReCaptcha = false;
					$messages = 
					[
						'username' => 'De ingevoerde gebruikersnaam met wachtwoord combinatie klopt helaas niet. Probeer het alstublieft opnieuw.'
					];

					if($user->loginAttempts >= $attemptsBeforeCaptcha)
					{
						if(Carbon::now()->diffInMinutes($user->lastLoginAttempt) < $captchaTimeout)
						{
							$enableReCaptcha = true;

							if($user->loginAttempts >= $attemptsBeforeLockout)
							{
								if(Carbon::now()->diffInMinutes($user->lastLoginAttempt) < $lockoutTimeout)
								{
									$messages['username'] = 'Wegens de hoeveelheid inlogpogingen hebben wij uw account geblokkeerd.
															Uw account zal over tien minuten gedeblokkeerd worden.';
								}
							}
						}
						else
						{
							$user->loginAttempts = 0;
						}
					}

					if($user->loginAttempts <= $attemptsBeforeLockout)
					{
						$this->userRepo->update($user);
					}
					Session::put('enableReCaptcha', $enableReCaptcha);

					return Redirect::route('auth.login')->withErrors
					([
						 $messages
					]);
				}
			}
			Flash::success('U bent succesvol ingelogd!');

			return Redirect::route('home.index');
		}

		/**
		 * This action will log out the user.
		 * 
		 * @return Response
		 */
		public function getLogout()
		{
			if(Auth::check())
			{
				$this->auth->logout();

				Flash::success('U bent succesvol uitgelogd!');
			}
			else
			{
				Flash::info('U bent nog niet ingelogd. Hierdoor kunt u niet uitloggen.');
			}
			
			return Redirect::route('home.index');
		}
	}