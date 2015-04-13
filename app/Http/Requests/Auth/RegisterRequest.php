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
		 * @return array
		 */
		public function rules()
		{
			if (strlen($this->input('postal')) == 6)
			{
				$postal_fix = substr_replace($this->input('postal'), ' ', 4, 0);

				$this->merge(['postal' => $postal_fix]);
			}

			return 
			[
                'username' => 'required|max:30|unique:User,username',
                'password' => 'required|confirmed|min:8',
                'password_confirmation' => 'required',
                'firstName' => 'required|max:50',
                'surname' => 'required|max:80',
                'houseNumber' => 'required|integer|digits_between:1,8',
                'postal' => 'required|min:6|max:7|exists:Postal,code',
                'email' => 'required|max:60|email|unique:User,email',
			];
		}

		private function sanitize()
		{
			$input = $this->all();

			$input['username'] = filter_var($input['username'], FILTER_SANITIZE_STRING);
			$input['password'] = filter_var($input['password'], FILTER_SANITIZE_STRING);
			$input['password_confirmation'] = filter_var($input['password_confirmation'], FILTER_SANITIZE_STRING);
			$input['firstName'] = filter_var($input['firstName'], FILTER_SANITIZE_STRING);
			$input['surname'] = filter_var($input['surname'], FILTER_SANITIZE_STRING);
			$input['houseNumber'] = filter_var($input['houseNumber'], FILTER_SANITIZE_STRING);
			$input['postal'] = filter_var($input['postal'], FILTER_SANITIZE_STRING);
			$input['email'] = filter_var($input['email'], FILTER_SANITIZE_EMAIL);

			$this->replace($input);
		}
	}