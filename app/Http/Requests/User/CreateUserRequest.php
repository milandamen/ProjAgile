<?php
	namespace App\Http\Requests\User;

	use App\Http\Controllers\UserController;
	use App\Http\Requests\Request;
	use Auth;

	class CreateUserRequest extends Request
	{
		/**
		 * Determine if the user is authorized to make this request.
		 *
		 * @return bool
		 */
		public function authorize()
		{
			return Auth::user()->usergroup->name === 'Administrator';
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
					'username' => 'required|max:30|unique:user,username',
					'password' => 'required|confirmed|min:8',
					'password_confirmation' => 'required',
					'firstName' => 'required|max:50',
					'insertion' => 'max:30',
					'surname' => 'required|max:80',
					'suffix' => 'max:1|exists:housenumber,suffix',
					'email' => 'required|max:60|email|unique:user,email',
					'email_confirmation' => 'required',
				];

			//return rules based on userGroup.
			//postal and houseNumber attributes are required only for residents.
			if ((int)$this->get('userGroupId') === UserController::RESIDENT_GROUP_ID)
			{
				$rules +=
				[
					'houseNumber' => 'required|integer|digits_between:1,8|exists:housenumber,houseNumber',
					'postal' => 'required|min:6|max:7|exists:postal,code',
				];
			}
			else
			{
				$rules +=
				[
					'houseNumber' => 'integer|digits_between:1,8',
					'postal' => 'min:6|max:7|exists:postal,code',
				];
			}
			$postalRepo = \App::make('App\Repositories\RepositoryInterfaces\IPostalRepository');
			$houseNumberRepo = \App::make('App\Repositories\RepositoryInterfaces\IHouseNumberRepository');
			$addressRepo = \App::make('App\Repositories\RepositoryInterfaces\IAddressRepository');

			$postal = $postalRepo->getByCode($this->only('postal'));
			$houseNumber = $houseNumberRepo->getByHouseNumberSuffix($this->only('houseNumber'), $this->only('suffix') ? $this->only('suffix') : null);

			if($postal !== null && $houseNumber !== null)
			{
				$rules['postal'] = $rules['postal'] . '|address_exists';

				$address = $addressRepo->getByPostalHouseNumber($postal->postalId, $houseNumber->houseNumberId);

				if($address !== null)
				{
					$rules['postal'] = $rules['postal'] . '|is_address_not_in_use';
				}
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

			$input['username'] = filter_var($input['username'], FILTER_SANITIZE_STRING);
			$input['password'] = filter_var($input['password'], FILTER_SANITIZE_STRING);
			$input['password_confirmation'] = filter_var($input['password_confirmation'], FILTER_SANITIZE_STRING);
			$input['firstName'] = filter_var($input['firstName'], FILTER_SANITIZE_STRING);
			$input['insertion'] = filter_var($input['insertion'], FILTER_SANITIZE_STRING);
			$input['surname'] = filter_var($input['surname'], FILTER_SANITIZE_STRING);
			$input['houseNumber'] = filter_var($input['houseNumber'], FILTER_SANITIZE_STRING);
			$input['suffix'] = filter_var($input['suffix'], FILTER_SANITIZE_STRING);
			$input['postal'] = filter_var($input['postal'], FILTER_SANITIZE_STRING);
			$input['email'] = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
			$input['email_confirmation'] = strtolower(filter_var($input['email_confirmation'], FILTER_SANITIZE_EMAIL));

			$input['postal'] = $this->fixPostal($input['postal']);

			$this->replace($input);

			return $input;
		}

		/**
		 * Fixes the postal input before it is used by the validator.
		 *
		 * @return string
		 */
		private function fixPostal($postal)
		{
			if (strlen($postal) > 7)
			{
				$postal = preg_replace('/\s+/', '', $postal);
			}

			if (strlen($postal) == 6)
			{
				$postal = substr_replace($postal, ' ', 4, 0);
			}
			return $postal;
		}
	}