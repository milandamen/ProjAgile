<?php 
	namespace App\Http\Requests\Page;

	use App\Http\Requests\Request;

	class ContactRequest extends Request 
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
				'name' 		=> 'required',
				'email'		=> 'required|email',
				'subject'	=> 'required',
				'message'	=> 'required',

			];
		}

		/**
		 * Sanitizes the provided input that will be used by the validator and controller.
		 * Content will not be sanitized due to use of Summernote.
		 * @return array
		 */
		public function sanitize()
		{
			$input = $this->all();

			$input['name'] = filter_var($input['name'], FILTER_SANITIZE_STRING);
			$input['email'] 	= strtolower(filter_var($input['email'], FILTER_SANITIZE_EMAIL));
			$input['subject'] = filter_var($input['subject'], FILTER_SANITIZE_STRING);
			$input['message'] = filter_var($input['message'], FILTER_SANITIZE_STRING);

			$this->replace($input);

			return $input;
		}
	}