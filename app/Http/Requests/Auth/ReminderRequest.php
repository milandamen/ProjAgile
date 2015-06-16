<?php
	namespace App\Http\Requests\Auth;

	use App\Http\Requests\Request;

	class ReminderRequest extends Request 
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
				'email' => 'required|email',
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

			$input['email'] = filter_var($input['email'], FILTER_SANITIZE_EMAIL);

			$this->replace($input);

			return $input;
		}
	}