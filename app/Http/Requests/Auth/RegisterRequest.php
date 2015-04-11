<?php 
	namespace App\Http\Requests\Auth;

	use App\Http\Requests\Request;

	class RegisterRequest extends Request 
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
                'username' => 'required|max:30|unique:User,username',
                'password' => 'required|confirmed|min:8',
                'password_confirmation' => 'required',
                'firstName' => 'required|max:50',
                'surname' => 'required|max:80',
                'houseNumber' => 'required|integer|digits_between:1,8',
                'postal' => 'required|max:6|exists:Postal,code',
                'email' => 'required|max:60|email|unique:User,email',
			];
		}
	}