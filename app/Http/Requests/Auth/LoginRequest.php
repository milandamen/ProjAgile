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
			$this->sanitize();
			
			return 
			[
                'username' => 'required',
                'password' => 'required',
			];
		}

		private function sanitize()
		{
			$input = $this->all();

			$input['username'] = filter_var($input['username'], FILTER_SANITIZE_STRING);
			$input['password'] = filter_var($input['password'], FILTER_SANITIZE_STRING);

			$this->replace($input);
		}
	}