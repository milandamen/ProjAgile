<?php
	namespace App\Http\Requests\Permissions;

	use App\Http\Controllers\PermissionsController;
	use App\Http\Requests\Request;
	use Auth;

	class CreateUserGroupRequest extends Request
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
				'name'	=> 'required|max:45|unique:usergroup,name',
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

			$this->replace($input);

			return $input;
		}
	}