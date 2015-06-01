<?php
	namespace App\Services;

	use Illuminate\Validation\Validator;

	class CustomValidator extends Validator 
	{
		private $addressRepo;
		private $houseNumberRepo;
		private $postalRepo;
		private $userRepo;

		/**
		 * Creates a new CustomValidator instance.
		 * 
		 * @param TranslatorInterface	$tanslator
		 * @param array() 				$data
		 * @param array() 				$rules
		 * @param array() 				$messages
		 * @param array() 				$customAttributes
		 */
		public function __construct($tanslator, $data, $rules, $messages = [], $customAttributes = [], $addressRepo, $houseNumberRepo, $postalRepo, $userRepo)
		{
			parent::__construct($tanslator, $data, $rules, $messages, $customAttributes);

			$this->addressRepo = $addressRepo;
			$this->houseNumberRepo = $houseNumberRepo;
			$this->postalRepo = $postalRepo;
			$this->userRepo = $userRepo;
		}

		/**
		 * Validates if the provided postal, housenumber and suffix combination exists.
		 * 
		 * @param  array()	$attribute
		 * @param  array()	$value
		 * @param  array()	$parameters
		 * 
		 * @return boolean
		 */
		protected function validateAddressExists($attribute, $value, $parameters)
		{
			$postal = $this->postalRepo->getByCode($value);
			$houseNumber = $this->houseNumberRepo->getByHouseNumberSuffix($this->data['houseNumber'], $this->data['suffix'] ? : null);
			$address = $this->addressRepo->getByPostalHouseNumber($postal->postalId, $houseNumber->houseNumberId);

			return isset($address);
		}

		/**
		 * Validates if the provided postal is already in use by another user.
		 * 
		 * @param array()	$attribute
		 * @param array()	$value
		 * @param array()	$parameters
		 * 
		 * @return boolean
		 */
		protected function validateIsAddressNotInUse($attribute, $value, $parameters)
		{
			$postal = $this->postalRepo->getByCode($value);
			$houseNumber = $this->houseNumberRepo->getByHouseNumberSuffix($this->data['houseNumber'], $this->data['suffix'] ? : null);
			$address = $this->addressRepo->getByPostalHouseNumber($postal->postalId, $houseNumber->houseNumberId);
			$user = $this->userRepo->getByAddress($address->addressId);

			return !isset($user);
		}

		/**
		 * Validates if the provided password has a certain password strength.
		 * 
		 * @param array()	$attribute
		 * @param array()	$value
		 * 
		 * @return boolean
		 */
		protected function validateIsPasswordStrongEnough($attribute, $value, $parameters)
		{
			// Set configurable variables for the regex to adept to.
			$numDigits					= 1;
			$allowedDigits 				= '[0-9]';

			$numLowerCaseLetters 		= 0;
			$allowedLowerCaseLetters	= '[a-z]';

			$numSpecialCaseLetters		= 1;
			$allowedSpecialCaseLetters	= '[!@#$&*]';

			$numUpperCaseLetters 		= 1;
			$allowedUpperCaseLetters	= '[A-Z]';

			$passwordLength				= 8;
		
			// Starting anchor for the regex.
			$regex = '/^';

			if($numDigits > 0)
			{
				// Add the password number of digits rule to the regex.
				$regex .= $this->addComplexRegexPart($allowedDigits, $numDigits);
			}

			if($numLowerCaseLetters > 0)
			{
				// Add the password number of lower case letters rule to the regex.
				$regex .= $this->addComplexRegexPart($allowedLowerCaseLetters, $numLowerCaseLetters);
			}

			if($numSpecialCaseLetters > 0)
			{
				// Add the password number of special case letters rule to the regex.
				$regex .= $this->addComplexRegexPart($allowedSpecialCaseLetters, $numSpecialCaseLetters);
			}

			if($numUpperCaseLetters > 0)
			{
				// Add the password number of upper case letters rule to the regex.
				$regex .= $this->addComplexRegexPart($allowedUpperCaseLetters, $numUpperCaseLetters);
			}

			if($passwordLength > 0)
			{
				// Add the password length rule to the regex.
				$regex .= '.{' . $passwordLength . ',}';
			}
			// Ending anchor for the regex.
			$regex .= '$/';

			return (bool)preg_match($regex, $value);
		}

		/**
		 * Add a complex regex part to the provided regex.
		 * 
		 * @param string	$regex
		 * @param string	$part
		 * @param int		$num
		 *
		 * @return string
		 */
		private function addComplexRegexPart($part, $num)
		{
			$regex = '';

			if (!empty($part) && $num > 0)
			{
				// Add the prefix to the regex.
				$regex = '(?=';

				for($i = 0; $i < $num; $i++)
				{
					// Add the part to the regex.
					$regex .= '.*' . $part;
				}
				// Add the suffix to the regex.
				$regex .= ')';
			}

			return $regex;
		}
	}