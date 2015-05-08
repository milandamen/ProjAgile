<?php 
	namespace App\Http\Requests\Home;

	use App\Http\Requests\Request;

	class IntroductionRequest extends Request 
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
				'pageId'	=> 'required',
				'title' 	=> 'required',
				'content' 	=> 'required',
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

			$input['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
			$input['subtitle'] = filter_var($_POST['subtitle'], FILTER_SANITIZE_STRING);
            $input['content'] = htmlspecialchars_decode($_POST['content']);

            $this->replace($input);

			return $input;
		}
	}