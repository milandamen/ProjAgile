<?php 
	namespace App\Http\Controllers\Auth;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Auth\RegisterRequest;
	use App\Repositories\RepositoryInterfaces\IUserRepository;
	use Auth;
	use Flash;
	use Illuminate\Contracts\Auth\Guard;
	use Mail;
	use Redirect;

	class RegistrationController extends Controller 
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
		 * Creates a new RegistrationController instance.
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
			$user = $this->userRepo->create($request->all());

			$insertion = $user->insertion ? $user->insertion . ' ' : '';
			$name = $user->firstName . ' '. $insertion . $user->surname;
			$email = $user->email;
			$confirmation_Token = $user->confirmation_Token;
			$districtSection = $user->address->districtSection->name;

			Mail::send('emails.auth.welcome', compact('name', 'confirmation_Token'), function($message) use($name, $email)
			{
				$message->to
				(	
					$email, 
					$name
				)->subject('Welkom bij wijkplatform De Bunders - Veghel');
			});
			Mail::send('emails.auth.management', compact('name', 'districtSection'), function($message)
			{
				$message->to
				(	
					env('MAIL_MANAGEMENT_ADDRESS'), 
					env('MAIL_MANAGEMENT_NAME')
				)->subject('Een nieuwe gebruiker heeft zich geregistreerd');
			});
			Flash::success('Er is een e-mail verstuurd naar het opgegeven e-mailadres. Met deze e-mail kunt u uw account activeren.')->important();

			return Redirect::route('home.index');
		}

		/**
		 * Confirm the user's e-mailaddress via the provided confirmation token.
		 * 
		 * @param  string $confirmation_Token
		 * 
		 * @return Response
		 */
		public function confirm($confirmation_Token)
		{
			$user = $this->userRepo->getByConfirmationToken($confirmation_Token);

			if(isset($user))
			{
				$user->active = true;
				$user->confirmation_Token = null;
				$this->userRepo->update($user);

				$this->auth->login($user);

				Flash::success('U heeft succesvol uw account geactiveerd. U bent nu succesvol ingelogd.');
			}
			else
			{
				Flash::error('U heeft onsuccesvol geprobeerd een account te activeren. 
							  Mogelijke redenen hiervoor zijn dat het account al geactiveerd is of omdat de activatie token verlopen is.')->important();
			}

			return Redirect::route('home.index');
		}
	}