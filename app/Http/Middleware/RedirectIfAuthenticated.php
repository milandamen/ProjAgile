<?php 
	namespace App\Http\Middleware;

	use Closure;
    use Flash;
	use Illuminate\Contracts\Auth\Guard;
	use Illuminate\Http\RedirectResponse;

	class RedirectIfAuthenticated 
	{
		/**
		 * The Guard implementation.
		 *
		 * @var Guard
		 */
		protected $auth;

		/**
		 * Create a new filter instance.
		 *
		 * @param  Guard  $auth
		 * 
		 * @return void
		 */
		public function __construct(Guard $auth)
		{
			$this->auth = $auth;
		}

		/**
		 * Handle an incoming request.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  \Closure  $next
		 * 
		 * @return mixed
		 */
		public function handle($request, Closure $next)
		{
			if ($this->auth->check())
			{
				Flash::info('U bent al ingelogd!');
				
				return new RedirectResponse(url('/'));
			}

			return $next($request);
		}
	}