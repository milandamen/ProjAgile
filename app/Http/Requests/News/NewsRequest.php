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
			$rules = 
			[
				'title' => 'required',
				'content' => 'required',
				'hidden' => 'required',
				'commentable' => 'required',
				'publishStartDate' => 'required|date|before:publishEndDate',
				'publishEndDate' => 'required|date|after:publishStartDate',
				'top' => 'required',
			];

			foreach ($this->request->get('districtSection') as $key => $value)
			{
				$rules = array_add($rules, 'districtSection[' . $key . ']', 'exists:DistrictSection,name');
			}

			foreach ($this->request->get('file') as $key => $value)
			{
				$rules = array_add($rules, 'file[' . $key . ']', 'mimes:jpeg,png,pdf');
			}

			return $rules;
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
			$input['content'] = htmlspecialchars_decode($_POST['content']);
			$input['hidden'] = filter_var($input['hidden'], FILTER_SANITIZE_STRING);
			$input['commentable'] = filter_var($input['commentable'], FILTER_SANITIZE_STRING);
			$input['publishStartDate'] = filter_var($input['publishStartDate'], FILTER_SANITIZE_STRING);
			$input['publishEndDate'] = filter_var($input['publishEndDate'], FILTER_SANITIZE_STRING);
			$input['top'] = filter_var($input['top'], FILTER_SANITIZE_STRING);

			foreach ($this->request->get('districtSection') as $key => $value)
			{
				$input['districtSection[' . $key . ']'] = filter_var($value, FILTER_SANITIZE_STRING);
				$input = array_add($input, 'districtSection[' . $key . ']', parseSelectorField($value));
			}
			
			$input['hidden'] = parseCheckboxOrRadioButton($input['hidden']);
			$input['commentable'] = parseCheckboxOrRadioButton($input['commentable']);
			$input['top'] = parseCheckboxOrRadioButton($input['top']);
			
			$this->replace($input);

			return $input;
		}
	}