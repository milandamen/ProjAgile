<?php
	class PostalValidator extends Illuminate\Validation\Validator 
	{
		public function validatePostal($attribute, $value, $parameters)
		{
			return $value == 'foo';
		}
	}