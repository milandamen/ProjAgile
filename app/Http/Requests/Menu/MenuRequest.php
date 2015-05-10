<?php 
	namespace App\Http\Requests\Menu;

	use App\Http\Requests\Request;

	class MenuRequest extends Request
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
				'name' => 'required|max:45|min:1',
				'link' => 'required|max:255|min:1',
				'publish' => 'required',
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

			$input['name'] = filter_var($input['name'], FILTER_SANITIZE_STRING);
            $input['link'] = filter_var($input['link'], FILTER_SANITIZE_STRING);
    		$input['publish'] = parseCheckboxOrRadioButton($input['publish']);

			$this->replace($input);

			return $input;
		}
	}