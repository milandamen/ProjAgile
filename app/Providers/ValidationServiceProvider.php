<?php
	namespace App\Providers;

	use App\Services\CustomValidator;
	use Illuminate\Support\ServiceProvider;

	class ValidationServiceProvider extends ServiceProvider 
	{
		/**
		 * Resolve all custom validator services.
		 *
		 * @return void
		 */
		public function boot() 
		{
			\Validator::resolver(function($translator, $data, $rules, $messages = [], $customAttributes = []) 
			{
				$postalRepo = \App::make('App\Repositories\RepositoryInterfaces\IPostalRepository');
				$userRepo = \App::make('App\Repositories\RepositoryInterfaces\IUserRepository');

				return new CustomValidator($translator, $data, $rules, $messages, $customAttributes, $postalRepo, $userRepo);
			});
		}

		/**
		 * Register any application services.
		 *
		 * @return void
		 */
		public function register()
		{
			//
		}
	}