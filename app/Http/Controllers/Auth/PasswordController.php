<?php 
	namespace App\Http\Controllers\Auth;

	use App\Http\Controllers\Controller;
	use Illuminate\Contracts\Auth\Guard;
	use Illuminate\Contracts\Auth\PasswordBroker;
	use Illuminate\Foundation\Auth\ResetsPasswords;

	class PasswordController extends Controller 
	{
		use ResetsPasswords;

		/**
		 * Create a new password controller instance.
		 *
		 * @param  Guard  			$auth
		 * @param  PasswordBroker  	$passwords
		 * 
		 * @return void
		 */
		public function __construct(Guard $auth, PasswordBroker $passwords)
		{
			$this->auth = $auth;
			$this->passwords = $passwords;
		}

		/**
		 * [remind description]
		 * 
		 * @return [type] [description]
		 */
		public function remind()
		{
			return view('auth.passwords');
		}
	}