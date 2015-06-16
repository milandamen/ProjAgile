<?php 
	namespace App\Http\Requests\Auth;

	use App\Http\Requests\Request;

	class LoginRequest extends Request 
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
			return 
			[
				'username'				=> 'required',
				'password'				=> 'required',
				'g-recaptcha-response'	=> 'sometimes|required|recaptcha',
			];
		}

		/**
		 * Sanitizes the provided input that will be used by the validator and controller.
		 *
		 * @return array
		 */
		public function sanitize()
		{
			$input = $this->all();

			$input['username'] = filter_var($input['username'], FILTER_SANITIZE_STRING);
			$input['password'] = filter_var($input['password'], FILTER_SANITIZE_STRING);

			if (isset($input['remember']))
			{
				$input['remember'] = filter_var(parseCheckboxOrRadioButton($input['remember']), FILTER_SANITIZE_STRING);
			}

			$this->replace($input);

			return $input;
		}
	}