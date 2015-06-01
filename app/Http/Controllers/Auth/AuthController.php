<?php
	namespace App\Http\Controllers\Auth;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Auth\LoginRequest;
	use App\Http\Requests\Auth\RegisterRequest;
	use App\Repositories\RepositoryInterfaces\IUserRepository;
	use Auth;
	use Flash;
	use Illuminate\Contracts\Auth\Guard;
	use Redirect;

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

		public function __construct(Guard $auth, IUserRepository $userRepo)
		{
			$this->auth = $auth;
			$this->userRepo = $userRepo;

			$this->middleware('guest', 
			[
				'except' => 'getLogout'
			]);
		}

		/**
		 * Show the registration page.
		 * 
		 * @return Response
		 */
		public function getRegister()
		{
			return view('auth.register');
		}

		/**
		 * Post the registration and handle the input.
		 * This will also send an e-mail to both the registered user and the management.
		 * 
		 * @param  RegisterRequest $request
		 * 
		 * @return Response
		 */
		public function postRegister(RegisterRequest $request)
		{
			$data = $request->all();
			$data = array_add($data, 'confirmationCode', str_random(50));
			dd($data);

			$user = $this->userRepo->create($data);

			Flash::success('Er is een e-mail verstuurd naar het opgegeven e-mailadres. Met deze e-mail kunt u het registratieproces afronden.');

			Mail::send('emails.registration.welcome', $user->confirmationCode, function($message)
			{
				$insertion = $user->insertion ? $user->insertion . ' ': '';

				$message->to
				(	
					$user->email, 
					$user->firstName . ' ' . $insertion . $user->lastName
				)->subject('Welkom bij wijkplatform De Bunders');
			});

			Mail::send('emails.registration.management', function($message)
			{
				$message->to
				(	
					'', 
					''
				)->subject('Welkom bij wijkplatform De Bunders');
			});

			return Redirect::route('home.index');
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
			$credentials['active'] = true;

			if (!$this->auth->attempt($credentials, $request['remember']))
			{
				return Redirect::route('auth.login')->withErrors
				([
					'username' => 'De ingevoerde gebruikersnaam met wachtwoord combinatie klopt helaas niet. Probeer het alstublieft opnieuw.',
				]);
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
			if (Auth::check())
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