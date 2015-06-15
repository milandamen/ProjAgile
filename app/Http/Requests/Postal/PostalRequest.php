<?php
	namespace App\Http\Requests\Postal;

	use App\Http\Requests\Request;

	class PostalRequest extends Request
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
				'excel' => 'required|mimes:xls,xlsx',
			];
		}
	}