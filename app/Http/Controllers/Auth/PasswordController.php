<?php 
	namespace App\Http\Controllers\Auth;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Auth\ReminderRequest;
	use App\Http\Requests\Auth\ResetRequest;
	use App\Repositories\RepositoryInterfaces\IUserRepository;
	use Flash;
	use Hash;
	use Illuminate\Contracts\Auth\Guard;
	use Illuminate\Contracts\Auth\PasswordBroker;
	use Illuminate\Foundation\Auth\ResetsPasswords;
	use Lang;
	use Redirect;
	use Password;

	class PasswordController extends Controller 
	{
		use ResetsPasswords;

		private $userRepo;

		/**
		 * Create a new password controller instance.
		 *
		 * @param  Guard  			$auth
		 * @param  PasswordBroker  	$passwords
		 * 
		 * @return void
		 */
		public function __construct(Guard $auth, PasswordBroker $passwords, IuserRepository $userRepo)
		{
			$this->auth = $auth;
			$this->passwords = $passwords;
			$this->userRepo = $userRepo;
		}

		/**
		 * Show the password reminder page.
		 * 
		 * @return Reponse
		 */
		public function reminder()
		{
			return view('auth.reminder');
		}

		public function request(ReminderRequest $request)
		{
			$credentials = $request->only('email');
			$response = $this->passwords->sendResetLink($credentials, function($message)
			{
				$message->subject(trans('passwords.subject'));
			});

			if($response === Password::INVALID_USER)
			{
				return Redirect::back()->withInput()->withErrors([Lang::get($response)]);
			}
			Flash::success('Er is een e-mail verstuurd naar het opgegeven e-mailadres. Met deze e-mail kunt u uw wachtwoord resetten.')->important();

			return Redirect::route('home.index');
		}

		/**
		 * Show the password reset page.
		 * 
		 * @return Reponse
		 */
		public function reset($token)
		{
			return view('auth.reset', compact('token'));
		}

		public function update(ResetRequest $request)
		{
			$credentials = $request->only('email', 'password', 'password_confirmation', 'token');

			$response = Password::reset($credentials, function($user, $password)
			{
				$user->password = Hash::make($password);
				$this->userRepo->update($user);
			});

			switch ($response)
			{
				case Password::INVALID_PASSWORD:
				case Password::INVALID_TOKEN:
				case Password::INVALID_USER:
					return Redirect::back()->withErrors([Lang::get($response)]);
				case Password::PASSWORD_RESET:
					Flash::success('Uw wachtwoord is succesvol gereset.')->important();

					return Redirect::route('home.index');
			}
		}
	}