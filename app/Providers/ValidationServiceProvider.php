<?php
	namespace RocketCandy\Services\Validation;

	use Illuminate\Support\ServiceProvider;

	class ValidationExtensionServiceProvider extends ServiceProvider 
	{
		/**
		 * Resolve all custom validator services.
		 *
		 * @return void
		 */
		public function boot() 
		{
			$this->app->validator->resolver(function($translator, $data, $rules, $messages = [], $customAttributes = []) 
			{
				return new ValidatorExtended($translator, $data, $rules, $messages, $customAttributes);
			});
		}
	}