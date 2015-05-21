<?php
	namespace App\Services\Validation;

	use Illuminate\Validation\Validator;

	class PostalValidator extends Validator 
	{
		/**
		 * The custom error messages.
		 * 
		 * @var array()
		 */
		private $customMessages;

		/**
		 * Creates a new PostalValidator instance.
		 * 
		 * @param TranslatorInterface	$tanslator
		 * @param array() 				$data
		 * @param array() 				$rules
		 * @param array() 				$messages
		 * @param array() 				$customAttributes
		 */
		public function __construct($tanslator, $data, $rules, $messages = [], $customAttributes = [])
		{
			parent::__construct($tanslator, $data, $rules, $messages, $customAttributes);

			$this->setMessages();
		}

		/**
		 * Sets the custom messages used for displaying the validation errors.
		 *
		 * @return void
		 */
		private function setMessages()
		{
			$customMessages = 
			[

			];
			$this->setCustomMessages($customMessages);
		}

		/**
		 * Validates if the provided postal is already in use by another user.
		 * 
		 * @param array()				$attribute
		 * @param array()				$value
		 * @param IPostalRepository		$postalRepo
		 * @param IUserRepository		$userRepo
		 * 
		 * @return boolean
		 */
		protected function validatePostal($attribute, $value, IPostalRepository $postalRepo, IUserRepository $userRepo)
		{
			$postal = $postalRepo->getByCode($value);
			$user = $userRepo->getByPostal($postal->postalId);

			return isset($user);
		}
	}