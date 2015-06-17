<?php
	namespace App\Http\Requests\User;

	use App\Http\Controllers\UserController;
	use App\Http\Requests\Request;
	use Auth;
	use Route;

	class UserRequest extends Request
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
			$rules =
			[
				'firstName'	=> 'required|max:50',
				'insertion'	=> 'max:30',
				'surname'	=> 'required|max:80',
				'suffix'	=> 'max:1|exists:housenumber,suffix',
			];

			if(strtoupper(Request::method()) !== 'PATCH')
			{
				$rules +=
				[
					'username'				=> 'required|max:30|unique:user,username',
					'password'				=> 'required|confirmed|is_password_strong_enough',
					'password_confirmation'	=> 'required',
					'email'					=> 'required|confirmed|max:60|email|unique:user,email',
					'email_confirmation'	=> 'required',
					'userGroupId'			=> 'required|exists:usergroup,userGroupId',
				];
				$rules += $this->addAddressRules();
			}
			else
			{
				$rules +=
				[
					'email'					=> 'required|confirmed|max:60|email',
					'email_confirmation'	=> 'required',
				];

				if($this->get('password') !== '' || $this->get('password_confirmation') !== '')
				{
					$rules +=
					[
						'password'				=> 'required|confirmed|is_password_strong_enough',
						'password_confirmation'	=> 'required',
					];
				}

				if(Route::input('id') !== null)
				{
					$userId = Route::input('id');

					$rules['username']	= 'required|max:30|unique:user,username,' . $userId . ',userId';
					$rules['email']		.= '|unique:user,email,' . $userId . ',userId';
					$rules += $this->addAddressRules($userId);
				}
				else
				{
					$rules['email']		.= '|unique:user,email,' . Auth::user()->userId . ',userId';
				}
			}

			return $rules;
		}

		/**
		 * Sanitizes the provided input that will be used by the validator and controller.
		 *
		 * @return array()
		 */
		public function sanitize()
		{
			$input = $this->all();

			$input['username'] 				= filter_var(isset($input['username']) ? $input['username']: '', FILTER_SANITIZE_STRING);
			$input['password'] 				= filter_var($input['password'], FILTER_SANITIZE_STRING);
			$input['password_confirmation'] = filter_var($input['password_confirmation'], FILTER_SANITIZE_STRING);
			$input['firstName'] 			= filter_var($input['firstName'], FILTER_SANITIZE_STRING);
			$input['insertion'] 			= filter_var($input['insertion'], FILTER_SANITIZE_STRING);
			$input['surname'] 				= filter_var($input['surname'], FILTER_SANITIZE_STRING);
			$input['houseNumber'] 			= filter_var(isset($input['houseNumber']) ? $input['houseNumber'] : '', FILTER_SANITIZE_STRING);
			$input['suffix'] 				= filter_var(isset($input['suffix']) ? $input['suffix'] : '', FILTER_SANITIZE_STRING);
			$input['postal'] 				= filter_var(isset($input['postal']) ? $input['postal'] : '', FILTER_SANITIZE_STRING);
			$input['email'] 				= strtolower(filter_var($input['email'], FILTER_SANITIZE_EMAIL));
			$input['email_confirmation'] 	= strtolower(filter_var($input['email_confirmation'], FILTER_SANITIZE_EMAIL));

			$input['userGroupid']			= parseSelectorField(filter_var(isset($input['userGroupid']) ? $input['userGroupid'] : '', FILTER_SANITIZE_STRING));

			$input['postal'] 				= $this->fixPostal($input['postal']);

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

			if (strlen($postal) === 6)
			{
				$postal = substr_replace($postal, ' ', 4, 0);
			}

			return $postal;
		}

		/**
		 * Return the address validaton rules.
		 *
		 * @param  int $userId
		 *
		 * @return array()
		 */
		private function addAddressRules($userId)
		{
			$rules =
			[
				'houseNumber'	=> 'integer|digits_between:1,8|exists:housenumber,houseNumber',
				'postal'		=> 'min:6|max:7|exists:postal,code|exists:postal,code',
			];

			// Postal and houseNumber attributes are only required for residents.
			if((int)$this->get('userGroupId') === UserController::RESIDENT_GROUP_ID)
			{
				$rules['houseNumber'] .= '|required';
				$rules['postal'] .= '|required';
			}
			
			if($this->get('postal') && $this->get('houseNumber'))
			{
				$postalRepo = \App::make('App\Repositories\RepositoryInterfaces\IPostalRepository');
				$houseNumberRepo = \App::make('App\Repositories\RepositoryInterfaces\IHouseNumberRepository');
				$addressRepo = \App::make('App\Repositories\RepositoryInterfaces\IAddressRepository');

				$postal = $postalRepo->getByCode($this->get('postal'));
				$houseNumber = $houseNumberRepo->getByHouseNumberSuffix($this->get('houseNumber'), $this->get('suffix') ? $this->get('suffix') : null);

				if($postal !== null && $houseNumber !== null)
				{
					$rules['postal'] .= '|address_exists';

					$address = $addressRepo->getByPostalHouseNumber($postal->postalId, $houseNumber->houseNumberId);

					if($address !== null)
					{
						$rules['postal'] .= '|is_address_not_in_use:' . $userId;
					}
				}
			}

			return $rules;
		}
	}