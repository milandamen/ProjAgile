<?php 
	namespace App\Http\Requests\Auth;

	use App\Http\Requests\Request;

	class ResetRequest extends Request 
	{
		/**
		 * Determine if the user is authorized to make this request.
		 *
		 * @return boolean
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
			return 
			[
				'email' 					=> 'required|email',
				'password'					=> 'required|confirmed|is_password_strong_enough',
				'password_confirmation'		=> 'required',
			];
		}

		/**
		 * Sanitizes the provided input that will be used by the validator and controller.
		 *
		 * @return array()
		 */
		public function sanitize()
		{
			$input = $this->all();

			$input['email'] 				= filter_var($input['email'], FILTER_SANITIZE_EMAIL);
			$input['password']				= filter_var($input['password'], FILTER_SANITIZE_STRING);
			$input['password_confirmation'] = filter_var($input['password_confirmation'], FILTER_SANITIZE_STRING);

			$this->replace($input);

			return $input;
		}
	}