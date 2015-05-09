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
				'publishEndDate' => 'required|date',
				'top' => 'required',
			];

			if ($this->request->has('districtSection'))
			{
				foreach ($this->request->get('districtSection') as $key => $value)
				{
					$rules['districtSection.' . $key ] = 'exists:DistrictSection,districtSectionId';
				}
			}

			if ($this->request->has('file'))
			{
				foreach ($this->request->get('file') as $key => $value)
				{
					$rules['file.' . $key] = 'mimes:docx,pdf,xls,ppt,xps,odi,odp,ods,odt,pptx,xlsx,docx,dotx,xml,gif,jpeg,png,plain,rtf';
				}
			}

			return $rules;
		}

		public function messages()
		{
			$messages = [];

			if ($this->request->has('districtSection'))
			{
				foreach ($this->request->get('districtSection') as $key => $value)
				{
					$messages['districtSection.' . $key . '.exists'] = "Eén van de deelwijken is geen bestaande deelwijk.";
				}
			}

			if ($this->request->has('file'))
			{
				foreach ($this->request->get('file') as $key => $value)
				{
					$messages['file.' . $key . '.mimes'] = "Eén van de bestanden is niet van het bestandstype :values.";
				}
			}

			return $messages;
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
				$input['districtSection.' . $key] = parseSelectorField(filter_var($value, FILTER_SANITIZE_STRING));
			}
			
			$input['hidden'] = parseCheckboxOrRadioButton($input['hidden']);
			$input['commentable'] = parseCheckboxOrRadioButton($input['commentable']);
			$input['top'] = parseCheckboxOrRadioButton($input['top']);
			
			$this->replace($input);

			return $input;
		}
	}