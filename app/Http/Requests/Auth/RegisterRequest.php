<?php 
	namespace App\Http\Requests\Auth;

	use App\Http\Requests\Request;

	class RegisterRequest extends Request 
	{


		/**
		 * Determine if the user is authorized to make this request.
		 *
		 * @return bool
		 */
		public function authorize()
		{
			return true;
		}

		/**
		 * Get the validation rules that apply to the request.
		 *
		 * @return array()
		 */
		public function rules()
		{
			$rules = 
			[
				'username' 				=> 'required|max:30|unique:user,username',
				'password' 				=> 'required|confirmed|is_password_strong_enough',
				'password_confirmation'	=> 'required',
				'firstName' 			=> 'required|max:50',
				'insertion' 			=> 'max:30',
				'surname' 				=> 'required|max:80',
				'houseNumber' 			=> 'required|integer|digits_between:1,8',
				'suffix' 				=> 'max:1',
				'postal' 				=> 'required|min:6|max:7|exists:postal,code',
				'email' 				=> 'required|confirmed|max:60|email|unique:user,email',
				'email_confirmation' 	=> 'required',
				'g-recaptcha-response' 	=> 'required|recaptcha',
			];
			$postalRepo = \App::make('App\Repositories\RepositoryInterfaces\IPostalRepository');

			if($postalRepo->getByCode($this->only('postal')) != null)
			{
				$rules['postal'] = $rules['postal'] . '|is_postal_not_in_use';
			}

			return $rules;
		}

		/**
		 * Sanitizes the provided input that will be used by the validator and controller.
		 *
		 * @return array()
		 */
		public function sanitize()
		{
			$input = $this->all();

			$input['username'] 				= filter_var($input['username'], FILTER_SANITIZE_STRING);
			$input['password']				= filter_var($input['password'], FILTER_SANITIZE_STRING);
			$input['password_confirmation'] = filter_var($input['password_confirmation'], FILTER_SANITIZE_STRING);
			$input['firstName'] 			= filter_var($input['firstName'], FILTER_SANITIZE_STRING);
			$input['insertion'] 			= filter_var($input['insertion'], FILTER_SANITIZE_STRING);
			$input['surname']				= filter_var($input['surname'], FILTER_SANITIZE_STRING);
			$input['houseNumber'] 			= filter_var($input['houseNumber'], FILTER_SANITIZE_STRING);
			$input['suffix'] 				= filter_var($input['suffix'], FILTER_SANITIZE_STRING);
			$input['postal'] 				= filter_var($input['postal'], FILTER_SANITIZE_STRING);
			$input['email'] 				= filter_var($input['email'], FILTER_SANITIZE_EMAIL);
			$input['email_confirmation'] 	= filter_var($input['email_confirmation'], FILTER_SANITIZE_EMAIL);

			$input['postal'] = $this->fixPostal($input['postal']);

			$this->replace($input);

			return $input;
		}

		/**
		 * Fixes the postal input before it is used by the validator.
		 *
		 * @return string
		 */
		private function fixPostal($postal)
		{
			if (strlen($postal) > 7)
			{
				$postal = preg_replace('/\s+/', '', $postal);
			}

			if (strlen($postal) == 6)
			{
				$postal = substr_replace($postal, ' ', 4, 0);
			}

			return $postal;
		}
	}