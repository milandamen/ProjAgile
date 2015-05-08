<?php 
	namespace App\Http\Requests\Page;

	use App\Http\Requests\Request;

	class PageRequest extends Request 
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
				'title' 	=> 'required',
				'content' 	=> 'required',
				'sidebar'	=> 'required',
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

			$input['title'] = filter_var($input['title'], FILTER_SANITIZE_STRING);
			$input['subtitle'] = filter_var($_POST['subtitle'], FILTER_SANITIZE_STRING);
            $input['content'] = htmlspecialchars_decode($input['content']);
            $input['sidebar'] = parseCheckboxOrRadioButton($input['sidebar']);

            if(isset($input['panel'])){
	            foreach($input['panel'] as $panel){
	            	$panel['title'] = filter_var($panel['title'], FILTER_SANITIZE_STRING);
	            	$panel['content'] = htmlspecialchars_decode($panel['content']);
	            }
        	}

            $this->replace($input);

			return $input;
		}
	}