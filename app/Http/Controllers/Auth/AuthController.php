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
		 * Creates a new AuthController instance.
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
			$credentials = $request->only('username', 'password');

			// Set additional credentials requirements.
			$credentials['active'] = true;

			$user = $this->userRepo->getByUsername($credentials['username']);

			$messages = 
			[
				'username' => 'De ingevoerde gebruikersnaam met wachtwoord combinatie klopt helaas niet. Probeer het alstublieft opnieuw.'
			];

			if(isset($user))
			{
				// Set configurable security settings.
				$attemptsBeforeReCaptcha = 1;
				$attemptsBeforeLockout = 5;

				// Set the configurable timeout and lockout settings (in minutes).
				$captchaTimeout = 1;
				$lockoutTimeout = 10;

				// Set attempt count and timestamp.
				$user->loginAttempts++;
				$user->lastLoginAttempt = Carbon::now();

				if($user->loginAttempts >= $attemptsBeforeReCaptcha)
				{
					if(Carbon::now()->diffInMinutes($user->lastLoginAttempt) < $captchaTimeout)
					{
						if($user->loginAttempts >= $attemptsBeforeLockout)
						{
							if(Carbon::now()->diffInMinutes($user->lastLoginAttempt) < $lockoutTimeout)
							{
								$messages['username'] = 'Wegens de hoeveelheid inlogpogingen hebben wij uw account geblokkeerd.
														Uw account zal over tien minuten gedeblokkeerd worden.';

								return Redirect::route('auth.login')->withErrors
								([
									 $messages
								]);
							}
						}
						Session::put('enableReCaptcha', true);
					}
					else
					{
						$user->loginAttempts = 1;
						$user->lastLoginAttempt = Carbon::now();
					}
				}

				if(Auth::viaRemember() || $this->auth->attempt($credentials, $request['remember']))
				{
					if($user->loginAttempts !== 0)
					{
						$user->loginAttempts = 0;
						$user->lastLoginAttempt = null;
						$this->userRepo->update($user);
					}
					Session::forget('enableReCaptcha');
					Flash::success('U bent succesvol ingelogd!');

					return Redirect::route('home.index');
				}

				if(isset($user))
				{
					if($user->loginAttempts === 0)
					{
						// Set attempt count and timestamp.
						$user->loginAttempts++;
						$user->lastLoginAttempt = Carbon::now();
					}
					$this->userRepo->update($user);
				}
			}

			return Redirect::route('auth.login')->withErrors
			([
				 $messages
			]);
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