<?php 
	namespace App\Http\Requests\DistrictSection;

	use App\Http\Requests\Request;

	class DistrictSectionRequest extends Request 
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
				'name' 	=> 'required',
				'text' 	=> 'required',
			];
		}

		/**
		 * Sanitizes the provided input that will be used by the validator and controller.
		 * Content will not be sanitized due to use of Summernote.
		 * 
		 * @return array
		 */
		public function sanitize()
		{
			$input = $this->all();

			$input['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
			$input['text'] = htmlspecialchars_decode($_POST['text']);

			$this->replace($input);

			return $input;
		}
	}