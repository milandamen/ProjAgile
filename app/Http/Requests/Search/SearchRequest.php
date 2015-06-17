<?php 
	namespace App\Http\Requests\Search;

	use App\Http\Requests\Request;

	class SearchRequest extends Request 
	{
		/**
		 * Determine if the user is authorized to make this request.
		 *
		 * @return boolean
		 */
		public function authorize()
		{
			return true;
		}

		/**
		 * Get the validation rules that apply to the request.
		 *
		 * @return array()
		 */
		public function rules()
		{
			return 
			[
				//
			];
		}

		/**
		 * Sanitizes the provided input that will be used by the validator and controller.
		 * 
		 * @return array()
		 */
		public function sanitize()
		{
			$input = $this->all();

			$input['query'] = filter_var(isset($input['query']) ? $input['query'] : '', FILTER_SANITIZE_STRING);

			$this->replace($input);

			return $input;
		}
	}