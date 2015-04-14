<?php 
	namespace App\Http\Requests\News;

	use App\Http\Requests\Request;

	class NewsRequest extends Request 
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
				'title' => 'required',
				'content' => 'required',
				'hidden' => 'required',
				'commentable' => 'required',
				'publishStartDate' => 'required|date',
				'publishEndDate' => 'required|date',
				'top' => 'required',
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

			$input['title'] = filter_var($input['title'], FILTER_SANITIZE_STRING);
			$input['content'] = filter_var($input['content'], FILTER_SANITIZE_STRING);
			$input['districtSectionId'] = filter_var($input['districtSectionId'], FILTER_SANITIZE_STRING);
			$input['hidden'] = filter_var($input['hidden'], FILTER_SANITIZE_STRING);
			$input['commentable'] = filter_var($input['commentable'], FILTER_SANITIZE_STRING);
			$input['publishStartDate'] = filter_var($input['publishStartDate'], FILTER_SANITIZE_STRING);
			$input['publishEndDate'] = filter_var($input['publishEndDate'], FILTER_SANITIZE_STRING);
			$input['top'] = filter_var($input['top'], FILTER_SANITIZE_STRING);
			
			return $input;
		}
	}