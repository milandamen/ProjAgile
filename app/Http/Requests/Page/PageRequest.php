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
				'publishStartDate' => 'required|date|before:publishEndDate',
				'publishEndDate' => 'required|date',
				'visible'	=> 'required',
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
			$input['visible'] = parseCheckboxOrRadioButton($input['visible']);
			$input['publishStartDate'] = filter_var($input['publishStartDate'], FILTER_SANITIZE_STRING);
			$input['publishEndDate'] = filter_var($input['publishEndDate'], FILTER_SANITIZE_STRING);
			

			if(isset($input['panel']))
			{
				for($i = 0; $i<count($input['panel']); $i++)
				{
					$input['panel'][$i]['title'] = filter_var($input['panel'][$i]['title'], FILTER_SANITIZE_STRING);
					$input['panel'][$i]['content'] = filter_var($input['panel'][$i]['content'], FILTER_SANITIZE_STRING);
				}
			}
			
			$this->replace($input);

			return $input;
		}
	}